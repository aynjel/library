<?php

class Admin extends Model{

    public function __construct(){
        parent::__construct('admin', 'id');
    }

    public function login($username, $password){
        $admin = $this->findFirst([
            'username' => $username
        ]);

        if($admin){
            if(password_verify($password, $admin->password) || $password === $admin->password){
                return $admin;
            }
        }

        return false;
    }

    public function findByUsername($username){
        return $this->findFirst([
            'conditions' => "username = ?",
            'bind' => [$username]
        ]);
    }
}