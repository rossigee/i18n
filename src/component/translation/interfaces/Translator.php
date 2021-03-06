<?php


namespace NovemBit\i18n\component\translation\interfaces;


use Doctrine\DBAL\ConnectionException;
use NovemBit\i18n\system\interfaces\Component;
use Psr\SimpleCache\InvalidArgumentException;

interface Translator extends Component
{

    /**
     * @throws ConnectionException
     * @throws InvalidArgumentException
     * */
    public function translate(
        array $texts,
        ?array &$verbose = null,
        bool $only_saved = false,
        bool $ignore_cache = false
    ): array;


    public function saveModels(
        $translations,
        $level = 0,
        $overwrite = false,
        &$result = []
    ): void;

    public function getModels(
        array $texts,
        string $from_language,
        array $to_languages,
        bool $reverse = false
    ): array;

    public function reTranslate(
        array $texts
    ): array;

    public function isCacheResult(): ?bool;

    public function setCacheResult(?bool $cache_status): void;

    public function getHelperAttributes() : bool;

    public function setHelperAttributes(bool $status) : void;
}