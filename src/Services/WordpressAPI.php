<?php


namespace App\Services;


use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Class WordpressAPI
 * @package App\Services
 */
class WordpressAPI
{
    /**
     *
     */
    private const baseUrl = 'https://blog.construtoraplaneta.com.br/wp-json/wp/v2/';

    /**
     * @param $page
     * @return ResponseInterface
     */
    public static function getPosts($page): ResponseInterface
    {
        return (new Client)->get(self::getUrl($page));
    }

    /**
     * @param $page
     * @return string
     */
    public static function getUrl($page): string
    {
        return self::baseUrl . 'posts?per_page=100&page=' . $page;
    }
}