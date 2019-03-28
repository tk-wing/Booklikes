<?php

namespace Core;

class Action
{
    public $mathod;
    public $path;
    public $class;
    public $action;
    public $params = [];
    public $id = [];

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
        foreach ($this->params as $value) {
            if (is_array($value)) {
                $request = new Request($config, $value['value'], $value['key']);
                $requests[] = $request;
                $request->select();
            } else {
                $requests[] = $value;
            }
        }

        if ($this->class) {
            $controller = new $this->class($config);

            return $controller->{$this->action}(...$requests);
        } else {
            return ($this->action)(...$requests);
        }
    }
}
