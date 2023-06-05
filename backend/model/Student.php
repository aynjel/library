<?php

class Student extends Model{

    public function __construct(){
        parent::__construct('students', 'id');
    }

    public function login($student_id, $password){
        $admin = $this->findFirst([
            'student_id' => $student_id
        ]);

        if($admin){
            if(password_verify($password, $admin->password) || $password === $admin->password){
                return $admin;
            }
        }

        return false;
    }

    public function register($data = []){
        return $this->insert($data);
    }

    public function findByStudentId($student_id){
        return $this->findFirst([
            'conditions' => "student_id = ?",
            'bind' => [$student_id]
        ]);
    }
}