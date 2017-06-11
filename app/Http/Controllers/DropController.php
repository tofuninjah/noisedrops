<?php

namespace App\Http\Controllers;


use Cache;
use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Facades\DB;

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

        return Cache::remember('drops', 60 * 24 * 7, function() {

            $endpoint = 'https://api.simplecast.com/v1/podcasts/3085/episodes.json?api_key='
                        . config('services.simplecast.token');

            return json_decode($this->guzzle->get($endpoint)->getBody());
        });
    }
}
