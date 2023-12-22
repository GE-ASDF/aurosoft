<?php

namespace app\core;
use Exception;

class ResourceNotFoundException extends Exception{
    public function __construct($message = "", $code = 0, $previous = null){
        parent::__construct($message, $code, $previous);
    }
}