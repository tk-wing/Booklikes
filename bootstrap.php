<?php

$base = __DIR__.'/public';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ('/' !== $uri && file_exists($base.$uri)) {
    return false;
}

require "{$base}/index.php";
