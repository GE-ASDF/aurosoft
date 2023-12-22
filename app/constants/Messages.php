<?php

namespace app\constants;

class Messages{
    public static function success(string $message = 'Sucesso!', array|object $data = []){
        return [
            'status' => 'success',
            'error' => false,
            'data' => $data,
            'message' => $message
        ];
    }
    public static function fail(string $message = "Falha!", array|object $data = []){
        return [
            'status' => 'danger',
            'error' => true,
            'data' => $data,
            'message' => $message
        ];
    }
}