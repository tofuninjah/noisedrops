<?php

namespace App\Http\Controllers;


//use Cache;
use GuzzleHttp\Client as Guzzle;

class DropController extends Controller
{
    /**
     * The Guzzle client.
     *
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * Create a new DropController instance.
     *
     * @param Guzzle $guzzle
     */
    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function index()
    {
        return $this->fetchFeed();
    }

    /**
     * Fetch the Noisedrops feed.
     *
     * @return array
     */
    protected function fetchFeed()
    {

        //return Cache::remember('drops', 60 * 24 * 7, function () {
        $headers = [
            'Authorization' => 'Bearer ' . env('SIMPLECAST_TOKEN')
        ];

        $url = 'https://api.simplecast.com/podcasts/' . env('SIMPLECAST_PODCAST_ID') . '/episodes';

        return $this->guzzle->request('GET', $url, [
            'headers'  => $headers
        ])->getBody();
        //});
    }
}
