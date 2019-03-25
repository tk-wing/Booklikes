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
        $method = strtoupper($method);

        $path = parse_url($path, PHP_URL_PATH);

        $action = $this->router->getAction($method, $path);   // Action|null

        // 404
        if (null === $action) {
            echo 404;

            return;
        }

        // CSRFのcheck
        if ('POST' === $method) {
            $token = Input::post('csrf_token');
            if ($token !== csrf_token()) {
                Response::view('_400')->render();

                return;
            }
        }

        // actionの実行
        $response = null;

        if ($action->class) {
            $controller = new $action->class($this->config);
            $response = $controller->{$action->action}(...$action->query);
        } else {
            $response = ($action->action)(...$action->query);
        }

        // Responseの実行
        if ($response instanceof RedirectResponse) {
            $response->redirect();
        } elseif ($response instanceof JsonResponse) {
            $response->render();
        } elseif ($response instanceof ViewResponse) {
            $response->render();
        } else {
            echo $response;
        }
    }
}
