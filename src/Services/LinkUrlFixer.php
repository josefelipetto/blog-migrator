<?php


namespace App\Services;


/**
 * Class LinkUrlFixer
 * @package App\Services
 */
class LinkUrlFixer
{
    /**
     * @param $content
     * @return string|string[]
     */
    public static function fix($content)
    {
        return str_replace(
            '<a href="https://blog.construtoraplaneta.com.br/',
            '<a href="https://construtoraplaneta.com.br/blog/',
            $content
        );
    }
}