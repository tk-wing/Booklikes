<?php

namespace Core;

use Core\Response\JsonResponse;
use Core\Response\RedirectResponse;

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

    public static function view($name){
        return new ViewResponse($name);
    }
}
