<?php
namespace app\middlewares;
use app\controllers\LoginController;

class SessionMiddleware{
    
    public static function handleRequest($request, $sessionName = SESSION_LOGIN, string $to = ''){
        session_regenerate_id();

        if(!self::isUserLoggedIn($request, $sessionName)){
            redirectToLogin($to);
        }
    
        if(self::isUserLoggedIn($request,$sessionName)){
            // echo $_SESSION['dono'];
            $token = LoginController::getAndCryptAgentUserAndAddr();
            if($_SESSION['dono'] != $token){
                session_regenerate_id();
                session_destroy();
                redirectToLogin();
                return false;
            }
        }

        return true;
    }

    private static function isUserLoggedIn($request, $sessionName){
        return (isset($request[$sessionName]) && $request[$sessionName]) || (isset($request[$sessionName]) && $request[$sessionName]) ? true:false;
    }


}