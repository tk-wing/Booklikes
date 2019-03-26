<?php

namespace Core;

class Action
{
    public $mathod;
    public $path;
    public $class;
    public $action;
    public $query = [];

    public function __construct($method, $path, $class, $action)
    {
        $this->method = $method;
        $this->path = $path;
        $this->class = $class;
        $this->action = $action;
    }

    public function doAction($config)
    {
        $requests = [];
        foreach ($this->query as $key => $value) {
            $request = new Request($config, $value, $key);
            $request->select();
            $requests[] = $request;
        }

        if ($this->class) {
            $controller = new $this->class($config);

            return $controller->{$this->action}(...$requests);
        } else {
            return ($this->action)(...$requests);
        }
    }
}
