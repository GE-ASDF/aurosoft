<?php

namespace app\controllers\client;
use app\core\Controller;

class HomeController extends Controller{


    public function index(){
        $data = [
            "pageTitle" => "Index", 
            "view" => "client/Index",
        ];
        $this->load("template", $data);
    }
    
}