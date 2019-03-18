<?php
$basePath = __DIR__.'/..';
require $basePath.'/vendor/autoload.php';
use App\Router;
use Core\Route;

$uri = $_SERVER['REQUEST_URI'] ?? '';
$method = $_SERVER['REQUEST_METHOD'] ?? '';
// var_dump($_SERVER['REQUEST_URI']);
$router = new Router();
$route = new Route();
$router->web($route);
$route->execute($uri, $method);

// $routes = [];
// $routes['/signup'] = function(){
//     var_dump('SIGNUP');
// };

// $routes['/login'] = function(){
//     var_dump('LOGIN');
// };

// $routes[$uri]();


