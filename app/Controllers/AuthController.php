<?php 

namespace Controllers;
use Models\Auth;

class AuthController extends Controller {

    public function login($request, $response) {
        $title = "Titulo"; 
        return $this->view->render($response, '/Auth/Login.twig', compact('title'));
    }

    public function recoverypw($request, $response) {
        $title = "Titulo";
        return $this->view->render($response, '/Auth/Recovery.twig', compact('title'));
    }

    public function register($request, $response) {
        $title = "Titulo";
        return $this->view->render($response, '/Auth/Register.twig', compact('title'));
    }

    public function lock($request, $response) {
        $title = "Titulo";
        return $this->view->render($response, '/Auth/Lock.twig', compact('title'));
    }

    public function logout($request, $response) {
        $title = "Titulo";
        return $this->view->render($response, '/Auth/Logout.twig', compact('title'));
    }
}