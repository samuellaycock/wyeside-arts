<?php

namespace App\Util;

abstract class StringUtil
{

    /**
     * Generate a random string of x length and with values of y
     *
     * @param int $length
     * @param null $possible
     * @return string
     */
    public static function genRndStr($length = 8, $possible = null)
    {
        if (!$possible || strlen($possible) < 1) {
            $possible = "0123456789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
        }

        if ($length < 1) {
            $length = 1;
        }

        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            $string .= $char;
        }

        return $string;
    }

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


    /**
     * @param $string
     * @return mixed
     */
    public static function getExtension($string)
    {
        $parts = explode('.', $string);
        return array_pop($parts);
    }


}