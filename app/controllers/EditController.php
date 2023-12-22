<?php

namespace app\controllers;
use app\core\Controller;
use app\classes\Validate;
class EditController extends Controller{

    public function index($id){      
        $data = [
            "pageTitle" => "Edit controller", 
            "id" => $id,
            "view" => "site/Index",
        ];
        $this->load("template", $data);
    }

    public function aluno(){
        
    }
    
}