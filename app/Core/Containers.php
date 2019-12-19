<?php

$container = $app->getContainer();

// Errores
// Vista y API
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container->view->render($response, '/Error/404.twig');
    };
};

// API: GET, POST, DELETE y PUT
$container['notAllowedHandler'] = function ($container) {
    return function ($request, $response, $methods) use ($container) {
        $code = 405;
        $resp = [
            "statusText" => "Método no permitido ".implode(', ', $methods),
            "status" => 405
        ];
        return $response->withJson($resp, $code)->withHeader('Content-Type', 'application/json');
    };
};

// Twig
$container['view'] = function($container) {
    $view = new \Slim\Views\Twig(dirname(__DIR__).'/Views', [
        'cache' => false
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

// MySQL
$container['db'] = function($container) {
    return new Lib\MySQLDB($container['settings']['db']);
};

// JWT
$container['jwt'] = function($container) {
    return new Lib\JWTSecurity();
};

// Controllers
$container['HomeController'] = function($container) {
    return new \Controllers\HomeController($container);
};

$container['AuthController'] = function($container) {
    return new \Controllers\AuthController($container);
};