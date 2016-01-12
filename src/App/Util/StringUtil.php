<?php

namespace App\Util;

abstract class StringUtil
{

    /**
     * Converts a string to camelCase with the option to capitalize
     * the first character
     *
     * @param $string
     * @param bool $ucFirst
     * @return string
     */
    public static function toCamel($string, $ucFirst = false)
    {
        $parts = preg_split("/[ _\-]/", $string);
        $parts = array_map('ucfirst', $parts);
        $string = implode('', $parts);

        if ($ucFirst === false) {
            $string = lcfirst($string);
        }

        return $string;
    }

}