<?php

namespace NovemBit\i18n\component\localization\languages\interfaces;

use NovemBit\i18n\component\localization\interfaces\LocalizationType;

/**
 * @property
 * */
interface Languages extends LocalizationType
{

    /**
     * @param string $key
     * @param string $value
     * @return array
     */
    public function getLanguagesMap(string $key, string $value): array;

    /**
     * Get language code from url
     *
     * @param string|null $url Initial URL
     * @return string
     * @deprecated
     */
    public function getLanguageFromUrl(string $url);

    /**
     * Adding language code to
     * Already translated URL
     *
     * If `$language_on_path` is true then adding
     * Language code to beginning of url path
     *
     * If `$language_on_path` is false or url contains
     * Script name or directory path then adding only
     * Query parameter of language
     *
     * @param string $url Initial Url
     * @param string $language Language code
     * @param string|null $base_domain Base domain
     * @return string
     * @deprecated
     */
    public function addLanguageToUrl(
        string $url,
        string $language,
        ?string $base_domain = null
    );

    /**
     * Validate one language
     * Check if language exists in `$accepted_languages` array
     *
     * @param string $language Language code
     *
     * @return mixed
     * @deprecated
     */
    public function validateLanguage(string $language): bool;

    /**
     * Validate list of Languages
     * Check if each language code exists on
     * Accepted languages list
     *
     * @param string[] $languages language codes
     *
     * @return bool
     * @deprecated
     */
    public function validateLanguages(array $languages): bool;

    /**
     * Get main content (from) language
     * @return string
     * @deprecated
     */
    public function getFromLanguage(): string;

    /**
     * Set main from language
     *
     * @param string $from_language from language code
     * @return void
     * @deprecated
     */
    public function setFromLanguage(string $from_language): void;

    /**
     * Get default language
     *
     * @param string|null $base_domain Base domain
     * @return string
     * @deprecated
     */
    public function getDefaultLanguage(?string $base_domain = null): string;

    /**
     * Remove executable file from url path
     *
     * @param string $url Initial URL
     *
     * @return string
     */
    public function removeScriptNameFromUrl(string $url): string;

    /**
     * Get language query key
     * @return string
     * @deprecated
     */
    public function getLanguageQueryKey(): string;

    /**
     * Get accept languages
     *
     * @param bool $assoc Return assoc with whole data
     * @param string|null $base_domain Base Domain
     *
     * @return array
     * @deprecated use localization->getAcceptLanguages()
     */
    public function getAcceptLanguages(
        bool $assoc = false,
        ?string $base_domain = null
    ): array;

    /**
     * Get default config by `$base_domain` name
     *
     * @param string|null $base_domain base domain name
     * @return array
     * @deprecated
     */
    public function getLocalizationConfig(?string $base_domain = null): array;

    /**
     * Get flag of language country
     *
     * @param string $code Language code
     * @param bool $html return html <img src="..
     *
     * @return string
     */
    public function getLanguageFlagByCode(string $code, $html = false): string;

    /**
     * Get language whole data
     *
     * @param string $language_key Language key
     *
     * @return array
     */
    public function getLanguageData(string $language_key): array;

    /**
     * Get language name by code
     *
     * @param string $code Language key
     *
     * @return string
     */
    public function getLanguageNameByCode(string $code): string;

    public function getLanguageDirectionByCode(string $code): string;
}
