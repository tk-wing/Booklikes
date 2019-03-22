<?php

namespace Core;

use Core\Router\Url;

class Router
{
    private $actions = [];

    private function method($method, $path, ...$args)
    {
        $c = count($args);
        if (1 === $c) {
            $action = new Action($method, $path, null, $args[0]);
            $this->add($action);
        // $this->routes["{$path}:{$method}"] = new Action(null, $args[0]);
        } elseif (2 === $c) {
            $action = new Action($method, $path, $args[0], $args[1]);
            $this->add($action);
        // $this->routes["{$path}:{$method}"] = new Action($args[0], $args[1]);
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

    public function add($action)
    {
        $this->actions[] = $action;
    }

    public function getAction($method, $path)
    {
        foreach ($this->actions as $action) {
            $url = new Url($path, $action->path);
            if ($url->match() && $action->method === $method) {
                $action->query = $url->diff();
                return $action;
            }
        }
    }
}
