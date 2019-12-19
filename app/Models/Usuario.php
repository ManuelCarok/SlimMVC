<?php

namespace Models;

class Usuario extends Model {

    public function ListUsuarios() {
        $this->db->exec('SELECT * FROM usuarios');
        $usuarios = $this->db->getData();
        echo $this->db->getErrorDetails();
        echo $this->db->closeConnection();
        return $usuarios;
    }
}