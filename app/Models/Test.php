<?php

namespace Models;

use Lib\MySQLDB;

class Test {

    public function __construct() {
    }

    public function Create() {
        $mysql = new MySQLDB(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $mysql->exec('SELECT * FROM usuarios');
        return $mysql->getData();
    }

    public function Where() {
        return 'Where';
    }

    public function Update() {
        return 'Update';
    }
}