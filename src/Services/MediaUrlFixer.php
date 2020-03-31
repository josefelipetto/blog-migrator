<?php


namespace App\Services;


/**
 * Class MediaUrlFixer
 * @package App\Services
 */
class MediaUrlFixer
{
    /**
     *
     */
    public const URL_FROM = 'https://blog.construtoraplaneta.com.br/wp-content/uploads/';

    /**
     * @param $content
     * @param bool $isFeaturedMedia
     * @return string
     */
    public static function fix($content, $isFeaturedMedia = true) : string
    {
        return str_replace(
            self::URL_FROM,
            $isFeaturedMedia ? '/' : 'https://construtoraplaneta.com.br/storage/app/media/',
            $content
        );
    }
}