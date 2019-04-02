<?php

namespace Core;

use Core\Response\JsonResponse;
use Core\Response\RedirectResponse;
use Core\Response\ViewResponse;

class Response
{
    public static function redirect($url)
    {
        return new RedirectResponse($url);
    }

    public static function json($value)
    {
        return new JsonResponse($value);
    }

    public static function view($name, $values = [])
    {
        $response = new ViewResponse();
        $response->view($name, $values);

        return $response;
    }

    public static function with($values)
    {
        $response = new ViewResponse($values);
        $response->with($values);

        return $response;
    }

    public static function render($response)
    {
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
