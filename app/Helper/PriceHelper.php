<?php
/**
 * Created by PhpStorm.
 * User: yahya
 * Date: 21-Feb-19
 * Time: 15:05
 */

if (!function_exists('getPriceText')) {
    function getPriceText($price = 0)
    {
        return $price > 0 ? 'Rp. ' . number_format($price, 0, ',', '.') : '-';
    }
}

if (!function_exists('getPriceShortText')) {
    function getPriceShortText($price = 0)
    {
        if ($price > 0 && $price < 1000) {
            return $price;
        }
        if ($price >= 1000 && $price < 1000000) {
            return $price / 1000 . 'rb';
        }
        if ($price >= 1000000) {
            return $price / 1000000 . 'jt';
        }

        return 'Gratis';
    }
}