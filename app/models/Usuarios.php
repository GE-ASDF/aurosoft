<?php

namespace app\models;
use app\core\Model;

class Usuarios extends Model{
    
    private string $table;

    final public function __construct(string $table = ''){
        parent::__construct();
        if(trim($table)){
            $this->table = $table;
        }else{
            $this->table =  str_replace(['app','models','\\'],'',strtolower($this::class));
        }
    }

    public function fetchAll($fields = '*', $data = [], $conditions = ''){
        $sql = "SELECT $fields FROM $this->table $conditions";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($data);
        return $prepare->fetchAll();
    }

    public function fetch($fields = '*', $data = [], $conditions = ''){
        $sql = "SELECT $fields FROM $this->table $conditions";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($data);
        return $prepare->fetch();
    }

}