<?php

namespace app\core;
use app\controllers\TesteController;
use ReflectionMethod;


class Core {
    private $controller;
    private $method;
    private $params = array();
    
    public function __construct()
    {
        $this->verifyUri();
    }
    
    public function run(){

        $currentController = $this->getController();

        if(class_exists($currentController)){
            $c = new $currentController();
            call_user_func_array([$c, $this->getMethod()], $this->getParams());
        }else{
            echo $_ENV['NOT_FOUND_MESSAGE'];
        }
    }
    private function stripSlashesDeep($value){
        (is_array($value)) ? array_map([$this, 'stripSlashesDeep'], $value):stripslashes($value);
        return $value;
    }

    private function cleanUrl($url){
        $url = explode("/", $url);
        $url = array_values(array_filter($url, fn($v)=> $v));
        return $url; 
    }
    private function setController($url){
        $controller = null;
        
        if (is_dir(PASTA_PADRAO . $url[0])) {
                
            if(isset($url[1]) && class_exists(NAMESPACE_CONTROLLER . $url[0] .  "\\" . $url[1] . 'Controller')){
                if (isset($url[1]) && $url[1] != '') {
                    $controller = $url[0] . "\\" . ucfirst($url[1]) . "Controller";
                    array_shift($url);
                } else {
                    $controller = $url[0]  . "\\" . ucfirst(CONTROLLER_PADRAO) . "Controller";
                    array_shift($url);
                }
            }else{
                $controller =  $url[0] . "\\" . ucfirst(CONTROLLER_PADRAO) . "Controller";
                array_shift($url);
            }
         
        } else {
            if(class_exists(NAMESPACE_CONTROLLER . ucfirst($url[0]) . 'Controller')){
                $controller = ucfirst($url[0]) . "Controller";
            }else{
                $controller = ucfirst(CONTROLLER_PADRAO) . "Controller";
            }   

        }
        return $controller;
    }

    private function setMethod($url){
        $method = null;
        if (isset($url[0])) { 
            
            if(method_exists(sprintf("%s%s", NAMESPACE_CONTROLLER, $this->controller), $url[0])){
                $method = $url[0];

            }else{
                try{
                    if(method_exists(sprintf("%s%s", NAMESPACE_CONTROLLER, $this->controller), METODO_PADRAO)){
                        $method = METODO_PADRAO;
                    }else{
                        throw new ResourceNotFoundException('Not found',404);
                    }
                }catch(ResourceNotFoundException $e){
                    $response = new Response;
                    $response->setResponseHeader(404, 'Not found');
                }
            }
        }else{
            $method = METODO_PADRAO;
        } 
        return $method;
    }

    private function setParameters($url){
        $params = [];
        if (isset($url[0])) {
            $params = array_filter($url);
        }
    
        return $params;
    }
    
    private function verifyUri(){
        $url = $this->getUrl();
        $urlHandled = $this->handleUrl($url);
        $url = end($urlHandled);
        
    
        if ($url != "" && preg_match('/[a-zA-Z0-9_]+/', $url) >= 1) {
            
            $url = $this->cleanUrl($url);

            // Definir o controller acessado
            $this->controller = $this->setController($url);
            array_shift($url);
            // dd($this->controller);
            // Definir o método acessado
            $this->method = $this->setMethod($url);
            array_shift($url);
                   
            // Definir os parâmetros
        
            
            $this->params = $this->setParameters($url);
            
           
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $this->setQueryString();
            }
        
        } else {
            $this->controller = ucfirst(CONTROLLER_PADRAO) . "Controller";
            $this->method = METODO_PADRAO;
            $url = $this->cleanUrl($url);

            if (isset($url[0])) {
                $this->params = array_filter($url);
            }
            if($_SERVER['REQUEST_METHOD'] == 'GET'){
                $this->setQueryString();
            }
        } 
    }

    private function setQueryString(){

        $reflection = new ReflectionMethod(NAMESPACE_CONTROLLER.$this->controller, $this->method);

        $parameters = $reflection->getParameters();
        $paramNames = array_map(fn($name)=> $name->getName(), $parameters);
        $query = '';

        
        foreach($paramNames as $key => $name){
            try{

                if(isset($this->params[$key])){
                    if(str_contains($name, "_OPT")){
                        $name = str_replace("_OPT", "", $name);
                        $query.= $name . "=" . $this->params[$key] .'&';
                    }else{
                        $query.= $name . "=" . $this->params[$key] .'&';
                    }
                }else{
                    if(str_contains($name, "_OPT")){
                        $this->params[$key] = '';
                        $name = str_replace("_OPT", "", $name);
                        $query.= $name . "=" . $this->params[$key] .'&';
                    }else{
                        throw new ResourceNotFoundException('Not found',404);
                    }
                }
            }catch(ResourceNotFoundException $e){
                $response = new Response;
                $response->setResponseHeader(404, 'Not found');
            }

        }
        $query = rtrim($query, "&");
        $_SERVER['QUERY_STRING'] = $query;
        parse_str($_SERVER['QUERY_STRING'], $_GET);
        parse_str($_SERVER['QUERY_STRING'], $_REQUEST);

    }
    private function getUrl()
    {
        return $_SERVER['PHP_SELF'];
    }
    
    private function handleUrl(string $url = '')
    {
        if ($url) {
            $newUrl =  explode($_SERVER['SCRIPT_NAME'], $url);
            return $newUrl;
        }
        return $url;
    }

    private function getController()
    {
        
        $url = explode("\\", $this->controller);
        
        
        if (class_exists(sprintf("%s%s", NAMESPACE_CONTROLLER,  $this->controller))) {
            return sprintf("%s%s", NAMESPACE_CONTROLLER, $this->controller);
        }else{
            setFlash("message", $_ENV['NOT_FOUND_MESSAGE']);
            header("location:" . URL_BASE);
            // return sprintf("%s%s%s%s%s", NAMESPACE_CONTROLLER, $url[0],"\\", ucfirst(CONTROLLER_PADRAO), "Controller");
        }
        
        if (isset($url[0]) && $url[0]) {
            if (is_dir(PASTA_PADRAO . $url[0])) {
                $controllerName = ucfirst(CONTROLLER_PADRAO);
            } else {
                $controllerName = ucfirst($url[0]);
            }
        }

        return sprintf("%s\\%sController", NAMESPACE_CONTROLLER, $controllerName);
    }

    private function getMethod()
    {
        $controllerClass = sprintf("%s%s", NAMESPACE_CONTROLLER, $this->controller);
      
        if (method_exists($controllerClass, $this->method)) {
            return $this->method;
        }
        
        return METODO_PADRAO;
    }

    private function getParams()
    {
        return $this->params;
    }
}







