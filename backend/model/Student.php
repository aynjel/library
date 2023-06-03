<?php

class Student extends Model{
    public function __construct(){
        parent::__construct('students', 'id');
    }

    // public function login($data = []){
    //     $student = $this->findBy('student_id', $data['student_id']);
    //     if($student){
    //         if(password_verify($data['password'], $student->password) || $data['password'] == $student->password){
    //             Session::put('student_id', $student['student_id']);
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    public function register($data = []){
        return $this->insert($data);
        // return $this->login(['student_id' => $data['student_id'], 'password' => $data['password']]);
    }

    public function logout(){
        Session::destroy();
    }

    public function isLoggedIn(){
        return Session::exists('student_id');
    }

    public function getStudentId(){
        return Session::get('student_id');
    }

    public function getStudentInfo(){
        return $this->findBy('student_id', $this->getStudentId());
    }

    public function getStudentName(){
        $student = $this->getStudentInfo();
        return $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name;
    }
}