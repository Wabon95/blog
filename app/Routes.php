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

$router->map('GET', '/sign_in', 'UserController#signIn'); // Formulaire de connexion
$router->map('POST', '/sign_in', 'UserController#signIn'); // Traitement du formulaire de connexion

$router->map('GET', '/sign_out', 'UserController#signOut'); // Déconnexion

return $router;