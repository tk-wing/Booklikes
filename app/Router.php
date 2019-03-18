<?php

namespace App;

use App\Controllers\SignupController;
use Core\Route;

class Router
{
    public function web(Route $route)
    {
        // $route->get('/signup', SignupController::class, 'show');
        // $route->post('/signup', SignupController::class, 'register');

        $route->get('/signup', function () { return SignupController::new()->show(); });
        $route->post('/signup', function () { return SignupController::new()->register(); });
        // $route->get('/login', function () {
        //     // return LoginController::new()->hogehoge();
        // });
    }
}
