<?php

namespace app\validations\client;
use app\classes\Validate;

class Home{
    
    public static function index(Validate $v){
        return $v->validate([
            'id' => 'required',
            'name' => 'optional',
        ]);       
    }
    
}