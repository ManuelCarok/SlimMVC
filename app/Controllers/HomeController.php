<?php

namespace Controllers;
use Models\Test;

class HomeController extends Controller {

    public function index($request, $response) {
        return $response->withRedirect($this->router->pathFor("Login"));
    }

    public function dashboard($request, $response) {
        $json = file_get_contents(dirname(__DIR__)."/Data/sidebar-example.json");
        $sidebar = json_decode($json, true); //Array

        return $this->view->render($response, '/Home/Dashboard.twig', compact('sidebar'));
    }

    public function starter($request, $response) {
        $json = file_get_contents(dirname(__DIR__)."/Data/sidebar-example.json");
        $sidebar = json_decode($json, true); //Array

        return $this->view->render($response, '/Home/Starter.twig', compact('sidebar'));
    }

    public function testing($request, $response) {
        
    }
}