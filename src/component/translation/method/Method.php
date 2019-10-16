<?php
/**
 * Translation component
 * php version 7.2.10
 *
 * @category Component\Translation\Method
 * @package  Component\Translation\Method
 * @author   Aaron Yordanyan <aaron.yor@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @version  GIT: @1.0.1@
 * @link     https://github.com/NovemBit/i18n
 */


namespace NovemBit\i18n\component\translation\method;

use NovemBit\i18n\component\translation\Translation;
use NovemBit\i18n\component\translation\Translator;


/**
 * Main Translation method abstract
 * Any method of translation must extends this class
 *
 * @category Component\Translation\Method
 * @package  Component\Translation\Method
 * @author   Aaron Yordanyan <aaron.yor@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link     https://github.com/NovemBit/i18n
 *
 * @property Translation context
 */
abstract class Method extends Translator implements interfaces\Method
{

    const NAME = 'method';

    /**
     * Determine default type of Method always 0
     *
     * @var int
     * */
    public $type = 0;

    /**
     * Validate text before Translate
     *
     * @param string $text Text to validate
     *
     * @return bool
     */
    public function validateBeforeTranslate(&$text)
    {
        $this->_clarifyText($text);

        return parent::validateBeforeTranslate(
            $text
        );
    }

    /**
     * Validate text after translate
     *
     * @param string $before     Initial text
     * @param string $after      Final text
     * @param array  $translates Referenced variable of translations
     *
     * @return bool
     */
    public function validateAfterTranslate($before, $after, &$translates)
    {

        preg_match('/(^\s+|^).*?(\s+$|$)/', $before, $matches);

        $prefix = isset($matches[1]) ? $matches[1] : '';
        $suffix = isset($matches[2]) ? $matches[2] : '';

        foreach ($translates[$before] as &$node) {
            $node = $prefix . $node . $suffix;
        }

        return parent::validateAfterTranslate(
            $before,
            $after,
            $translates
        );
    }

    /**
     * Clarify string method
     *
     * @param string $string Referenced variable of initial string
     *
     * @return void
     */
    private function _clarifyText(string & $string)
    {

        /*
         * Whitespace
         * */
        //        $string = preg_replace('/\s+/', ' ', $string);

        /*
         * First and last spaces
         * */
        $string = trim($string, ' ');

    }

}