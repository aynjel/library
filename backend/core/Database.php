<?php

class Database{
    private static $_instance = null;
    protected $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0,
            $_lastInsertId = null;
            
    public function __construct(){
        try{
            $host = Config::get('mysql/host');
            $db = Config::get('mysql/db');
            $username = Config::get('mysql/username');
            $password = Config::get('mysql/password');
            $options = Config::get('mysql/options');

            $this->_pdo = new PDO("mysql:host=$host;dbname=$db", $username, $password, $options);
        }catch(PDOException $e){
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new Database();
        }
        return self::$_instance;
    }
    
    public function query($sql, $params = []){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            
            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                $this->_lastInsertId = $this->_pdo->lastInsertId();
            }else{
                $this->_error = true;
            }
        }
        
        return $this;
    }

    public function delete($table, $where = []){
        $sql = "DELETE FROM {$table}";

        if(count($where) === 3){
            $operators = ['=', '>', '<', '>=', '<='];
            
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            
            if(in_array($operator, $operators)){
                $sql .= " WHERE {$field} {$operator} ?";
                
                if(!$this->query($sql, [$value])->error()){
                    return true;
                }
            }
        }

        return false;
    }

    public function insert($table, $fields = []){
        $keys = array_keys($fields);
        $values = '';
        $x = 1;
        
        foreach($fields as $field){
            $values .= '?';
            if($x < count($fields)){
                $values .= ', ';
            }
            $x++;
        }
        
        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
        
        if(!$this->query($sql, $fields)->error()){
            return true;
        }
        
        return false;
    }

    public function update($table, $where = [], $fields = []){
        $set = '';
        $x = 1;
        
        foreach($fields as $name => $value){
            $set .= "{$name} = ?";
            if($x < count($fields)){
                $set .= ', ';
            }
            $x++;
        }
        
        $sql = "UPDATE {$table} SET {$set}";

        if(count($where) === 3){
            $operators = ['=', '>', '<', '>=', '<='];
            
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            
            if(in_array($operator, $operators)){
                $sql .= " WHERE {$field} {$operator} ?";
                
                if(!$this->query($sql, array_merge($fields, [$value]))->error()){
                    return true;
                }
            }
        }

        return false;
    }

    public function results(){
        return $this->_results;
    }

    public function first(){
        return $this->results()[0];
    }

    public function count(){
        return $this->_count;
    }

    public function lastInsertId(){
        return $this->_lastInsertId;
    }

    public function error(){
        return $this->_error;
    }

    public function errorinfo(){
        return $this->_query->errorInfo();
    }

    public function pdo(){
        return $this->_pdo;
    }

    public function __destruct(){
        $this->_pdo = null;
    }
}