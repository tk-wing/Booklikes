<?php

namespace App;

use Core\Response;

class Router
{
    public function web(\Core\Router $router)
    {
        $router->get('/signup', Controllers\SignupController::class, 'show');
        $router->post('/signup', Controllers\SignupController::class, 'register');
        $router->get('/login', Controllers\LoginController::class, 'show');
        $router->post('/login', Controllers\LoginController::class, 'login');
        $router->get('/home', Controllers\HomeController::class, 'show');
        $router->get('/logout', Controllers\LogoutController::class, 'logout');
        $router->get('/bookshelf', Controllers\BookshelfController::class, 'show');
        $router->post('/bookshelf', Controllers\BookshelfController::class, 'create');
        $router->get('/bookshelf/{id}/delete', Controllers\BookshelfController::class, 'delete');
        $router->post('/bookshelf/{id}/update', Controllers\BookshelfController::class, 'update');
        $router->get('/books', Controllers\BookController::class, 'show');
        $router->get('/bookshelf/{id}', Controllers\BookshelfController::class, 'single');
    }
}
