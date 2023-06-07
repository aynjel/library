<?php

class Library extends Database{
    public function createLibrary($fields = []){
        if(!$this->query("INSERT INTO library (book_name, book_author, book_description, book_image, book_quantity) VALUES (?, ?, ?, ?, ?)", $fields)->error()){
            return true;
        }
        return false;
    }

    public function getLibraries(){
        $libraries = $this->query("SELECT * FROM library")->results();
        if($libraries){
            return $libraries;
        }
        return false;
    }

    public function getLibraryById($id){
        $library = $this->query("SELECT * FROM library WHERE library_req_id = ?", [$id])->first();
        if($library){
            return $library;
        }
        return false;
    }

    public function getLibraryByLike($field, $value){
        $libraries = $this->query("SELECT * FROM library WHERE $field LIKE ? ORDER BY id DESC", array("%$value%"))->results();
        if($libraries){
            return $libraries;
        }
        return false;
    }
}