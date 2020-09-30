<?php

session_start();

require '../vendor/autoload.php';
require '../app/Routes.php';

if ($match = $router->match()) {
    extract($match['target']);
    call_user_func_array([new $controller, $method], $match['params']);
} elseif ($match === false) {
    header('HTTP/1.0 404 Not Found');
    echo '404';
}