import { parseDurationSec, formatDuration } from './format';

// ---------------------------------------------------------------------------
// Types
// ---------------------------------------------------------------------------

export type NDVideo = {
  id: string;
  title: string;
  description?: string;
  publishedAt: string;
  durationSec: number;
  durationLabel: string;
  thumbnailUrl: string;
  youtubeUrl: string;
  playlistId?: string;
  playlistTitle?: string;
};

export type NDPlaylist = {
  id: string;
  title: string;
  description?: string;
  thumbnailUrl?: string;
  videos: NDVideo[];
  updatedAt?: string;
  longFormCount: number;
};

// ---------------------------------------------------------------------------
// Config
// ---------------------------------------------------------------------------

const API_KEY = import.meta.env.YOUTUBE_API_KEY as string;
const CHANNEL_ID = import.meta.env.YOUTUBE_CHANNEL_ID as string;
const BASE = 'https://www.googleapis.com/youtube/v3';

/** Minimum duration in seconds to be considered long-form (> 1 min) */
const MIN_DURATION_SEC = 61;

// ---------------------------------------------------------------------------
// Internal helpers
// ---------------------------------------------------------------------------

async function ytFetch<T>(path: string, params: Record<string, string>): Promise<T> {
  const url = new URL(`${BASE}${path}`);
  url.searchParams.set('key', API_KEY);
  for (const [k, v] of Object.entries(params)) {
    url.searchParams.set(k, v);
  }
  const res = await fetch(url.toString());
  if (!res.ok) {
    throw new Error(`YouTube API error ${res.status} for ${path}: ${await res.text()}`);
  }
  return res.json() as Promise<T>;
}

/** Fetch all pages of a paginated YouTube API endpoint. */
async function fetchAllPages<T>(
  path: string,
  params: Record<string, string>,
  getItems: (data: T) => unknown[],
): Promise<unknown[]> {
  const items: unknown[] = [];
  let pageToken: string | undefined;
  do {
    const p = pageToken ? { ...params, pageToken } : params;
    const data = await ytFetch<T & { nextPageToken?: string }>(path, p);
    items.push(...getItems(data));
    pageToken = data.nextPageToken;
  } while (pageToken);
  return items;
}

/** Chunk an array into groups of `size`. */
function chunk<T>(arr: T[], size: number): T[][] {
  const result: T[][] = [];
  for (let i = 0; i < arr.length; i += size) {
    result.push(arr.slice(i, i + size));
  }
  return result;
}

/** Pick the best available thumbnail URL from a thumbnails object. */
function bestThumbnail(thumbnails: Record<string, { url: string }> = {}): string {
  return (
    thumbnails.maxres?.url ||
    thumbnails.standard?.url ||
    thumbnails.high?.url ||
    thumbnails.medium?.url ||
    thumbnails.default?.url ||
    ''
  );
}

// ---------------------------------------------------------------------------
// API types (minimal)
// ---------------------------------------------------------------------------

interface YTPlaylist {
  id: string;
  snippet: {
    title: string;
    description: string;
    thumbnails: Record<string, { url: string }>;
  };
}

interface YTPlaylistItem {
  snippet: {
    resourceId: { videoId: string };
    title: string;
    description: string;
    publishedAt: string;
    playlistId: string;
    thumbnails: Record<string, { url: string }>;
    liveBroadcastContent?: string;
  };
}

interface YTVideo {
  id: string;
  contentDetails: { duration: string };
  snippet: {
    title: string;
    description: string;
    publishedAt: string;
    thumbnails: Record<string, { url: string }>;
    liveBroadcastContent?: string;
  };
}

// ---------------------------------------------------------------------------
// Core fetching
// ---------------------------------------------------------------------------

/** Fetch all playlists for the channel. */
async function fetchRawPlaylists(): Promise<YTPlaylist[]> {
  const items = await fetchAllPages<{ items: YTPlaylist[] }>(
    '/playlists',
    {
      part: 'snippet,contentDetails',
      channelId: CHANNEL_ID,
      maxResults: '50',
    },
    (d) => d.items ?? [],
  );
  return items as YTPlaylist[];
}

/** Fetch all playlist items (video IDs + basic snippets) for a playlist. */
async function fetchPlaylistItems(playlistId: string): Promise<YTPlaylistItem[]> {
  const items = await fetchAllPages<{ items: YTPlaylistItem[] }>(
    '/playlistItems',
    {
      part: 'snippet',
      playlistId,
      maxResults: '50',
    },
    (d) => d.items ?? [],
  );
  return items as YTPlaylistItem[];
}

