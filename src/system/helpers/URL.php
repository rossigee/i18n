<?php


namespace NovemBit\i18n\system\helpers;


class URL
{

    /**
     * @param $url
     * @param $paramName
     * @param $paramValue
     *
     * @return string
     */
    public static function addQueryVars($url, $paramName, $paramValue)
    {

        $url_data = parse_url($url);
        if ( ! isset($url_data["query"])) {
            $url_data["query"] = "";
        }

        $params = array();
        parse_str($url_data['query'], $params);
        $params[$paramName] = $paramValue;
        $url_data['query']  = http_build_query($params);

        return self::buildUrl($url_data);
    }

    /**
     * @param $url
     * @param $paramName
     *
     * @return string
     */
    public static function removeQueryVars($url, $paramName)
    {

        $url_data = parse_url($url);
        if ( ! isset($url_data["query"])) {
            $url_data["query"] = "";
        }

        $params = array();
        parse_str($url_data['query'], $params);

        if (isset($params[$paramName])) {
            unset($params[$paramName]);
        }

        $url_data['query'] = http_build_query($params);

        return self::buildUrl($url_data);
    }

    /*
     * Un parse URL
     * */
    /**
     * @param $parts
     *
     * @return string
     */
    public static function buildUrl($parts)
    {
        $scheme   = isset($parts['scheme']) ? ($parts['scheme'] . '://') : '';
        $host     = ($parts['host'] ?? '');
        $port     = isset($parts['port']) ? (':' . $parts['port']) : '';
        $user     = ($parts['user'] ?? '');
        $pass     = isset($parts['pass']) ? (':' . $parts['pass']) : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parts['path']) && !empty($parts['path']) ? '/'.ltrim($parts['path'],'/')  : '';
        $query    = isset($parts['query']) && ! empty($parts['query']) ? ('?' . $parts['query']) : '';
        $fragment = isset($parts['fragment']) ? ('#' . $parts['fragment']) : '';

        return implode('', [$scheme, $user, $pass, $host, $port, $path, $query, $fragment]);
    }

}