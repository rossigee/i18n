<?php
/**
 * Translation component
 * php version 7.2.10
 *
 * @category Component
 * @package  Translation
 * @author   Aaron Yordanyan <aaron.yor@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @version  GIT: @1.0.1@
 * @link     https://github.com/NovemBit/i18n
 */

namespace NovemBit\i18n\component\translation\type;

use Exception;
use NovemBit\i18n\component\Translation;
use NovemBit\i18n\system\helpers\DataType;

/**
 * JSON type for translation component
 *
 * @category Class
 * @package  JSON
 * @author   Aaron Yordanyan <aaron.yor@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link     https://github.com/NovemBit/i18n
 *
 * @property Translation context
 */
class JSON extends Type
{
    public $type = 4;

    public $validation = true;

    private $_objects = [];

    /**
     * Doing translate method
     *
     * @param array $jsons Jsons string array
     *
     * @return array
     * @throws Exception
     */
    public function doTranslate(array $jsons)
    {
        $languages = $this->context->getLanguages();

        $to_translate = [];
        $translations = [];
        $result = [];
        foreach ($jsons as $json) {
            $object = $this->_objects[$json];
            array_walk_recursive(
                $object,
                function (&$item) use (&$to_translate) {
                    $type = DataType::getType($item);
                    if ($type) {
                        $to_translate[$type][] = $item;
                    }
                }
            );
        }

        foreach ($to_translate as $type => $values) {
            $translations[$type] = $this->context->{$type}->translate($values);
        }

        foreach ($jsons as &$json) {
            foreach ($languages as $language) {
                $object = $this->_objects[$json];
                array_walk_recursive(
                    $object,
                    function (&$item) use ($translations, $language) {
                        $type = DataType::getType($item);
                        if ($type) {
                            $item = isset($translations[$type][$item][$language])
                                ? $translations[$type][$item][$language] :
                                $item;
                        }
                    }
                );
                $result[$json][$language] = json_encode($object);
            }
        }

        return $result;

        /*$translations = $this->context->method->translate($texts);
        foreach ($translations as $source => &$translation) {
            foreach ($translation as $language => &$text) {
                $text = htmlspecialchars_decode($text, ENT_QUOTES | ENT_HTML401);
            }
        }*/
        //return $translations;
    }

    /**
     * Validate json string before translate
     *
     * @param string $json Json string
     *
     * @return bool
     */
    public function validateBeforeTranslate(&$json)
    {
        $this->_objects[$json] = json_decode($json, true);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}