<?php

session_start();
require_once dirname(__DIR__).'/autoload.php';

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

require_once dirname(__DIR__).'/Core/Containers.php';
require_once dirname(__DIR__).'/Core/Routes.php';
$app->run();