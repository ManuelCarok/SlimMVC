<?php

// Twig
$container['view'] = function($container) {
    // $view = new \Slim\Views\Twig(dirname(__DIR__).'/Views', [
    //     'cache' => false
    // ]);

    $view = new \Slim\Views\Twig(dirname(__DIR__).'/Views', [
        'cache' => false
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    return $view;
};

// Controllers
$container['HomeController'] = function($container) {
    return new \Controllers\HomeController($container);
};

$container['AuthController'] = function($container) {
    return new \Controllers\AuthController($container);
};