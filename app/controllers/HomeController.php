<?php

namespace app\controllers;
use app\core\Controller;
use app\classes\Validate;
use app\models\Usuarios;
use app\core\Model;

class HomeController extends Controller{

    public function index(){   
        backToPage("login");
    }
    
}