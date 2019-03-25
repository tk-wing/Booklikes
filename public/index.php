<?php

use Core\Application;

session_start();

$basePath = __DIR__.'/..';
require $basePath.'/vendor/autoload.php';
require $basePath.'/core/helper.php';

$appRouter = new App\Router();
$coreRouter = new Core\Router();
$app = new Application($coreRouter);
$config = require $basePath.'/config/database.php';
$app->useDB($config);
$appRouter->web($coreRouter);
$app->execute();
