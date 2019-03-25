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

    public function doAction($config)
    {
        if ($this->class) {
            $controller = new $this->class($config);

            return $controller->{$this->action}(...$this->query);
        } else {
            return ($this->action)(...$this->query);
        }
    }


}
