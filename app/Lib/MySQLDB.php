<?php

namespace Lib;
use Mysqli;

class MySQLDB extends Mysqli {

    private $data = [];
    private $insert = null;
    private $affectedrows = 0;
    private $errorThis = false;
    private $errThis = '';

    // public function __construct($host, $user, $password, $database) {
    //     parent::__construct($host, $user, $password, $database);
    // }

    public function __construct($settings) {
        parent::__construct($settings['host'], $settings['user'], $settings['password'], $settings['database']);
    }

    public function call(string $query, $values = null, string $types = '') {
		try {
            if ($this->connect_errno) {
                $this->errorThis = true;
                $this->errThis = "Fallo al conectar a MySQL: (" . $this->connect_errno . ") " . $this->connect_error;
            } else {
                $this->set_charset('utf8');
                if ($stmt = $this->prepare('CALL '.$query)) {
                    if ($values != null) {
                        if(!$types) $types = str_repeat('s', count($values));
                        $stmt->bind_param($types, ...$values);
                    }
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result) {
                        $this->data = $result->fetch_all(MYSQLI_ASSOC);
                    }
                    $this->insert = $this->insert_id;
                    $this->affectedrows = $stmt->affected_rows;
                    
                    $stmt->close();
                }  else {
                    $this->errorThis = true;
                    $this->errThis = 'Error Stmt';
                }
            }
        } catch (Exception $ex) {
            $this->errorThis = true;
            $this->errThis = $ex->getMessage();
        }
    }

    public function exec(string $query, $values = null, string $types = '') {
        try {
            if ($this->connect_errno) {
                $this->errorThis = true;
                $this->errThis = "Fallo al conectar a MySQL: (" . $this->connect_errno . ") " . utf8_encode($this->connect_error);
            } else {
                $this->set_charset('utf8');
                if ($stmt = $this->prepare($query)) {
                    if ($values != null) {
                        if(!$types) $types = str_repeat('s', count($values));
                        $stmt->bind_param($types, ...$values);
                    }
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result) {
                        $this->data = $result->fetch_all(MYSQLI_ASSOC);
                    }
                    $this->insert = $this->insert_id;
                    $this->affectedrows = $stmt->affected_rows;
                    
                    $stmt->close();
                } else {
                    $this->errorThis = true;
                    $this->errThis = 'Error Stmt';
                }
            }
        } catch (Exception $ex) {
            $this->errorThis = true;
            $this->errThis = 'Error';
        }
    }

    public function getData() {
        return $this->data;
    }

    public function getInsertId() {
        return $this->insert;
    }

    public function getAffectedRows() {
        return $this->affectedrows;
    }

    public function getError() {
        return $this->errorThis;
    }

    public function getErrorDetails() {
        return $this->errThis;
    }

    public function closeConnection() {
        if (!$this->connect_errno) {
            $this->close();
        }
    }
}