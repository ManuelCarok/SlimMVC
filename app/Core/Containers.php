<?php
// App
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => true,
        'db' => [
            'host' => 'localhost',
            'user' => '',
            'password' => '',
            'database' => 'ecommerce'
        ]
    ]
]);

$container = $app->getContainer();

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

// Controllers
$container['HomeController'] = function($container) {
    return new \Controllers\HomeController($container);
};

$container['AuthController'] = function($container) {
    return new \Controllers\AuthController($container);
};