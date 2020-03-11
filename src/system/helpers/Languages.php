<?php


namespace NovemBit\i18n\system\helpers;


class Languages extends LocalData
{
    /**
     * @param string      $key
     * @param string      $by
     * @param string|null $return
     *
     * @return mixed|null
     */
    public static function getLanguage(
        string $key,
        string $by = 'alpha1',
        ?string $return = 'name'
    ) {
        return self::get($key, $by, $return);
    }

    public static function getLanguages()
    {
        return self::getData();
    }

    /**
     * ISO 639-1 languages list
     *
     * @return array
     * */
    public static function getData(): array
    {
        return [
            ['alpha1' => 'ab', 'name' => 'Abkhazian', 'native' => 'Abkhazian', 'countries' => ['ab']],
            ['alpha1' => 'aa', 'name' => 'Afar', 'native' => 'Afar', 'countries' => ['aa']],
            ['alpha1' => 'af', 'name' => 'Afrikaans', 'native' => 'Afrikaans', 'countries' => ['af']],
            ['alpha1' => 'ak', 'name' => 'Akan', 'native' => 'Akan', 'countries' => ['ak']],
            ['alpha1' => 'sq', 'name' => 'Albanian', 'native' => 'Albanian', 'countries' => ['sq']],
            ['alpha1' => 'am', 'name' => 'Amharic', 'native' => 'Amharic', 'countries' => ['am']],
            ['alpha1' => 'ar', 'name' => 'Arabic', 'native' => 'Arabic', 'countries' => ['ae'], "dir" => "rtl"],
            ['alpha1' => 'an', 'name' => 'Aragonese', 'native' => 'Aragonese', 'countries' => ['an']],
            ['alpha1' => 'hy', 'name' => 'Armenian', 'native' => 'Armenian', 'countries' => ['am']],
            ['alpha1' => 'as', 'name' => 'Assamese', 'native' => 'Assamese', 'countries' => ['as']],
            ['alpha1' => 'av', 'name' => 'Avaric', 'native' => 'Avaric', 'countries' => ['av']],
            ['alpha1' => 'ae', 'name' => 'Avestan', 'native' => 'Avestan', 'countries' => ['ae']],
            ['alpha1' => 'ay', 'name' => 'Aymara', 'native' => 'Aymara', 'countries' => ['ay']],
            ['alpha1' => 'az', 'name' => 'Azerbaijani', 'native' => 'Azerbaijani', 'countries' => ['az']],
            ['alpha1' => 'bm', 'name' => 'Bambara', 'native' => 'Bambara', 'countries' => ['bm']],
            ['alpha1' => 'ba', 'name' => 'Bashkir', 'native' => 'Bashkir', 'countries' => ['ba']],
            ['alpha1' => 'eu', 'name' => 'Basque', 'native' => 'Basque', 'countries' => ['eu']],
            ['alpha1' => 'be', 'name' => 'Belarusian', 'native' => 'Belarusian', 'countries' => ['be']],
            ['alpha1' => 'bn', 'name' => 'Bengali', 'native' => 'Bengali', 'countries' => ['bn']],
            ['alpha1' => 'bh', 'name' => 'Bihari languages', 'native' => 'Bihari languages', 'countries' => ['bh']],
            ['alpha1' => 'bi', 'name' => 'Bislama', 'native' => 'Bislama', 'countries' => ['bi']],
            ['alpha1' => 'bs', 'name' => 'Bosnian', 'native' => 'Bosnian', 'countries' => ['bs']],
            ['alpha1' => 'br', 'name' => 'Breton', 'native' => 'Breton', 'countries' => ['br']],
            ['alpha1' => 'bg', 'name' => 'Bulgarian', 'native' => 'Bulgarian', 'countries' => ['bg']],
            ['alpha1' => 'my', 'name' => 'Burmese', 'native' => 'Burmese', 'countries' => ['my']],
            ['alpha1' => 'ca', 'name' => 'Catalan', 'native' => 'Catalan', 'countries' => ['ca']],
            ['alpha1' => 'km', 'name' => 'Central Khmer', 'native' => 'Central Khmer', 'countries' => ['km']],
            ['alpha1' => 'ch', 'name' => 'Chamorro', 'native' => 'Chamorro', 'countries' => ['ch']],
            ['alpha1' => 'ce', 'name' => 'Chechen', 'native' => 'Chechen', 'countries' => ['ce']],
            ['alpha1' => 'ny', 'name' => 'Chichewa', 'native' => 'Chichewa', 'countries' => ['mw']],
            ['alpha1' => 'zh', 'name' => 'Chinese', 'native' => 'Chinese', 'countries' => ['zh']],
            ['alpha1' => 'cu', 'name' => 'Church Slavonic', 'native' => 'Church Slavonic', 'countries' => ['cu']],
            ['alpha1' => 'cv', 'name' => 'Chuvash', 'native' => 'Chuvash', 'countries' => ['cv']],
            ['alpha1' => 'kw', 'name' => 'Cornish', 'native' => 'Cornish', 'countries' => ['kw']],
            ['alpha1' => 'co', 'name' => 'Corsican', 'native' => 'Corsican', 'countries' => ['co']],
            ['alpha1' => 'cr', 'name' => 'Cree', 'native' => 'Cree', 'countries' => ['cr']],
            ['alpha1' => 'hr', 'name' => 'Croatian', 'native' => 'Croatian', 'countries' => ['hr']],
            ['alpha1' => 'cs', 'name' => 'Czech', 'native' => 'Czech', 'countries' => ['cz']],
            ['alpha1' => 'da', 'name' => 'Danish', 'native' => 'Danish', 'countries' => ['dk']],
            ['alpha1' => 'dv', 'name' => 'Divehi', 'native' => 'Divehi', 'countries' => ['dv']],
            ['alpha1' => 'nl', 'name' => 'Dutch', 'native' => 'Dutch', 'countries' => ['nl']],
            ['alpha1' => 'dz', 'name' => 'Dzongkha', 'native' => 'Dzongkha', 'countries' => ['dz']],
            ['alpha1' => 'en', 'name' => 'English', 'native' => 'English', 'countries' => ['gb']],
            ['alpha1' => 'eo', 'name' => 'Esperanto', 'native' => 'Esperanto', 'countries' => ['eo']],
            ['alpha1' => 'et', 'name' => 'Estonian', 'native' => 'Estonian', 'countries' => ['ee']],
            ['alpha1' => 'ee', 'name' => 'Ewe', 'native' => 'Ewe', 'countries' => ['ee']],
            ['alpha1' => 'fo', 'name' => 'Faroese', 'native' => 'Faroese', 'countries' => ['fo']],
            ['alpha1' => 'fj', 'name' => 'Fijian', 'native' => 'Fijian', 'countries' => ['fj']],
            ['alpha1' => 'fi', 'name' => 'Finnish', 'native' => 'Finnish', 'countries' => ['fi']],
            ['alpha1' => 'fr', 'name' => 'French', 'native' => 'French', 'countries' => ['fr']],
            ['alpha1' => 'ff', 'name' => 'Fulah', 'native' => 'Fulah', 'countries' => ['ff']],
            ['alpha1' => 'gd', 'name' => 'Gaelic', 'native' => 'Gaelic', 'countries' => ['gd']],
            ['alpha1' => 'gl', 'name' => 'Galician', 'native' => 'Galician', 'countries' => ['gl']],
            ['alpha1' => 'lg', 'name' => 'Ganda', 'native' => 'Ganda', 'countries' => ['lg']],
            ['alpha1' => 'ka', 'name' => 'Georgian', 'native' => 'Georgian', 'countries' => ['ka']],
            ['alpha1' => 'de', 'name' => 'German', 'native' => 'German', 'countries' => ['de']],
            ['alpha1' => 'ki', 'name' => 'Gikuyu (Kikuyu)', 'native' => 'Gikuyu (Kikuyu)', 'countries' => ['ki']],
            ['alpha1' => 'el', 'name' => 'Greek', 'native' => 'Ελληνικά', 'countries' => ['gr']],
            ['alpha1' => 'kl', 'name' => 'Greenlandic', 'native' => 'Greenlandic', 'countries' => ['kl']],
            ['alpha1' => 'gn', 'name' => 'Guarani', 'native' => 'Guarani', 'countries' => ['gn']],
            ['alpha1' => 'gu', 'name' => 'Gujarati', 'native' => 'Gujarati', 'countries' => ['gu']],
            ['alpha1' => 'ht', 'name' => 'Haitian', 'native' => 'Haitian', 'countries' => ['ht']],
            ['alpha1' => 'ha', 'name' => 'Hausa', 'native' => 'Hausa', 'countries' => ['ha']],
            ['alpha1' => 'he', 'name' => 'Hebrew', 'native' => 'Hebrew', 'countries' => ['he']],
            ['alpha1' => 'hz', 'name' => 'Herero', 'native' => 'Herero', 'countries' => ['hz']],
            ['alpha1' => 'hi', 'name' => 'Hindi', 'native' => 'Hindi', 'countries' => ['hi']],
            ['alpha1' => 'ho', 'name' => 'Hiri Motu', 'native' => 'Hiri Motu', 'countries' => ['ho']],
            ['alpha1' => 'hu', 'name' => 'Hungarian', 'native' => 'Hungarian', 'countries' => ['hu']],
            ['alpha1' => 'is', 'name' => 'Icelandic', 'native' => 'Icelandic', 'countries' => ['is']],
            ['alpha1' => 'io', 'name' => 'Ido', 'native' => 'Ido', 'countries' => ['io']],
            ['alpha1' => 'ig', 'name' => 'Igbo', 'native' => 'Igbo', 'countries' => ['ig']],
            ['alpha1' => 'id', 'name' => 'Indonesian', 'native' => 'Indonesian', 'countries' => ['id']],
            ['alpha1' => 'ia', 'name' => 'Interlingua', 'native' => 'Interlingua', 'countries' => ['ia']],
            ['alpha1' => 'ie', 'name' => 'Interlingue', 'native' => 'Interlingue', 'countries' => ['ie']],
            ['alpha1' => 'iu', 'name' => 'Inuktitut', 'native' => 'Inuktitut', 'countries' => ['iu']],
            ['alpha1' => 'ik', 'name' => 'Inupiaq', 'native' => 'Inupiaq', 'countries' => ['ik']],
            ['alpha1' => 'ga', 'name' => 'Irish', 'native' => 'Irish', 'countries' => ['ga']],
            ['alpha1' => 'it', 'name' => 'Italian', 'native' => 'Italian', 'countries' => ['it']],
            ['alpha1' => 'ja', 'name' => 'Japanese', 'native' => 'Japanese', 'countries' => ['jp']],
            ['alpha1' => 'jv', 'name' => 'Javanese', 'native' => 'Javanese', 'countries' => ['jv']],
            ['alpha1' => 'kn', 'name' => 'Kannada', 'native' => 'Kannada', 'countries' => ['kn']],
            ['alpha1' => 'kr', 'name' => 'Kanuri', 'native' => 'Kanuri', 'countries' => ['kr']],
            ['alpha1' => 'ks', 'name' => 'Kashmiri', 'native' => 'Kashmiri', 'countries' => ['ks']],
            ['alpha1' => 'kk', 'name' => 'Kazakh', 'native' => 'Kazakh', 'countries' => ['kk']],
            ['alpha1' => 'rw', 'name' => 'Kinyarwanda', 'native' => 'Kinyarwanda', 'countries' => ['rw']],
            ['alpha1' => 'kv', 'name' => 'Komi', 'native' => 'Komi', 'countries' => ['kv']],
            ['alpha1' => 'kg', 'name' => 'Kongo', 'native' => 'Kongo', 'countries' => ['kg']],
            ['alpha1' => 'ko', 'name' => 'Korean', 'native' => 'Korean', 'countries' => ['kr']],
            ['alpha1' => 'kj', 'name' => 'Kwanyama', 'native' => 'Kwanyama', 'countries' => ['kj']],
            ['alpha1' => 'ku', 'name' => 'Kurdish', 'native' => 'Kurdish', 'countries' => ['ku']],
            ['alpha1' => 'ky', 'name' => 'Kyrgyz', 'native' => 'Kyrgyz', 'countries' => ['ky']],
            ['alpha1' => 'lo', 'name' => 'Lao', 'native' => 'Lao', 'countries' => ['lo']],
            ['alpha1' => 'la', 'name' => 'Latin', 'native' => 'Latin', 'countries' => ['la']],
            ['alpha1' => 'lv', 'name' => 'Latvian', 'native' => 'Latvian', 'countries' => ['lv']],
            ['alpha1' => 'lb', 'name' => 'Letzeburgesch', 'native' => 'Letzeburgesch', 'countries' => ['lb']],
            ['alpha1' => 'li', 'name' => 'Limburgish', 'native' => 'Limburgish', 'countries' => ['li']],
            ['alpha1' => 'ln', 'name' => 'Lingala', 'native' => 'Lingala', 'countries' => ['ln']],
            ['alpha1' => 'lt', 'name' => 'Lithuanian', 'native' => 'Lithuanian', 'countries' => ['lt']],
            ['alpha1' => 'lu', 'name' => 'Luba-Katanga', 'native' => 'Luba-Katanga', 'countries' => ['lu']],
            ['alpha1' => 'mk', 'name' => 'Macedonian', 'native' => 'Macedonian', 'countries' => ['mk']],
            ['alpha1' => 'mg', 'name' => 'Malagasy', 'native' => 'Malagasy', 'countries' => ['mg']],
            ['alpha1' => 'ms', 'name' => 'Malay', 'native' => 'Malay', 'countries' => ['ms']],
            ['alpha1' => 'ml', 'name' => 'Malayalam', 'native' => 'Malayalam', 'countries' => ['ml']],
            ['alpha1' => 'mt', 'name' => 'Maltese', 'native' => 'Maltese', 'countries' => ['mt']],
            ['alpha1' => 'gv', 'name' => 'Manx', 'native' => 'Manx', 'countries' => ['gv']],
            ['alpha1' => 'mi', 'name' => 'Maori', 'native' => 'Maori', 'countries' => ['mi']],
            ['alpha1' => 'mr', 'name' => 'Marathi', 'native' => 'Marathi', 'countries' => ['mr']],
            ['alpha1' => 'mh', 'name' => 'Marshallese', 'native' => 'Marshallese', 'countries' => ['mh']],
            ['alpha1' => 'ro', 'name' => 'Romanian', 'native' => 'Romanian', 'countries' => ['ro']],
            ['alpha1' => 'mn', 'name' => 'Mongolian', 'native' => 'Mongolian', 'countries' => ['mn']],
            ['alpha1' => 'na', 'name' => 'Nauru', 'native' => 'Nauru', 'countries' => ['na']],
            ['alpha1' => 'nv', 'name' => 'Navajo', 'native' => 'Navajo', 'countries' => ['nv']],
            ['alpha1' => 'nd', 'name' => 'Northern Ndebele', 'native' => 'Northern Ndebele', 'countries' => ['nd']],
            ['alpha1' => 'ng', 'name' => 'Ndonga', 'native' => 'Ndonga', 'countries' => ['ng']],
            ['alpha1' => 'ne', 'name' => 'Nepali', 'native' => 'Nepali', 'countries' => ['ne']],
            ['alpha1' => 'se', 'name' => 'Northern Sami', 'native' => 'Northern Sami', 'countries' => ['se']],
            ['alpha1' => 'no', 'name' => 'Norwegian', 'native' => 'Norwegian', 'countries' => ['no']],
            ['alpha1' => 'nb', 'name' => 'Norwegian Bokmål', 'native' => 'Norwegian Bokmål', 'countries' => ['nb']],
            ['alpha1' => 'nn', 'name' => 'Norwegian Nynorsk', 'native' => 'Norwegian Nynorsk', 'countries' => ['nn']],
            ['alpha1' => 'ii', 'name' => 'Nuosu', 'native' => 'Nuosu', 'countries' => ['ii']],
            ['alpha1' => 'oc', 'name' => 'Occitan (post 1500)', 'native' => 'Occitan (post 1500)', 'countries' => ['oc']],
            ['alpha1' => 'oj', 'name' => 'Ojibwa', 'native' => 'Ojibwa', 'countries' => ['oj']],
            ['alpha1' => 'or', 'name' => 'Oriya', 'native' => 'Oriya', 'countries' => ['or']],
            ['alpha1' => 'om', 'name' => 'Oromo', 'native' => 'Oromo', 'countries' => ['om']],
            ['alpha1' => 'os', 'name' => 'Ossetian', 'native' => 'Ossetian', 'countries' => ['os']],
            ['alpha1' => 'pi', 'name' => 'Pali', 'native' => 'Pali', 'countries' => ['pi']],
            ['alpha1' => 'pa', 'name' => 'Panjabi', 'native' => 'Panjabi', 'countries' => ['pa']],
            ['alpha1' => 'ps', 'name' => 'Pashto', 'native' => 'Pashto', 'countries' => ['ps']],
            ['alpha1' => 'fa', 'name' => 'Persian', 'native' => 'Persian', 'countries' => ['fa']],
            ['alpha1' => 'pl', 'name' => 'Polish', 'native' => 'Polish', 'countries' => ['pl']],
            ['alpha1' => 'pt', 'name' => 'Portuguese', 'native' => 'Portuguese', 'countries' => ['pt']],
            ['alpha1' => 'qu', 'name' => 'Quechua', 'native' => 'Quechua', 'countries' => ['qu']],
            ['alpha1' => 'rm', 'name' => 'Romansh', 'native' => 'Romansh', 'countries' => ['rm']],
            ['alpha1' => 'rn', 'name' => 'Rundi', 'native' => 'Rundi', 'countries' => ['rn']],
            ['alpha1' => 'ru', 'name' => 'Russian', 'native' => 'Russian', 'countries' => ['ru']],
            ['alpha1' => 'sm', 'name' => 'Samoan', 'native' => 'Samoan', 'countries' => ['sm']],
            ['alpha1' => 'sg', 'name' => 'Sango', 'native' => 'Sango', 'countries' => ['sg']],
            ['alpha1' => 'sa', 'name' => 'Sanskrit', 'native' => 'Sanskrit', 'countries' => ['sa']],
            ['alpha1' => 'sc', 'name' => 'Sardinian', 'native' => 'Sardinian', 'countries' => ['sc']],
            ['alpha1' => 'sr', 'name' => 'Serbian', 'native' => 'Serbian', 'countries' => ['sr']],
            ['alpha1' => 'sn', 'name' => 'Shona', 'native' => 'Shona', 'countries' => ['sn']],
            ['alpha1' => 'sd', 'name' => 'Sindhi', 'native' => 'Sindhi', 'countries' => ['sd']],
            ['alpha1' => 'si', 'name' => 'Sinhala', 'native' => 'Sinhala', 'countries' => ['si']],
            ['alpha1' => 'sk', 'name' => 'Slovak', 'native' => 'Slovak', 'countries' => ['sk']],
            ['alpha1' => 'sl', 'name' => 'Slovenian', 'native' => 'Slovenian', 'countries' => ['si']],
            ['alpha1' => 'so', 'name' => 'Somali', 'native' => 'Somali', 'countries' => ['so']],
            ['alpha1' => 'st', 'name' => 'Sotho', 'native' => 'Sotho', 'countries' => ['st']],
            ['alpha1' => 'nr', 'name' => 'South Ndebele', 'native' => 'South Ndebele', 'countries' => ['nr']],
            ['alpha1' => 'es', 'name' => 'Spanish', 'native' => 'Spanish', 'countries' => ['es']],
            ['alpha1' => 'su', 'name' => 'Sundanese', 'native' => 'Sundanese', 'countries' => ['su']],
            ['alpha1' => 'sw', 'name' => 'Swahili', 'native' => 'Swahili', 'countries' => ['sw']],
            ['alpha1' => 'ss', 'name' => 'Swati', 'native' => 'Swati', 'countries' => ['ss']],
            ['alpha1' => 'sv', 'name' => 'Swedish', 'native' => 'Swedish', 'countries' => ['se']],
            ['alpha1' => 'tl', 'name' => 'Tagalog', 'native' => 'Tagalog', 'countries' => ['tl']],
            ['alpha1' => 'ty', 'name' => 'Tahitian', 'native' => 'Tahitian', 'countries' => ['ty']],
            ['alpha1' => 'tg', 'name' => 'Tajik', 'native' => 'Tajik', 'countries' => ['tg']],
            ['alpha1' => 'ta', 'name' => 'Tamil', 'native' => 'Tamil', 'countries' => ['ta']],
            ['alpha1' => 'tt', 'name' => 'Tatar', 'native' => 'Tatar', 'countries' => ['tt']],
            ['alpha1' => 'te', 'name' => 'Telugu', 'native' => 'Telugu', 'countries' => ['te']],
            ['alpha1' => 'th', 'name' => 'Thai', 'native' => 'Thai', 'countries' => ['th']],
            ['alpha1' => 'bo', 'name' => 'Tibetan', 'native' => 'Tibetan', 'countries' => ['bo']],
            ['alpha1' => 'ti', 'name' => 'Tigrinya', 'native' => 'Tigrinya', 'countries' => ['ti']],
            ['alpha1' => 'to', 'name' => 'Tonga', 'native' => 'Tonga', 'countries' => ['to']],
            ['alpha1' => 'ts', 'name' => 'Tsonga', 'native' => 'Tsonga', 'countries' => ['ts']],
            ['alpha1' => 'tn', 'name' => 'Tswana', 'native' => 'Tswana', 'countries' => ['tn']],
            ['alpha1' => 'tr', 'name' => 'Turkish', 'native' => 'Turkish', 'countries' => ['tr']],
            ['alpha1' => 'tk', 'name' => 'Turkmen', 'native' => 'Turkmen', 'countries' => ['tk']],
            ['alpha1' => 'tw', 'name' => 'Twi', 'native' => 'Twi', 'countries' => ['tw']],
            ['alpha1' => 'ug', 'name' => 'Uighur', 'native' => 'Uighur', 'countries' => ['ug']],
            ['alpha1' => 'uk', 'name' => 'Ukrainian', 'native' => 'Ukrainian', 'countries' => ['uk']],
            ['alpha1' => 'ur', 'name' => 'Urdu', 'native' => 'Urdu', 'countries' => ['ur']],
            ['alpha1' => 'uz', 'name' => 'Uzbek', 'native' => 'Uzbek', 'countries' => ['uz']],
            ['alpha1' => 've', 'name' => 'Venda', 'native' => 'Venda', 'countries' => ['ve']],
            ['alpha1' => 'vi', 'name' => 'Vietnamese', 'native' => 'Vietnamese', 'countries' => ['vi']],
            ['alpha1' => 'vo', 'name' => 'Volap_k', 'native' => 'Volap_k', 'countries' => ['vo']],
            ['alpha1' => 'wa', 'name' => 'Walloon', 'native' => 'Walloon', 'countries' => ['wa']],
            ['alpha1' => 'cy', 'name' => 'Welsh', 'native' => 'Welsh', 'countries' => ['cy']],
            ['alpha1' => 'fy', 'name' => 'Western Frisian', 'native' => 'Western Frisian', 'countries' => ['fy']],
            ['alpha1' => 'wo', 'name' => 'Wolof', 'native' => 'Wolof', 'countries' => ['wo']],
            ['alpha1' => 'xh', 'name' => 'Xhosa', 'native' => 'Xhosa', 'countries' => ['xh']],
            ['alpha1' => 'yi', 'name' => 'Yiddish', 'native' => 'Yiddish', 'countries' => ['yi']],
            ['alpha1' => 'yo', 'name' => 'Yoruba', 'native' => 'Yoruba', 'countries' => ['yo']],
            ['alpha1' => 'za', 'name' => 'Zhuang', 'native' => 'Zhuang', 'countries' => ['za']],
            ['alpha1' => 'zu', 'name' => 'Zulu', 'native' => 'Zulu', 'countries' => ['zu']]
        ];
    }
}
