<?php

namespace app\controllers\admin;
use app\core\Controller;

class HomeController extends Controller{

    public function index(){
        $data = [
            "pageTitle" => "Index", 
            "view" => "admin/Index",
        ];
        $this->load("template", $data);
    }
    
}