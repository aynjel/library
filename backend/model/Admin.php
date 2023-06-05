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

<<<<<<< HEAD
    public function findByUsername($username){
        return $this->findFirst([
            'conditions' => "username = ?",
            'bind' => [$username]
        ]);
=======
    public function register($data = []){
        return $this->insert($data);
        // return $this->login(['username' => $data['username'], 'password' => $data['password']]);
    }

    public function logout(){
        Session::destroy();
    }

    public function isLoggedIn(){
        return Session::exists('admin_id');
    }

    public function getAdminId(){
        return Session::get('admin_id');
    }

    public function getAdminInfo(){
        return $this->findByLike('username', $this->getAdminId());
>>>>>>> parent of 7aec0d0 (system update 1)
    }
}