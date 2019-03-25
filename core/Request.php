<?php

namespace Core;

class Request
{
    public static function tokenMatch($method)
    {
        if ('GET' === $method) {
            return true;
        }
        $token = Input::request('_csrf_token');

        return $token === csrf_token();
    }
}
