<?php

class LibraryRequest extends Database{
    public function createRequest($fields = []){
        if(!$this->query("INSERT INTO library_request (student_id, req_datetime, req_description) VALUES (?, ?, ?)", $fields)->error()){
            return true;
        }
        return false;
    }

    public function getRequests(){
        $requests = $this->query("SELECT * FROM library_request")->results();
        if($requests){
            return $requests;
        }
        return false;
    }

    public function getApprovedRequests(){
        $requests = $this->query("SELECT * FROM library_request WHERE status = 1")->results();
        if($requests){
            return $requests;
        }
        return false;
    }

    public function getLibraryRequestsByLike($field, $value){
        $requests = $this->query("SELECT * FROM library_request WHERE $field LIKE ? ORDER BY id DESC", array("%$value%"))->results();
        if($requests){
            return $requests;
        }
        return false;
    }

    public function getLibraryApprovedRequestsByLike($field, $value){
        $requests = $this->query("SELECT * FROM library_request WHERE $field LIKE ? AND status = 1 ORDER BY id DESC", array("%$value%"))->results();
        if($requests){
            return $requests;
        }
        return false;
    }

    public function getLibraryPendingRequestsByLike($field, $value){
        $requests = $this->query("SELECT * FROM library_request WHERE $field LIKE ? AND status = 0 ORDER BY id DESC", array("%$value%"))->results();
        if($requests){
            return $requests;
        }
        return false;
    }

    public function getLibraryRequests(){
        $requests = $this->query("SELECT * FROM library_request WHERE status = 0")->results();
        if($requests){
            return $requests;
        }
        return false;
    }

    public function getLibraryRequestById($id){
        $request = $this->query("SELECT * FROM library_request WHERE id = ?", [$id])->first();
        if($request){
            return $request;
        }
        return false;
    }

    public function getLibraryRequestByStudentId($id){
        $request = $this->query("SELECT * FROM library_request WHERE student_id = ?", [$id])->first();
        if($request){
            return $request;
        }
        return false;
    }

    public function updateRequest($id, $fields = []){
        if(!$this->query("UPDATE library_request SET status = ? WHERE id = ?", $fields)->error()){
            return true;
        }
        return false;
    }

    public function deleteRequest($id){
        if(!$this->query("DELETE FROM library_request WHERE id = ?", [$id])->error()){
            return true;
        }
        return false;
    }
}