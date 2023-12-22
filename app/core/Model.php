<?php

namespace app\core;

use PDO;
use PDOException;

abstract class Model{
    
    protected $pdo = null;

    public function __construct(){  
            try{
                $this->pdo = new PDO(DB_DRIVER.":"."host=". SERVIDOR .";dbname=". BANCO .";charset=utf8mb4;port=". PORTA, USUARIO, SENHA, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8",
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);
            }catch(PDOException $e){
                echo "A conexão com o banco de dados não foi estabelecida. <br>
                {$e->getMessage()}
                ";
            }
        
    }
    
}