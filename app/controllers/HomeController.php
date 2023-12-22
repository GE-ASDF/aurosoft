<?php

namespace app\controllers;
use app\core\Controller;
use app\classes\Validate;
use app\models\Usuarios;
use app\core\Model;
class HomeController extends Controller{

    public function index(){      
        
        $this->active[] = 'dashboard';
        $data = [
            "pageTitle" => "Página inicial", 
            "view" => "Index",
        ];
        $this->load("template", $data);
    }

    public function edit($id){       
        echo $id;
        die;
    }
    
}