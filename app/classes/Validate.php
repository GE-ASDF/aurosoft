<?php
namespace app\classes;

use app\models\DAO;
use DateTime;

class Validate{

    public static function validate(array $validacoes){
        $result = [];
        $param = '';
        foreach($validacoes as $field => $validate){

            $result[$field] = (!str_contains($validate, "|")) ?
            [$validate, $param] = self::validacaoUnica($validate, $field, $param):
            $result[$field] = self::validacaoMultipla($validate, $field, $param);
            
        }
        if(in_array(false, $result, true)){
            return false;
        }
        return $result;
    }

    private static function validacaoUnica($validate, $field, $param){
        if(str_contains($validate, ":")){
            [$validate, $param] = explode(":", $validate);
        }
    
        return self::$validate($field, $param);
    }
    
   

    private static function validacaoMultipla($validate, $field, $param){
        $result = [];
        $explodeValidatePipe = explode("|", $validate);
        foreach($explodeValidatePipe as $validate){
            if(str_contains($validate, ":")){
                [$validate, $param] = explode(":", $validate);
            }

                $result[$field] = self::$validate($field, $param);
                if($result[$field] === false || $result[$field] === null){
                    break;
                }
            }
            return $result[$field];
    }
    
    private static function valideISODate($field){
        $accepted = ['Y-m-d', 'Y-m-d H:i:s'];
        $date = isset($_REQUEST[$field]) ? strip_tags($_REQUEST[$field]):'';

        if($date){
            foreach($accepted as $formato){
                $dateTimeObj = DateTime::createFromFormat($formato, $date);
                if($dateTimeObj !== false && $dateTimeObj->format($formato) === $date){
                    return strip_tags($date);
                }
            }
        }

        return false;
    }

    private static function valideNumber($field){
        $valor = isset($_REQUEST[$field]) ? strip_tags($_REQUEST[$field]):'';
        if($valor){
            $float = floatval($valor);
            if($float == $valor || is_int($valor)){
                return strip_tags($valor);
            }
        }
        return false;
    }

    private static function required($field){
        if(!isset($_POST[$field]) || $_POST[$field] === ''){
            if(!isset($_GET[$field]) || $_GET[$field] === ''){
                setFlash($field, "O campo é obrigatório");
                return false;
            }
        }
        
        $resultado = isset($_GET[$field]) ? strip_tags($_GET[$field]):strip_tags($_POST[$field]);
        return $resultado;
    }
    private static function numberInt($field){
        $number = isset($_REQUEST[$field]) ? intval($_REQUEST[$field]):"";
        if(is_int($number)){
            return $number;
        }        
        return null;
    }

    private static function notNull($field){
        if(!isset($_REQUEST[$field]) || empty(trim($_REQUEST[$field]))){
            return false;
        }
        return strip_tags($_REQUEST[$field]);
    }
    private static function email($field){
        $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);
        if(!$emailIsValid){
            setFlash($field, "O campo precisa ter um {$field} válido.");
            return false;
        }
        
        return filter_input(INPUT_POST, $field, FILTER_SANITIZE_EMAIL);
    }

    private static function maxlen($field, $param){
        $data = strip_tags($_POST[$field]);
        if(strlen($data) > $param){
            setFlash($field, "O campo {$field} tem um limite de {$param} caracteres.");
            return false;
        }
        return $data;
    }
    private static function minlen($field, $param){
        $data = strip_tags($_POST[$field]);
        if(strlen($data) < $param){
            setFlash($field, "O campo {$field} tem um limite de {$param} caracteres.");
            return false;
        }
        return $data;
    }
    private static function unique($field, $param){
        $campo = isset($_POST[$field]) ? strip_tags($_POST[$field]):strip_tags($_GET[$field]);
        if($campo){
            $params = explode("-", $param);
          
            $usuario = new DAO($params[0], $params[1], data:[$field => $campo], conditions:[$field => " = :$field"]);
            $existe = $usuario->fetch();
        
            if($existe){
                setFlash($field, "Este dado já está cadastrado em nosso banco de dados.");
                return false;
            }        
        }
        return $campo;
    }
    private static function image($field, $param){
        $filename = $_FILES[$field];
        
    }
    private static function existe($field, $param){
        $campo = isset($_POST[$field]) ? strip_tags($_POST[$field]):strip_tags($_GET[$field]);
   
        if($campo){
            $params = explode("-", $param);
            if(str_contains($params[1],'~')){
                $params2 = explode("~", $params[1]);
                $usuario = new DAO($params[0], $params2[0], data:[$params2[1] => $campo], conditions:[$params2[1] => " = :".$params2[1]]);
                $existe = $usuario->fetch();
                if(!$existe){
                    setFlash($field, "Este {$field} não está cadastrado no nosso banco de dados.");
                    return false;
                } 
            }else{
                $usuario = new DAO($params[0], $params[1], data:[$field => $campo], conditions:[$field => " = :".$field]);
                $existe = $usuario->fetch();
                if(!$existe){
                    setFlash($field, "Este {$field} não está cadastrado no nosso banco de dados.");
                    return false;
                }  
            }
        }else{
            setFlash($field, "Nenhum valor foi passado para este campo.");
            return false;
        }              
        return $campo;
    }


    private static function data($field){
        $data = isset($_REQUEST[$field]) ? $_REQUEST[$field]:'';
        $date = '';
        if(str_contains($data, "-")){
            $newDataArray = explode("-", $data);
            $dateArray = [
                "dia" => $newDataArray[2],
                "mes" => $newDataArray[1],
                "ano" => $newDataArray[0]
            ];
            $date = checkdate($dateArray["mes"], $dateArray["dia"], $dateArray["ano"]);
            if($date){   
                // $data = $dateArray["dia"]."/".$dateArray["mes"]."/".$dateArray["ano"];     
                return $data;
            }
        }

        if(str_contains($data, "/")){
            $newDataArray = explode("/", $data);
            $dateArray = [
                "dia" => $newDataArray[0],
                "mes" => $newDataArray[1],
                "ano" => $newDataArray[2]
            ];
            $date = checkdate($dateArray["mes"], $dateArray["dia"], $dateArray["ano"]);
            if($date){   
                return $data;
            }
        }
        setFlash("message", "Defina uma data válida.");
        return false;
    }

    private static function color($field){
        $cor_validate = strip_tags($_REQUEST[$field]);
        $pattern = '/[0-9a-fA-F]{6}$/';
        if(preg_match($pattern, $cor_validate) > 0){
            return $cor_validate;
        }
        return false;
    }

    private static function senha($field){
        $senha = strip_tags($_POST[$field]);
        $newSenha = password_hash($senha, PASSWORD_DEFAULT);
        return $newSenha;
    }
    private static function optional($field){

        $data = '';
        
        if(isset($_POST[$field])){
            $data = strip_tags($_POST[$field]);
        }

        if(isset($_GET[$field])){
            $data = strip_tags($_GET[$field]);
        }

        if($data){
            return $data;
        }
        return null;
    }
    private static function telefone($field){

        $data = '';

        if(isset($_POST[$field])){
            $data = strip_tags($_POST[$field]);
        }

        if(isset($_GET[$field])){
            $data = strip_tags($_GET[$field]);
        }

        if($data){
            $regex = '/^[0-9]{1,50}$/i';
            $teste = preg_match($regex, $data);
            
            if($teste == 1){
                return $data;
            }else{
                setFlash($field, "Digite um telefone válido. Sem espaços, parênteses e hifen.");
                return null;
            }
        }
        
        return null;
        
    }
    
}