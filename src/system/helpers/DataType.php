<?php

namespace NovemBit\i18n\system\helpers;

class DataType
{

    const HTML = 'html';
    const JSON = 'json';
    const URL = 'url';
    const UNDEFINED = 0;

    /**
     * @param $string
     * @return bool
     */
    public static function isHTML($string)
    {
        return $string != strip_tags($string);
    }

    /**
     * @param $string
     * @return mixed
     */
    public static function isURL($string)
    {
        return filter_var($string, FILTER_VALIDATE_URL);
    }

    /**
     * @param $string
     * @return bool
     */
    public static function isJSON($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * @param $string
     * @param string $default
     * @return int|string
     */
    public static function getType($string, $default = self::UNDEFINED)
    {
        if (self::isURL($string)) {
            return self::URL;
        } elseif (self::isJSON($string)) {
            return self::JSON;
        } elseif (self::isHTML($string)) {
            return self::HTML;
        } else {
            return $default;
        }
    }
}