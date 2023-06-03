<?php

class Session{
    private $conn;

    public function __construct(){
        $this->conn = Database::getInstance();
    }

    public static function start(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function destroy(){
        session_destroy();
    }

    public static function id(){
        return session_id();
    }

    public static function exists($name){
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function put($name, $value){
        return $_SESSION[$name] = $value;
    }

    public static function get($name){
        if(isset($_SESSION[$name])){
            return $_SESSION[$name];
        }else{
            return false;
        }
    }

    public static function delete($name){
        if(self::exists($name)){
            unset($_SESSION[$name]);
        }
    }
}