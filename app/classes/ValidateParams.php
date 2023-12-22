<?php

namespace app\classes;

class ValidateParams{

    public function validate(array $validations){
        $result = [];
        $param = '';
        foreach($validations as $field => $validation){
            if(!str_contains($validation, "|")){
                $result[$field] = self::validacaoUnica($field, $validation, $param, $data);
            }
        }
        return $result;
    }

    private static function validacaoUnica($validation, $field, $param, $data){
        return $data;
    }
    private static function validacaoMultipla($validation, $field, $param){

    }
}