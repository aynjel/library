<?php

class Admin extends Model{
    public function __construct(){
        parent::__construct('admin', 'id');
    }

    public function login($data = []){
        $admin = $this->findByLike('username', $data['username']);
        if($admin){
            if(password_verify($data['password'], $admin['password']) || $data['password'] == $admin['password']){
                Session::put('admin_id', $admin['id']);
                return true;
            }
        }   
        return false;
    }

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
        return $this->findBy('id', $this->getAdminId());
    }

    public function getAdminName(){
        return $this->getAdminInfo()->name;
    }
}