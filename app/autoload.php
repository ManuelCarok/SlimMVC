<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

spl_autoload_register(function($file) {
    $route = __DIR__."/".str_replace("\\", "/", $file).".php";
    if(is_readable($route)) {
        require_once $route;
    }
});