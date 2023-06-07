<?php

class Student extends Database{

    public function login($student_id, $password){
        $admin = $this->query("SELECT * FROM students WHERE student_id = ?", [$student_id])->first();
        if($admin){
            if(password_verify($password, $admin->password) || $password == $admin->password){
                return $admin;
            }
        }
        return false;
    }

    public function register($fields = []){
        if(!$this->query("INSERT INTO students (student_id, password, first_name, middle_name, last_name, year_level, section, course) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", $fields)->error()){
            return true;
        }
        return false;
    }

    public function getStudent($id){
        $admin = $this->query("SELECT * FROM student WHERE id = ?", [$id])->first();
        if($admin){
            return $admin;
        }
        return false;
    }

    public function isLoggedIn(){
        if(Session::exists('student_id')){
            return true;
        }
        return false;
    }

    public function logout(){
        Session::delete('student_id');
    }

    public function getStudentName(){
        $student = $this->query("SELECT * FROM students WHERE student_id = ?", [Session::get('student_id')])->first();
        if($student){
            return $student->first_name . ' ' . $student->last_name;
        }
        return false;
    }

    public function getStudentId(){
        $student = $this->query("SELECT * FROM students WHERE student_id = ?", [Session::get('student_id')])->first();
        if($student){
            return $student->student_id;
        }
        return false;
    }

    public function getStudents(){
        $students = $this->query("SELECT * FROM students")->results();
        if($students){
            return $students;
        }
        return false;
    }
}