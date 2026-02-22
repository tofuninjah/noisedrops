import { defineConfig } from 'astro/config';
import tailwind from '@astrojs/tailwind';

export default defineConfig({
  site: 'https://noisedrops.com',
  integrations: [
    tailwind(),
  ],
});
