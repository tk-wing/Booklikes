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

        $response = null;

        if ($this->class) {
            $controller = new $this->class($config);

            $isApi = $_SERVER['HTTP_AUTHORIZATION'] ?? false;
            $isExpired = $controller->isExpired();
            if($isExpired){
                http_response_code(403);

                return Response::json([
                    'status' => 403,
                    'message' => 'APIキーの期限が切れています。',
                ]);
            }

            if ($isApi && !$controller->isAuthorized()) {
                http_response_code(403);

                return Response::json([
                    'status' => 403,
                    'message' => 'APIキーが一致しませんでした。',
                ]);
            }

            return $controller->{$this->action}(...$requests);
        } else {
            return ($this->action)(...$requests);
        }
    }
}
