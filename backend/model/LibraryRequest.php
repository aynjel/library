<?php

class LibraryRequest extends Model{
    public function __construct(){
        parent::__construct('library_request', 'id');
    }
    
    public function getLibraryRequest($id){
        return $this->find($id);
    }

    public function getLibraryRequests(){
        return $this->findAll();
    }

    public function getLibraryRequestsBy($field, $value){
        return $this->findBy($field, $value);
    }

    public function getLibraryRequestsByLike($field, $value){
        return $this->findByLike($field, $value);
    }

    public function addLibraryRequest($data = []){
        return $this->insert($data);
    }

    public function updateLibraryRequest($id, $data = []){
        return $this->update($id, $data);
    }

    public function deleteLibraryRequest($id){
        return $this->delete($id);
    }

    public function getLibraryRequestCount(){
        return $this->db->count();
    }

    // get library request where status is 1
    public function getApprovedLibraryRequest(){
        return $this->db->query("SELECT * FROM {$this->table} WHERE status = 1")->results();
    }
}