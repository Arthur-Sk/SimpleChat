<?php

namespace Classes;


class Database extends \PDO
{
    public $errorMessage;

    public function __construct($serverName,$username,$password,$dbname,$port)
    {
        $dsn='mysql:dbname='.$dbname.';host='.$serverName;
        parent::__construct($dsn, $username, $password);
    }

    protected function buildSelectAll($object){
        return 'SELECT * FROM '.$object->tableName;
    }

    protected function buildSelectBy($object,array $parameters){
        $sql = $this->buildSelectAll($object);
        $i = 0;
        $values = array();
        foreach($parameters as $key=>$value){
            if($i === 0){
                $sql .= ' WHERE ';
                $sql .= $key." = ?";
            } else {
                $sql .= ' AND ';
                $sql .= $key." = ?";
            }
            $i++;
            array_push($values, $value);
        }
        $stmt = $this->prepare($sql);
        $stmt->execute($values);
        return $stmt;
    }

    protected function buildEditById($object, $id, array $parameters){
        $sql = "UPDATE $object->tableName SET ";
        $values = array();
        foreach ($parameters as $key=>$value){
            $sql .= $key." = ?, ";
            array_push($values, $value);
        }
        $sql = rtrim($sql,", ");
        $sql .= ' WHERE id = ?';
        array_push($values, $id);
        $stmt = $this->prepare($sql);
        $stmt->execute($values);
        return $stmt;
    }

    protected function buildInsert($object, array $parameters){
        $sql = "INSERT INTO $object->tableName (";
        $values = array();
        foreach ($parameters as $key=>$value){
            $sql .= $key.",";
            array_push($values, $value);
        }
        $sql = rtrim($sql,",");
        $sql .= ') VALUES (';
        foreach ($parameters as $key=>$value){
            $sql .= "?,";
        }
        $sql = rtrim($sql,",");
        $sql .= ')';
        $stmt = $this->prepare($sql);
        $stmt->execute($values);
        return $stmt;
    }

}