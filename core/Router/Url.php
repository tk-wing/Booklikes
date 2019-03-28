<?php

namespace Core\Router;

class Url
{
    private $url = [];
    private $default = [];
    private $matched = false;
    private $params = [];

    public function __construct($accessUrl, $defaultUrl)
    {
        $this->url = explode('/', $accessUrl);
        $this->default = explode('/', $defaultUrl);

        $ca = count($this->url);
        $cb = count($this->default);

        if ($ca === $cb) {
            for ($i = 1; $i < $ca; ++$i) {
                $lb = strlen($this->default[$i]);
                $brace = '{' === $this->default[$i][0] && '}' === $this->default[$i][$lb - 1];
                $colon = ':' === $this->default[$i][0];

                if($this->url[$i] === $this->default[$i]){
                    $this->matched = true;
                }elseif($brace){
                    $this->matched = true;
                    $l = strlen($this->default[$i]);
                    $d = substr($this->default[$i], 1, $l - 2);
                    $this->params[] = ['key' => $d, 'value' => $this->url[$i]];
                }elseif ($colon) {
                    $this->matched = true;
                    $this->params[] = $this->url[$i];
                }
            }
        }
    }

    public function match()
    {
        return $this->matched;
    }

    public function diff()
    {
        if ($this->match()) {
            return array_diff($this->url, $this->default);
        }

        return [];
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getTable()
    {
        $table = [];
        foreach ($this->default as $d) {
            $l = strlen($d);
            if ('' !== $d && '{' === $d[0] && '}' === $d[$l - 1]) {
                $table[] = substr($d, 1, $l - 2);
            }
        }

        return $table;
    }
}
