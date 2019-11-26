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


use NovemBit\i18n\component\translation\exceptions\TranslationException;
use NovemBit\i18n\component\translation\Translator;
use NovemBit\i18n\system\helpers\URL;
use \NovemBit\i18n\component\translation\interfaces;

/**
 * Rest Translate method of translation
 *
 * @category Component\Translation\Method
 * @package  Component\Translation\Method
 * @author   Aaron Yordanyan <aaron.yor@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link     https://github.com/NovemBit/i18n
 *
 * @property interfaces\Translation context
 */
class Rest extends Method
{

    /**
     * Version of REST API
     *
     * @var string
     * */
    public $api_version = "1";

    /**
     * Use SSL protocol
     *
     * @var bool
     * */
    public $ssl = false;

    /**
     * Rest api remote host
     *
     * @var string
     * */
    public $remote_host;

    /**
     * Remote path of API
     *
     * @var string
     * @see Rest::$endpoint
     * */
    public $remote_path = 'i18n/rest/v1';

    /**
     * Key of Remote REST api service
     *
     * @var string
     * @see \NovemBit\i18n\component\rest\Rest::$api_keys
     * */
    public $api_key;

    /**
     * Doing translate method
     *
     * @param array $texts Array of texts to translate
     * @param string $from_language
     * @param array $to_languages
     *
     * @return array
     * @throws TranslationException
     * @throws \Exception
     */
    protected function doTranslate(
        array $texts,
        string $from_language,
        array $to_languages
    ): array {

        $translation = [];
        $url = URL::buildUrl(
            [
                'scheme' => $this->ssl ? "https" : "http",
                'host' => $this->remote_host,
                'path' => $this->remote_path . "/translate",
                'query' => 'api_key=' . $this->api_key
            ]
        );

        $ch = curl_init($url);

        $query = [
            'languages' => $to_languages,
            'languages_config' => $this->getLanguagesConfig(),
            'texts' => $texts,
        ];

        $data = http_build_query(
            $query
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Tell cURL that it should only spend 10 seconds
        //trying to connect to the URL in question.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        //A given cURL operation should only take
        //30 seconds max.
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $result = curl_exec($ch);

        if ($result === false) {

            /**
             * Error reporting for dynamic hub
             * */
            $this->getLogger()->error(
                'Rest endpoint: not responding.'
            );

            return [];
        }

        curl_close($ch);

        $result = json_decode($result, true);

        if ($result['status'] == 1) {
            $translation = $result['translation'];
        } else {

            $this->getLogger()->warning(
                'Rest endpoint: negative response.'
            );

        }

        return $translation;
    }

    /**
     * Get languages configuration from main module instance `$config`
     *
     * @return array
     * @throws TranslationException
     */
    public function getLanguagesConfig(): array
    {
        $config = $this->context->context->config['languages'] ?? null;

        if ($config == null) {

            throw new TranslationException("Languages config not found.");
        }

        unset($config['class']);

        return $config;
    }

}