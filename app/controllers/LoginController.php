<?php

namespace app\controllers;
use app\core\Controller;
use app\classes\Validate;
use app\models\Usuarios;
use app\core\Model;
use app\services\RequestMethod;

class LoginController extends Controller{

    public function index(){   
        $data = [
            "pageTitle" => "Página inicial", 
            "view" => "Index",
        ];
        $this->load("templatelogin", $data);
    }

    public function auth(){
        (new RequestMethod)->check();
    }
}