<?php

namespace Core;

class Action{
    public $mathod;
    public $path;
    public $class;
    public $action;
    public $query;

    public function __construct($method, $path, $class, $action){
        $this->method = $method;
        $this->path = $path;
        $this->class = $class;
        $this->action = $action;
    }

}
