<?php

namespace app\validations\site;
use app\classes\Validate;

class Home{
    
    private static Validate $v;
    public function __construct(){
        Home::$v = new Validate;
    }
    public static function index(){
        return self::$v->validate([
            'id' => 'required',
            'name' => 'optional',
        ]);       
    }
    
}