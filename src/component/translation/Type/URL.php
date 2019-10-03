<?php
/**
 * Url translation component
 * php version 7.2.10
 *
 * @category Component\Translation\Type
 * @package  Component\Translation\Type
 * @author   Aaron Yordanyan <aaron.yor@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @version  GIT: @1.0.1@
 * @link     https://github.com/NovemBit/i18n
 */

namespace NovemBit\i18n\component\translation\Type;

use Exception;
use NovemBit\i18n\component\translation\Translation;

/**
 * Url translation component
 * Translate urls paths and build fully working url
 *
 * @category Component\Translation\Type
 * @package  Component\Translation\Type
 * @author   Aaron Yordanyan <aaron.yor@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link     https://github.com/NovemBit/i18n
 *
 * @property Translation context
 * */
class URL extends Type
{

    /**
     * {@inheritdoc}
     * */
    public $type = 2;

    /**
     * Path separator
     * Using as whitespace replacement
     *
     * @var string
     * */
    public $path_separator = "-";

    /**
     * If true, then making all path elements lowercase
     *
     * @var bool
     * */
    public $path_lowercase = true;

    /**
     * {@inheritdoc}
     * */
    public $validation = true;

    /**
     * Validate url with parts
     * For each part you can write custom rules
     * If rule is not valid then excluding URL
     *
     * @var array
     * */
    public $url_validation_rules = [];

    /**
     * Doing translation method
     *
     * @param array $urls list of urls
     *
     * @return array
     * @throws Exception
     */
    public function doTranslate(array $urls)
    {

        $languages = $this->context->getLanguages();
        $paths = [];
        $paths_to_translate = [];

        foreach ($urls as $url) {
            $parts = $this->_getUrlParts($url);
            $path = isset($parts['path']) ? $parts['path'] : "";
            $to_translate = $this->_getPathParts($path);
            $paths[] = $to_translate;
            $paths_to_translate = array_merge($paths_to_translate, $to_translate);
        }

        $translations = $this->_getPathPartTranslations($paths_to_translate);

        $result = $this->_buildTranslateResult($paths, $languages, $translations);

        return $result;
    }

    /**
     * Validate after translate
     * Concat prefix, body and suffix to avoid that
     * Url is fully working
     *
     * @param string $before     initial type of url
     * @param string $after      final type of url
     * @param array  $translates list of translated urls
     *
     * @return bool
     * @throws \NovemBit\i18n\system\exception\Exception
     */
    public function validateAfterTranslate($before, $after, &$translates)
    {
        self::_getStringsDifference($before, $after, $prefix, $suffix);

        $translates[$before] = $translates[$after];
        foreach ($translates[$before] as $language => &$translate) {

            $translate = $prefix . $translate . $suffix;
            $translate = $this->context->context
                ->languages->addLanguageToUrl($translate, $language);

        }

        return parent::validateAfterTranslate(
            $before, $after, $translates
        );
    }

    /**
     * Validate before translate
     * Take parts that must be preserved to concat
     * after translate paths
     *
     *  Removing script name from url to make avoid
     *  that translatable part of url is only working path
     *
     * @param string $url Translatable url
     *
     * @return bool
     */
    public function validateBeforeTranslate(&$url)
    {
        $url = trim($url, ' ');

        $parts = parse_url($url);

        foreach ($this->url_validation_rules as $key => $rules) {
            if (!isset($parts[$key])) {
                $parts[$key] = '';
            }
            foreach ($rules as $rule) {
                if (!preg_match("/$rule/", $parts[$key])) {
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
     * Building translation result that
     * must be returned
     *
     * @param array $paths        whole translatable paths
     * @param array $languages    list of languages
     * @param array $translations translated paths
     *
     * @return array
     */
    private function _buildTranslateResult(
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
                        $part = isset($translations[$part][$language]) ?
                            $translations[$part][$language] :
                            $part;
                    }
                    /**
                     * If translator returns string that contains
                     * Unwanted characters, then clarifying string
                     * */
                    $part = $this->_preparePathPart($part);
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
     * Get path translations
     * Translate with translation component as text
     *
     * @param array $paths paths to translate
     *
     * @return mixed
     * @throws Exception
     */
    private function _getPathPartTranslations(array $paths)
    {
        foreach ($paths as &$string) {
            $string = (string)$string;
        }

        $translate = $this->context->text->translate($paths);

        return $translate;
    }

    /**
     * Get path parts slash delimited
     * Explode path to get parts of path as array
     *
     * @param string $path path to split parts
     *
     * @return array
     */
    private function _getPathParts($path)
    {

        $path = trim($path, '/');

        /*
         * Separate path parts
         * */
        $parts = explode('/', $path);

        return $parts;
    }

    /**
     * Get url parts, using @parse_url PHP method
     *
     * @param string $url parsable URL
     *
     * @return mixed
     */
    private function _getUrlParts($url)
    {
        $parts = parse_url($url);

        return $parts;
    }

    /**
     * Clarify and prepare path part
     * Using before translate
     *
     * @param string $url Simple url
     *
     * @return string|null
     */
    private function _preparePathPart($url)
    {
        /**
         * Remove all html special characters
         *
         * @source https://stackoverflow.com/a/657670
         * */
        $url = preg_replace("/&#?[a-z0-9]{2,8};/i", "", $url);

        /**
         * Replace all non-alphanumeric characters to whitespace
         * To make url SEO friendly
         * */
        $url = preg_replace('/(?:\W|_)+/u', $this->path_separator, $url);

        /**
         * Remove "-" symbol from start and end of string
         * */
        $url = trim($url, $this->path_separator);

        if ($this->path_lowercase) {

            /**
             * String to lowercase
             * */
            $url = mb_strtolower($url);
        }

        return $url;
    }

    /**
     * Validate URL before ReTranslate
     *
     * @param string $url Re translatable URL
     *
     * @return bool
     */
    public function validateBeforeReTranslate(&$url)
    {
        $url = trim($url, ' ');

        $parts = parse_url($url);

        foreach ($this->url_validation_rules as $key => $rules) {
            if (!isset($parts[$key])) {
                $parts[$key] = '';
            }
            foreach ($rules as $rule) {
                if (!preg_match("/$rule/", $parts[$key])) {
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
     * Get string difference
     *
     * @param string      $before Initial type of string
     * @param string      $after  Final type of string
     * @param string|null $prefix Referenced variable to receive difference prefix
     * @param string|null $suffix Referenced variable to receive difference suffix
     *
     * @return void
     */
    private static function _getStringsDifference(
        $before,
        $after,
        &$prefix = null,
        &$suffix = null
    ) {
        $prefix = $before;
        $suffix = '';

        if ($after != '') {
            $pos = strpos($before, $after);
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
     * Validate result after ReTranslate
     *  Remove language key from query variables
     *
     * @param string $before initial url
     * @param string $after  final url
     * @param array  $result Referenced variable to receive result
     *
     * @return bool
     */
    public function validateAfterReTranslate($before, $after, &$result)
    {
        self::_getStringsDifference($before, $after, $prefix, $suffix);

        if ($before != $after && isset($result[$after])) {
            $result[$before] = $prefix . $result[$after] . $suffix;
        }

        $result[$before] = \NovemBit\i18n\system\helpers\URL::removeQueryVars(
            $result[$before],
            $this->context->context->languages->getLanguageQueryKey()
        );

        return parent::validateAfterReTranslate(
            $before,
            $after,
            $result
        ); // TODO: Change the autogenerated stub
    }
}