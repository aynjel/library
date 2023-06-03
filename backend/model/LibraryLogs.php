<?php

class LibraryLogs extends Model{
    public function __construct(){
        parent::__construct('library_logs', 'id');
    }
    
    public function getLibraryLog($id){
        return $this->find($id);
    }

    public function getLibraryLogs(){
        return $this->findAll();
    }

    public function getLibraryLogsBy($field, $value){
        return $this->findBy($field, $value);
    }

    public function getLibraryLogsByLike($field, $value){
        return $this->findByLike($field, $value);
    }

    public function addLibraryLog($data = []){
        return $this->insert($data);
    }

    public function updateLibraryLog($id, $data = []){
        return $this->update($id, $data);
    }

    public function deleteLibraryLog($id){
        return $this->delete($id);
    }
}