<?php

namespace app\core;

class Controller{
    
    protected array $active = [];

    protected function load($viewName, $viewData=array()){
        extract($viewData);
        include "app/views/{$viewName}".".php";
   }

   protected function setActive(array $strings = []){
        $this->active = [...$strings];
   }
}
