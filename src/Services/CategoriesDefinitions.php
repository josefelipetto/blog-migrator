<?php


namespace App\Services;


/**
 * Class CategoriesDefinitions
 * @package App\Services
 */
class CategoriesDefinitions
{
    /**
     *
     */
    public const categoriesMap = [
        1 => 6,
        3 => 8,
        4 => 10,
        6 => 9,
        8 => 14,
        9 => 4,
        10 => 13,
        11 => 17,
        12 => 16,
        13 => 18,
        14 => 12,
        16 => 7,
        17 => 15,
        19 => 5,
        20 => 11,
    ];

    /**
     * @param $wordpressCategoryId
     * @return mixed
     */
    public static function getOctoberCategoryId($wordpressCategoryId)
    {
        return self::categoriesMap[$wordpressCategoryId];
    }

}