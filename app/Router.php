<?php

namespace App;

use Core\Request;
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
        $router->delete('/bookshelf/{bookshelves}', Controllers\BookshelfController::class, 'delete');
        $router->patch('/bookshelf/{bookshelves}', Controllers\BookshelfController::class, 'update');
        $router->get('/books', Controllers\BookController::class, 'show');
        $router->get('/bookshelf/{bookshelves}', Controllers\BookshelfController::class, 'single');
        $router->get('/bookshelf/:id/book/:id', Controllers\BookshelfController::class, 'test');
    }
}
