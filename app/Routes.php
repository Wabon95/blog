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

$router->map('GET', '/login', [
        'controller' => 'App\Controllers\UserController',
        'method' => 'login'
    ],
    'Login'
);

$router->map('POST', '/login', [
    'controller' => 'App\Controllers\UserController',
    'method' => 'loginTreatment'
    ],
    'LoginTreatment'
);

$router->map('GET', '/logout', [
    'controller' => 'App\Controllers\UserController',
    'method' => 'logout'
    ],
    'Logout'
);

return $router;