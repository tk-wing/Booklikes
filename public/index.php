<?php

use App\Router;
use Core\Application;

session_start();

$basePath = __DIR__.'/..';
require $basePath.'/vendor/autoload.php';
require $basePath.'/core/helper.php';

$router = new Router();
$app = new Application();
$config = require $basePath.'/config/database.php';
$app->useDB($config);
$router->web($app);
$uri = $_SERVER['REQUEST_URI'] ?? '';
$method = $_SERVER['REQUEST_METHOD'] ?? '';
$app->execute($uri, $method);
