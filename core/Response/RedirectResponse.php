<?php

namespace Core\Response;

class RedirectResponse
{
    private $url;

    public function __construct($url)
    {
        $this->url = self::makeSafeUrl($url);
    }

    public function redirect()
    {
        header("Location: {$this->url}");
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
            return $path.'/'.ltrim($url['path'], '/').'?'.$url['query'];
        }
    }
}
