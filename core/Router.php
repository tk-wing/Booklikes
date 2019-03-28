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
        } elseif (2 === $c) {
            $action = new Action($method, $path, $args[0], $args[1]);
            $this->add($action);
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

    public function patch(string $path, ...$args)
    {
        $this->method('PATCH', $path, ...$args);
    }

    public function put(string $path, ...$args)
    {
        $this->method('PUT', $path, ...$args);
    }

    public function delete(string $path, ...$args)
    {
        $this->method('DELETE', $path, ...$args);
    }

    public function add($action)
    {
        $this->actions[] = $action;
    }

    public static function getMethod()
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? '';
        $method = strtoupper($method);

        $http = Input::request('_http_method');

        if ($http) {
            $method = strtoupper($http);
        }

        return $method;
    }

    public static function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '';
        $path = parse_url($path, PHP_URL_PATH);

        return $path;
    }

    public function getAction($method, $path)
    {
        foreach ($this->actions as $action) {
            $url = new Url($path, $action->path);

            if ($url->match() && $action->method === $method) {
                $action->params = $url->getParams();

                return $action;

                // $key = $url->getTable();
                // $value = array_values($url->diff());

                // if($key){
                //     $array = array_combine($key, $value);
                //     $action->query = $array;
                // }else{
                //     $action->id = $value;
                // }

                // return $action;
            }
        }
    }
}
