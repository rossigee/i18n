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

use Google\Cloud\Core\Exception\GoogleException;
use Google\Cloud\Translate\TranslateClient;
//use Google\Cloud\Translate\V2\TranslateClient;
use NovemBit\i18n\component\translation\exceptions\TranslationException;
use NovemBit\i18n\component\translation\method\exceptions\MethodException;
use NovemBit\i18n\component\translation\Translation;

/**
 * Google Translate method of translation
 *
 * @category Component\Translation\Method
 * @package  Component\Translation\Method
 * @author   Aaron Yordanyan <aaron.yor@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link     https://github.com/NovemBit/i18n
 *
 * @property Translation context
 */
class Google extends Method
{
    /**
     * Google console api key for GT
     *
     * @var string
     * */
    public $api_key;

    /**
     * {@inheritdoc}
     * */
    public $exclusion_pattern = '<span translate="no">$0</span>';

    /**
     * {@inheritdoc}
     *
     * @return void
     * @throws MethodException
     */
    public function mainInit(): void
    {
        if (!isset($this->api_key)) {
            throw new MethodException('Missing Google Cloud Translate API key.');
        }
    }

    /**
     * Doing translate method
     *
     * @param array $texts Array of texts to translate
     *
     * @return array
     */
    protected function doTranslate(
        array $texts,
        string $from_language,
        array $to_languages,
        bool $ignore_cache
    ): array {

        $result = [];

        foreach ($to_languages as $language) {
            if ($from_language == $language) {
                foreach ($texts as $text) {
                    $result[$text][$language] = $text;
                }
                continue;
            }

            $this->_translateOneLanguage($texts, $from_language, $language, $result);
        }

        return $result;
    }


    /**
     * Translate texts to only one language
     *
     * @param array $texts Array of translatable texts
     * @param string $to_language Language code
     * @param array $result Referenced variable of results
     *
     * @return void
     * @throws \Exception
     */
    private function _translateOneLanguage(
        array $texts,
        string $from_language,
        string $to_language,
        array &$result
    ): void {

        $request_data = array(
            'key' => $this->api_key,
            'source' => $from_language,
            'target' => $to_language
        );
        /*if( ! empty( $credentials[ 'referer' ] ) ){
            $request_data['restOptions'] = array(
                'headers' => array(
                    'referer' => $credentials[ 'referer' ]
                )
            );
        }*/
        $gt_client = new  TranslateClient($request_data);
        $translations = [];

        try {
            // todo: count the character
            $chunks = array_chunk($texts, 100);
            foreach ($chunks as $chunk) {
                $translations = array_merge(
                    $translations,
                    $gt_client->translateBatch($chunk)
                );
            }
        } catch (GoogleException $e) {

            $message = json_encode($e->getMessage()) ?? [];

            $this->getLogger()->error(
                $message['message'] ?? 'Google Translate: Undefined error.'
            );
            /*
             * TODO: Make logger to log errors of GT
             * */
        }

        foreach ($translations as $key => $item) {
            $node = str_replace(
                array('<span translate="no">', '</span>'),
                '',
                $item['text']
            );

            if (!empty($node)) {
                $result[$item['input']][$to_language] = $node;
            }
        }
    }
}