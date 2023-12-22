<?php

namespace app\controllers\site;

use app\classes\Validate;
use app\core\Controller;
use app\validations\site\Home;

class HomeController extends Controller{

    private Home $validations;

    public function __construct(){
        $this->validations = new Home;
    }

    public function index(){
        $dados = $this->validations::index();
        
        $data = [
            "pageTitle" => "Index", 
            "view" => "site/Index",
        ];
        $this->load("template", $data);
    }

    public function aluno(){
        
        $this->setActive(['administrativo', 'alunos']);
        $data = [
            "pageTitle" => "Index", 
            "view" => "site/Index",
        ];
        $this->load("template", $data);
    }

    public function responsavel(){
        
        
        $this->setActive(['administrativo', 'responsaveis']);
        $data = [
            "pageTitle" => "Index", 
            "view" => "site/Index",
        ];
        $this->load("template", $data);
    }

    private function setActive(array $strings = []){
        $this->active = [...$strings];
    }
}