<?php

namespace app\classes;
use DateTime;
class Date{
    public static function date($format = 'Y-m-d'){
        return (new DateTime)->format($format);
    }

    public static function datetime($format = 'Y-m-d H:i:s'){
        return (new DateTime)->format($format);
    }
    
}