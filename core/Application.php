<?php

namespace Core;

use Core\Response\JsonResponse;
use Core\Response\RedirectResponse;
use Core\Response\ViewResponse;

class Application
{
    private $routes = [];
    private $config;

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

    public function useDB($config)
    {
        $this->config = $config;
    }

    public function execute($path, $method)
    {
        // 応急処置。井上さんに確認。
        $path = parse_url($path);
        $path = $path['path'];

        $actions = $this->routes["{$path}:{$method}"] ?? null;

        if (null === $actions) {
            echo 404;

            return;
        }
        $response = null;

        if ($actions->class) {
            $controller = new $actions->class($this->config);
            $response = $controller->{$actions->action}();
        } else {
            $response = ($actions->action)();
        }

        if ($response instanceof RedirectResponse) {
            $response->redirect();
        } elseif ($response instanceof JsonResponse) {
            $response->render();
        } elseif ($response instanceof ViewResponse) {
            $response->render();
        } else {
            echo $response;
        }
        // if ($response instanceof Controller) {
        //     $response->render();
        // } else {
        //     echo $response;
        // }
    }
}
