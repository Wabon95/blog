<?php

$router = new AltoRouter();


// Homepage
$router->map('GET', '/', 'App\Controllers\HomeController#home');

// SignUp
$router->addRoutes([
    ['GET', '/sign_up', 'App\Controllers\UserController#signUp'],
    ['POST', '/sign_up', 'App\Controllers\UserController#signUpTreatment']
]);

// Login
$router->addRoutes([
    ['GET', '/login', 'App\Controllers\UserController#login'],
    ['POST', '/login', 'App\Controllers\UserController#loginTreatment']
]);

// Logout
$router->addRoutes([
    ['GET', '/logout', 'App\Controllers\UserController#logout']
]);
    
// Article
$router->addRoutes([
    ['GET', '/article/editer/[*:articleSlug]', 'App\Controllers\ArticleController#editView'],
    ['POST', '/article/editer/[*:articleSlug]', 'App\Controllers\ArticleController#editTreatment'],
    ['GET', '/article/supprimer/[*:articleSlug]', 'App\Controllers\ArticleController#deleteTreatment'],
    ['GET', '/article/ajouter', 'App\Controllers\ArticleController#addView'],
    ['POST', '/article/ajouter', 'App\Controllers\ArticleController#addTreatment'],
    ['GET', '/article/[*:articleSlug]', 'App\Controllers\ArticleController#show'],
    ['GET', '/article', 'App\Controllers\ArticleController#showAll'],
]);

// Comment
$router->addRoutes([
    ['POST', '/article/ajouter-commentaire', 'App\Controllers\CommentController#addComment']
]);

return $router;