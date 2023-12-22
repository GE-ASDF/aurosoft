<?php

namespace app\validations\admin;
use app\classes\Validate;

class Home{
    
    public static function index(Validate $v){
        return $v->validate([
            'id' => 'required',
            'name' => 'optional',
        ]);       
    }
    
}