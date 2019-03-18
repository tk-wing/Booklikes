<?php

namespace Core;

class Route
{
    private $routes = [];

    private function method($method, $path, ...$args)
    {
        $c = count($args);
        if (1 === $c) {
            $this->routes["{$path}:{$method}"] = new Action(null, $args[0]);
        } elseif (2 === $c) {
            $this->routes["{$path}:{$method}"] = new Action($args[0], $args[1]);
        } else {
            throw new \Exception('引数の数は2または3つで指定してください。');
        }
    }

    public function get(string $path, ...$args)
    {
        $this->method('GET', $path, ...$args);
    }

    public function post(string $path, ...$args)
    {
        $this->method('POST', $path, ...$args);
    }

    public function execute($path, $method)
    {
        $actions = $this->routes["{$path}:{$method}"];

        if ($actions->class) {
            $controller = new $actions->class();
            $response = $controller->{$actions->action}();
        } else {
            $response = ($actions->action)();
        }

        if ($response instanceof Controller) {
            $response->render();
        } else {
            echo $response;
        }
    }
}
