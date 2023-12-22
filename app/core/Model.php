<?php

namespace app\core;

use PDO;
use PDOException;
use app\core\Database;

abstract class Model{
    
    protected $pdo = null;

    public function __construct(string $driver = DB_DRIVER){  
        $this->pdo = Database::get($driver);
    }
    
}