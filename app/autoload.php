<?php

spl_autoload_register(function($file) {
    $route = __DIR__."\\".str_replace("\\", "/", $file).".php";
    if(is_readable($route)) {
        require_once $route;
    }
});

// require_once 'Core/Config.php';
// use Lib\MySQLDB;
// $mysql = new MySQLDB(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// $mysql->exec('SELECT * FROM usuarios');
// print_r($mysql->getData());