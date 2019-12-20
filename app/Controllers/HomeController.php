<?php

namespace Controllers;
use Models\Usuario;

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

        // MODELO
        // $model = new Usuario($this);
        // print_r($model->ListUsuarios());

        // SETTINGS
        // print_r($this->container['settings']['db']);

        // JWT
        //echo $this->jwt->sign([],"key", 60);

        //MAIL
        // echo $template = $this->view->fetch('/Error/404.twig');
        // $html = $template->render();
        // echo $html;
        $mail = $this->mail->sendMail('Asunto', 'Body', array(array('name' => 'Manuel Caroca','mail' => 'manuelcarok@gmail.com'),array('name' => 'Manuel Byte','mail' => 'manuel@byteservices.cl')));
        if($mail) {
            echo 'Enviado';
        } else {
            echo 'Error';
        }
    }
}