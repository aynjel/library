<?php

class Admin extends Database{

    public function login($username, $password){
        $admin = $this->query("SELECT * FROM admin WHERE username = ?", [$username])->first();
        if($admin){
            if(password_verify($password, $admin->password) || $password == $admin->password){
                return $admin;
            }
        }
        return false;
    }

    public function getAdmin($id){
        $admin = $this->query("SELECT * FROM admin WHERE id = ?", [$id])->first();
        if($admin){
            return $admin;
        }
        return false;
    }
}