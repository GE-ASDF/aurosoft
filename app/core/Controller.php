<?php

namespace app\core;
use app\services\SecurityService;

class Controller{
    
    protected array $active = [];

    protected function load($viewName, $viewData=array()){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $antiCSRF = new SecurityService\securityService();
          $csrfResponse = $antiCSRF->validate();
          if(empty($csrfResponse)){
               throw new \Exception("O token expirou.");
               die;
          }
        }
        extract($viewData);
        include "app/views/{$viewName}".".php";
   }

   protected function setActive(array $strings = []){
        $this->active = [...$strings];
   }
}
