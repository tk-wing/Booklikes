<?php

namespace Core;

class Response
{
    public static function redirect($url)
    {
        $url = self::makeSafeUrl($url);
        header("Location: {$url}");
        exit;
    }

    public static function makeSafeUrl($url)
    {
        $url = parse_url($url);
        $safeDomain = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['HTTP_ORIGIN'];

        $domain = '';
        if (isset($url['host']) && isset($url['port'])) {
            $domain = $url['host'].':'.$url['port'];
        }

        if ($domain === $safeDomain) {
            return $redirect;
        } else {
            return $path.'/'.ltrim($url['path'], '/');
        }
    }
}
