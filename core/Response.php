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
}
