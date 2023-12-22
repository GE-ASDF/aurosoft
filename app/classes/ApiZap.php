<?php


namespace app\classes;
use app\classes\Curl;

class ApiZap{

    public function sendText($data){
        $curl = new Curl();
        $send = $curl->sendText($data);
        return $send;
    }

}