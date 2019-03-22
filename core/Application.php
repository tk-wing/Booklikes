<?php

namespace Core;

use Core\Response\JsonResponse;
use Core\Response\RedirectResponse;
use Core\Response\ViewResponse;

class Application
{
    private $router;
    private $config;

    public function __construct(Router $router)
    {
        $this->router = $router;
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

        // $action = $this->routes["{$path}:{$method}"] ?? null;
        $action = $this->router->getAction($method, $path);   // Action|null

        if (null === $action) {
            echo 404;

            return;
        }
        $response = null;

        if ($action->class) {
            $controller = new $action->class($this->config);
            $response = $controller->{$action->action}(...$action->query);
        } else {
            $response = ($action->action)(...$action->query);
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
