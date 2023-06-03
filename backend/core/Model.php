<?php

class Model {
    protected $db, $table, $primaryKey = 'id';

    public function __construct($table, $primaryKey){
        $this->db = Database::getInstance();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    public function find($id){
        return $this->db->get($this->table, [$this->primaryKey, '=', $id])->first();
    }
    
    public function findAll(){
        if(!$this->db->query("SELECT * FROM {$this->table}")){
            return false;
        }else{
            return $this->db->results();
        }
    }

    public function findBy($field, $value){
        $this->db->query("SELECT * FROM {$this->table} WHERE {$field} = ?", [$value]);
        if(!$this->db->query("SELECT * FROM {$this->table} WHERE {$field} = ?", [$value])){
            return false;
        }else{
            return $this->db->first();
        }
    }

    public function findByLike($field, $value){
        return $this->db->query("SELECT * FROM {$this->table} WHERE {$field} LIKE '%{$value}%' ORDER BY {$this->primaryKey} DESC")->results();
    }

    public function insert($fields = []){
        return $this->db->insert($this->table, $fields);
    }

    public function update($id, $fields = []){
        return $this->db->update($this->table, $id, $fields);
    }

    public function delete($id){
        return $this->db->delete($this->table, [$this->primaryKey, '=', $id]);
    }
}