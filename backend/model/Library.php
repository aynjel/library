<?php

class Library extends Model{
    public function __construct(){
        parent::__construct('library', 'id');
    }
    
    public function getLibrary($id){
        return $this->find($id);
    }

    public function getLibraries(){
        return $this->findAll();
    }

    public function getLibrariesBy($field, $value){
        return $this->findBy($field, $value);
    }

    public function getLibrariesByLike($field, $value){
        return $this->findByLike($field, $value);
    }

    public function addLibrary($data = []){
        return $this->insert($data);
    }

    public function updateLibrary($id, $data = []){
        return $this->update($id, $data);
    }

    public function deleteLibrary($id){
        return $this->delete($id);
    }

    public function getLibraryCount(){
        return $this->db->count();
    }

    public function getLibraryCountBy($field, $value){
        return $this->db->count($field, $value);
    }

    public function getLibraryCountByLike($field, $value){
        return $this->db->countLike($field, $value);
    }
}