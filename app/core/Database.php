<?php

namespace app\core;
use PDO;
use PDOException;

abstract class Database{
    private static $connections = [
        'mysql' => [
            'host' => SERVIDOR,
            'dbname' => BANCO,
            'port' => PORTA,
            'user' => USUARIO,
            'password' => SENHA, 
            'charset' => "utf8mb4",
        ]
    ];
    public static function get($driver = DB_DRIVER){
        try{
            if(array_key_exists($driver, self::$connections)){
                return self::$driver(self::$connections[$driver]);
            }else{
                throw new ResourceNotFoundException('Internal Server Error',404);
            }
        }catch(ResourceNotFoundException $e){
            $response = new Response;
            $response->setResponseHeader(500, 'Internal Server Error', 'Não foi possível estabelecer uma conexão com o banco de dados informado.');
        }
    }

    private static function mysql($db){
        extract($db);
        try{
            $pdo = new PDO(DB_DRIVER.":"."host=". $host .";dbname=". $dbname .";charset=".$charset .";port=". $port, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
            return $pdo;
        }catch(PDOException $e){
            echo "A conexão com o banco de dados não foi estabelecida. <br>
            {$e->getMessage()}
            ";
        }
    }
}