<?php

namespace App;

use App\Controllers\SignupController;
use Core\Response;
use Core\Route;

class Router
{
    public function web(Route $route)
    {
        $route->get('/signup', SignupController::class, 'show');
        $route->post('/signup', SignupController::class, 'register');
        $route->get('/login', function() {
        return Response::json(['hoge' => 'piyo']);
        });

    }
}
