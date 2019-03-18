<?php

namespace Core;

class Route
{
    private $routes = [];

    public function get(string $path, callable $callback)
    {
        $this->routes[$path.':GET'] = $callback;
    }

    public function post(string $path, callable $callback)
    {
        $this->routes[$path.':POST'] = $callback;
    }

    public function execute($path, $method)
    {
        $controller = $this->routes["{$path}:{$method}"]();
        if ($controller instanceof Controller) {
            $controller->render();
        } else {
            echo $controller;
        }
    }
}
