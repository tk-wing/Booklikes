<?php

namespace App;

use Core\Response;
use Core\Application;

class Router
{
    public function web(Application $app)
    {
        $app->get('/signup', Controllers\SignupController::class, 'show');
        $app->post('/signup', Controllers\SignupController::class, 'register');
        $app->get('/login', function () {
            return Response::json(['hoge' => 'piyo']);
        });
        $app->get('/login', Controllers\LoginController::class, 'show');
        $app->post('/login', Controllers\LoginController::class, 'login');
        $app->get('/home', Controllers\HomeController::class, 'show');
        $app->get('/logout', Controllers\LogoutController::class, 'logout');
        $app->get('/bookshelf', Controllers\BookshelfController::class, 'show');
        $app->post('/bookshelf', Controllers\BookshelfController::class, 'create');
        $app->post('/bookshelf/delete', Controllers\BookshelfController::class, 'delete');
        $app->post('/bookshelf/update', Controllers\BookshelfController::class, 'update');
        $app->get('/books', Controllers\BookController::class, 'show');
    }
}
