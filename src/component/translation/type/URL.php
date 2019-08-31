<?php

namespace NovemBit\i18n\component\translation\type;

use Exception;
use NovemBit\i18n\component\Translation;

/**
 * @property  Translation context
 */
class URL extends Type
{

    public $type = 2;

    public $path_separator = "-";

    public $path_lowercase = true;

    public $alias_domains = [];

    public $validation = true;

    /**
     * Validate url with parts
     * For each part you can write custom rules
     * If rule is not valid then excluding URL
     * */
    public $url_validation_rules = [];


    /**
     * Init component
     */
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

//        $this->url_validation_rules['path'][] = '^(?!^\/$).+$';
    }

    /**
     * @param array $urls
     *
     * @return array
     * @throws Exception
     */
    public function doTranslate(array $urls)
    {

        $languages          = $this->context->getLanguages();
        $paths              = [];
        $paths_to_translate = [];

        foreach ($urls as $url) {
            $parts              = $this->getUrlParts($url);
            $path               = isset($parts['path']) ? $parts['path'] : "";
            $to_translate       = $this->getPathParts($path);
            $paths[]            = $to_translate;
            $paths_to_translate = array_merge($paths_to_translate, $to_translate);
        }

        $translations = $this->getPathPartTranslations($paths_to_translate);

        $result = $this->buildTranslateResult($paths, $languages, $translations);

        return $result;
    }

    /**
     * @param $before
     * @param $after
     * @param $translates
     *
     * @return bool
     */
    public function validateAfterTranslate($before, $after, &$translates)
    {
        self::getStringsDifference($before, $after, $prefix, $suffix);

        $translates[$before] = $translates[$after];
        foreach ($translates[$before] as $language => &$translate) {

            $translate = $prefix . $translate . $suffix;
//                $translate = \NovemBit\i18n\system\helpers\URL::addQueryVars($translate, $this->context->context->languages->language_query_key, $language);
            $translate = $this->context->context->languages->addLanguageToUrl($translate, $language);

        }


        return parent::validateAfterTranslate($before, $after, $translates); // TODO: Change the autogenerated stub
    }

    /**
     * @param $url
     *
     * @return bool
     */
    public function validateBeforeTranslate(&$url)
    {
        $url = trim($url,' ');

        $parts = parse_url($url);

        foreach ($this->url_validation_rules as $key => $rules) {
            if ( ! isset($parts[$key])) {
                $parts[$key] = '';
            }
            foreach ($rules as $rule) {
                if ( ! preg_match("/$rule/", $parts[$key])) {
                    return false;

                }
            }
        }

        $url = isset($parts['path']) ? $parts['path'] : '';

        $url = $this->context->context->languages->removeScriptNameFromUrl($url);

        $url = rtrim($url, '/');

        return true;

    }


    /**
     * @param array $paths
     * @param array $languages
     * @param array $translations
     *
     * @return array
     */
    private function buildTranslateResult(
        array $paths,
        array $languages,
        array $translations
    ) {

        $result = [];

        foreach ($paths as $path_parts) {

            $path = implode('/', $path_parts);
            /*
             * To build last result fetching languages
             * And building result with language keys
             * */
            foreach ($languages as $language) {

                $language_path_parts = $path_parts;

                foreach ($language_path_parts as &$part) {


                    /*
                     * If translation found
                     * */
                    if (isset($translations[$part])) {

                        /* if(!isset($translations[$part][$language])){
                             var_dump('---');
                             var_dump($translations[$part]);
                         }*/
                        $part = $translations[$part][$language];
                    }
                    /**
                     * If translator returns string that contains
                     * Unwanted characters, then clarifying string
                     * */
                    $part = $this->preparePathPart($part);
                }

                /**
                 * Restore path trailing slashes
                 * */
                $translate = implode('/', $language_path_parts);

                /*
                 * Appending translated url to result
                 * */
                $result[$path][$language] = $translate;
            }
        }

        return $result;
    }

    /**
     * @param array $strings
     *
     * @return mixed
     * @throws Exception
     */
    private function getPathPartTranslations(array $strings)
    {
        foreach ($strings as &$string) {
            $string = (string)$string;
        }

        $translate = $this->context->text->translate($strings);

        return $translate;
    }

    /**
     * Get path parts slash delimited
     *
     * @param $path
     *
     * @return array
     */
    private function getPathParts($path)
    {

        $path = trim($path, '/');

        /*
         * Separate path parts
         * */
        $parts = explode('/', $path);

        return $parts;
    }

    /**
     * @param $url
     *
     * @return mixed
     */
    private function getUrlParts($url)
    {
        $parts = parse_url($url);

        return $parts;
    }

    /**
     * @param $string
     *
     * @return string|null
     */
    private function preparePathPart($string)
    {
        /**
         * Remove all html special characters
         * @source https://stackoverflow.com/a/657670
         * */
        $string = preg_replace("/&#?[a-z0-9]{2,8};/i", "", $string);

        /**
         * Replace all non-alphanumeric characters to whitespace
         * To make url SEO friendly
         * */
        $string = preg_replace('/(?:\W|_)+/u', $this->path_separator, $string);

        /**
         * Remove "-" symbol from start and end of string
         * */
        $string = trim($string, $this->path_separator);

        if ($this->path_lowercase !== false) {
            /**
             * String to lowercase
             * */
            $string = strtolower($string);
        }

        return $string;
    }

    public function validateBeforeReTranslate(&$url)
    {
        $parts = parse_url($url);

        foreach ($this->url_validation_rules as $key => $rules) {
            if ( ! isset($parts[$key])) {
                $parts[$key] = '';
            }
            foreach ($rules as $rule) {
                if ( ! preg_match("/$rule/", $parts[$key])) {
                    return false;

                }
            }
        }

        $url = isset($parts['path']) ? $parts['path'] : '';

        $url = $this->context->context->languages->removeScriptNameFromUrl($url);

        $url = rtrim($url, '/');

        return true;

    }

    /**
     * @param $before
     * @param $after
     *
     * @param $prefix
     * @param $suffix
     *
     * @return void
     */
    private static function getStringsDifference($before, $after, &$prefix = null, &$suffix = null)
    {
        $prefix = $before;
        $suffix = '';

        if ($after != '') {
            $pos    = strpos($before, $after);
            $prefix = substr($before, 0, $pos);
            $suffix = substr(
                $before,
                strlen($prefix) +
                strlen($after),
                strlen($before)
            );
        }

    }

    /**
     * @param $before
     * @param $after
     * @param $result
     *
     * @return bool
     */
    public function validateAfterReTranslate($before, $after, &$result)
    {
        self::getStringsDifference($before, $after, $prefix, $suffix);

        if ($before != $after && isset($result[$after])) {
            $result[$before] = $prefix . $result[$after] . $suffix;
        }

        $result[$before] = \NovemBit\i18n\system\helpers\URL::removeQueryVars($result[$before],
            $this->context->context->languages->language_query_key);

        return parent::validateAfterReTranslate($before, $after, $result); // TODO: Change the autogenerated stub
    }
}