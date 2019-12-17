<?php

// Home
$app->get('/', 'HomeController:index');
$app->get('/dashboard', 'HomeController:dashboard')->setName('Dashboard');
$app->get('/starter', 'HomeController:starter');
$app->get('/test', 'HomeController:testing');

//Auth
$app->get('/login', 'AuthController:login')->setName('Login');
$app->get('/recoverypw', 'AuthController:recoverypw');
$app->get('/register', 'AuthController:register');
$app->get('/lock', 'AuthController:lock');
$app->get('/logout', 'AuthController:logout');

//Admin
$app->group('/admin', function() use ($app) {
    $app->get('/testing', 'HomeController:testing')->setName('Testing');
})->add(new Middleware\RouterMiddleware());