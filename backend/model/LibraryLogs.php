<?php

class LibraryLogs extends Database{
    public function createLog($fields = []){
        if(!$this->query("INSERT INTO library_logs (student_id, library_id, date, logs_status) VALUES (?, ?, ?, ?)", $fields)->error()){
            return true;
        }
        return false;
    }

    public function getLibraryLogsByLike($field, $value){
        if(!$this->query("SELECT * FROM library_logs WHERE $field LIKE ? ORDER BY id DESC", [$value])->error()){
            return $this->results();
        }
        return false;
    }

    public function getLibraryLogsById($id){
        if(!$this->query("SELECT * FROM library_logs WHERE id = ?", [$id])->error()){
            return $this->first();
        }
        return false;
    }

    public function getLibraryLogsByStudentId($id){
        if(!$this->query("SELECT * FROM library_logs WHERE student_id = ?", [$id])->error()){
            return $this->results();
        }
        return false;
    }
}