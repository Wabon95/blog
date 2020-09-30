<?php

$router = new AltoRouter();

$router->map('GET', '/', [
        'controller' => 'App\Controllers\HomeController',
        'method' => 'home'
    ],
    'Homepage'
);

$router->map('GET', '/sign_up', [
        'controller' => 'App\Controllers\UserController',
        'method' => 'signUp'
    ],
    'SignUp'
);

$router->map('POST', '/sign_up', [
        'controller' => 'App\Controllers\UserController',
        'method' => 'signUpTreatment'
    ],
    'SignUpTreatment'
);

return $router;