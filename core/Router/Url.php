<?php

namespace Core\Router;

class Url
{
    private $url = [];
    private $default = [];

    public function __construct($accessUrl, $defaultUrl){
        $this->url = explode('/', $accessUrl);
        $this->default = explode('/', $defaultUrl);
    }



    public function match()
    {
        $ca = count($this->url);
        $cb = count($this->default);

        if ($ca !== $cb) {
            return false;
        }

        for ($i = 1; $i < $ca; ++$i) {
            $lb = strlen($this->default[$i]);

            if ($this->url[$i] !== $this->default[$i] && !('{' === $this->default[$i][0] && '}' === $this->default[$i][$lb - 1])) {
                return false;
            }
        }

        return true;
    }

    public function diff(){
        if($this->match()){
            return array_diff($this->url, $this->default);
        }
        return [];
    }

}
