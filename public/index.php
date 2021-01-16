<?php

session_start();

require '../vendor/autoload.php';
require '../app/Routes.php';
if ($match = $router->match()) {
    list($controller, $action) = explode('#', $match['target']);
    // dd($controller, $action);
    call_user_func_array([new $controller, $action], $match['params']);

    // extract($match['target']); // Tableau supposé contenir un clé 'controller' et une clé 'method', pour donner les variables correspondantes
    // call_user_func_array([new $controller, $method], $match['params']);
} elseif ($match === false) {
    header('HTTP/1.0 404 Not Found');
    echo '404';
}