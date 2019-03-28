<?php

namespace Core;

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

    public function execute()
    {
        $method = Router::getMethod();
        $path = Router::getPath();
        $action = $this->router->getAction($method, $path);


        // 404
        if(!$action){
            Response::view('_404')->render();
            return;
        }

        // CSRFのcheck
        if (!Request::tokenMatch($method)) {
            Response::view('_400')->render();
            return;
        }

        // actionの実行
        $response = $action->doAction($this->config);

        // Responseの実行
        Response::render($response);
    }
}