/** Fetch full video details (duration) for a batch of video IDs. */
async function fetchVideoDetails(ids: string[]): Promise<Map<string, YTVideo>> {
  const map = new Map<string, YTVideo>();
  const batches = chunk(ids, 50);
  await Promise.all(
    batches.map(async (batch) => {
      const data = await ytFetch<{ items: YTVideo[] }>('/videos', {
        part: 'contentDetails,snippet',
        id: batch.join(','),
        maxResults: '50',
      });
      for (const v of data.items ?? []) {
        map.set(v.id, v);
      }
    }),
  );
  return map;
}

/** Build an NDVideo from raw playlist item + video detail. Returns null if short/live. */
function buildVideo(
  item: YTPlaylistItem,
  detail: YTVideo | undefined,
  playlistId: string,
  playlistTitle: string,
): NDVideo | null {
  if (!detail) return null;

  // Exclude live/upcoming
  if (
    item.snippet.liveBroadcastContent === 'upcoming' ||
    detail.snippet.liveBroadcastContent === 'live'
  ) {
    return null;
  }

  const durationSec = parseDurationSec(detail.contentDetails.duration);

  // Filter out Shorts (< 61 seconds)
  if (durationSec < MIN_DURATION_SEC) return null;

  const id = item.snippet.resourceId.videoId;
  return {
    id,
    title: item.snippet.title,
    description: item.snippet.description || detail.snippet.description || '',
    publishedAt: item.snippet.publishedAt,
    durationSec,
    durationLabel: formatDuration(durationSec),
    thumbnailUrl:
      bestThumbnail(item.snippet.thumbnails) || bestThumbnail(detail.snippet.thumbnails),
    youtubeUrl: `https://www.youtube.com/watch?v=${id}`,
    playlistId,
    playlistTitle,
  };
}

// ---------------------------------------------------------------------------
// Public API
// ---------------------------------------------------------------------------

let _playlistsCache: NDPlaylist[] | null = null;

/** Fetch and normalize all playlists + their long-form videos. Cached per build. */
export async function getPlaylists(): Promise<NDPlaylist[]> {
  if (_playlistsCache) return _playlistsCache;

  const rawPlaylists = await fetchRawPlaylists();

  const playlists = await Promise.all(
    rawPlaylists.map(async (pl): Promise<NDPlaylist> => {
      const items = await fetchPlaylistItems(pl.id);

      // Filter out deleted/private placeholders
      const validItems = items.filter(
        (i) => i.snippet.title !== 'Deleted video' && i.snippet.title !== 'Private video',
      );

      const videoIds = validItems.map((i) => i.snippet.resourceId.videoId);
      const details = await fetchVideoDetails(videoIds);

      const videos: NDVideo[] = [];
      for (const item of validItems) {
        const vid = buildVideo(
          item,
          details.get(item.snippet.resourceId.videoId),
          pl.id,
          pl.snippet.title,
        );
        if (vid) videos.push(vid);
      }

      // Sort newest first
      videos.sort(
        (a, b) => new Date(b.publishedAt).getTime() - new Date(a.publishedAt).getTime(),
      );

      const updatedAt = videos[0]?.publishedAt;

      return {
        id: pl.id,
        title: pl.snippet.title,
        description: pl.snippet.description || undefined,
        thumbnailUrl: bestThumbnail(pl.snippet.thumbnails) || videos[0]?.thumbnailUrl || '',
        videos,
        updatedAt,
        longFormCount: videos.length,
      };
    }),
  );

  // Sort playlists: most recently updated first
  playlists.sort((a, b) => {
    if (!a.updatedAt) return 1;
    if (!b.updatedAt) return -1;
    return new Date(b.updatedAt).getTime() - new Date(a.updatedAt).getTime();
  });

  _playlistsCache = playlists;
  return playlists;
}

/** Get a single playlist by ID. */
export async function getPlaylist(id: string): Promise<NDPlaylist | null> {
  const playlists = await getPlaylists();
  return playlists.find((p) => p.id === id) ?? null;
}

/** Get the latest long-form videos across all playlists, deduped, newest first. */
export async function getLatestVideos(limit = 12): Promise<NDVideo[]> {
  const playlists = await getPlaylists();

  const seen = new Set<string>();
  const all: NDVideo[] = [];

  for (const pl of playlists) {
    for (const v of pl.videos) {
      if (!seen.has(v.id)) {
        seen.add(v.id);
        all.push(v);
      }
    }
  }

  all.sort((a, b) => new Date(b.publishedAt).getTime() - new Date(a.publishedAt).getTime());
  return all.slice(0, limit);
}
