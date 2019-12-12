<?php

session_start();
require dirname(__DIR__).'../../vendor/autoload.php';
require dirname(__DIR__).'/autoload.php';
require_once dirname(__DIR__).'/Core/Config.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => true
    ]
]);

$container = $app->getContainer();
require dirname(__DIR__).'/Core/Containers.php';

require dirname(__DIR__).'/Core/Routes.php';