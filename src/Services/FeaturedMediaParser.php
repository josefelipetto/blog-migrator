<?php


namespace App\Services;


use GuzzleHttp\Client;
use stdClass;

class FeaturedMediaParser
{
    public static function get(array $featuredMediaJson) : ?string
    {
        $href = $featuredMediaJson[0]['href'];

        $request = (new Client)->get($href);

        $response = json_decode($request->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);

        return $response->guid->rendered;
    }
}