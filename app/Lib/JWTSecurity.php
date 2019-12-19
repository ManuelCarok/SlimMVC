<?php

namespace Lib;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class JWTSecurity {

    public function sign($payload, $key, $expiracion) {
        $time = time();
      
        $data = array(
            'iat' => $time, // Tiempo que inició el token
            'exp' => $time + (60*$expiracion), // Tiempo que expirará el token (+1 hora)
            'data' => $payload // información del usuario
        );

        $jwt = JWT::encode($data, $key);         

        return $jwt;
    }

    public function verify($jwt, $key) {
        try {
            $data = JWT::decode($jwt, $key, array('HS256'));
            return $data;
        } catch(ExpiredException $e){
            throw $e;
        } catch (SignatureInvalidException $e) {
            throw $e;
        } catch (Exception $e) {
            throw $e;
        }
    }
}