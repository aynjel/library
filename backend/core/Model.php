<?php

class Model {
    protected $db, $table, $primaryKey = 'id';

    public function __construct($table, $primaryKey){
        $this->db = Database::getInstance();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }
<<<<<<< HEAD
=======

    public function find($id){
        return $this->db->get($this->table, [$this->primaryKey, '=', $id])->first();
    }
>>>>>>> parent of 7aec0d0 (system update 1)
    
    public function find($id, $fields = []){
        $fields = implode(', ', $fields);
        if(is_int($id)){
            $conditions = "id = ?";
            $bind = [$id];
        }else{
            $conditions = $id;
            $bind = [];
        }
        
        return $this->findFirst([
            'conditions' => $conditions,
            'bind' => $bind,
            'fields' => $fields
        ]);
    }

    public function findFirst($params = []){
        $params = array_merge([
            'conditions' => '',
            'bind' => [],
            'order' => '',
            'limit' => '',
            'fields' => '*'
        ], $params);

        $sql = "SELECT {$params['fields']} FROM {$this->table}";

        if($params['conditions'] != ''){
            $sql .= " WHERE {$params['conditions']}";
        }

        if($params['order'] != ''){
            $sql .= " ORDER BY {$params['order']}";
        }

        if($params['limit'] != ''){
            $sql .= " LIMIT {$params['limit']}";
        }

        $result = $this->db->query($sql, $params['bind']);

        return $result->first();
    }

    public function findBy($params = []){
        $params = array_merge([
            'conditions' => '',
            'bind' => [],
            'order' => '',
            'limit' => '',
            'fields' => '*'
        ], $params);

        $sql = "SELECT {$params['fields']} FROM {$this->table}";

        if($params['conditions'] != ''){
            $sql .= " WHERE {$params['conditions']}";
        }

        if($params['order'] != ''){
            $sql .= " ORDER BY {$params['order']}";
        }

        if($params['limit'] != ''){
            $sql .= " LIMIT {$params['limit']}";
        }

        $result = $this->db->query($sql, $params['bind']);

        return $result->results();
    }

    public function findAll(){
        return $this->db->query("SELECT * FROM {$this->table}")->results();
    }

    public function findByUserId($user_id, $params = []){
        $conditions = [
            'conditions' => 'user_id = ?',
            'bind' => [$user_id]
        ];
        
        $conditions = array_merge($conditions, $params);
        
        return $this->find($conditions);
    }

    public function query($sql, $bind = []){
        return $this->db->query($sql, $bind);
    }

    public function insert($fields){
        if(empty($fields)) return false;
        return $this->db->insert($this->table, $fields);
    }

    public function update($id, $fields){
        if(empty($fields) || $id == '') return false;
        return $this->db->update($this->table, [$this->primaryKey => $id], $fields);
    }

    public function delete($id){
        if($id == '') return false;
        return $this->db->delete($this->table, [$this->primaryKey => $id]);
    }
}