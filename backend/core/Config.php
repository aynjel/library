<?php

class Config{
    private static $config = [
        'mysql' => [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'db' => 'library_db',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]
        ],
        'email' => [
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'username' => 'test@gmail.com',
            'password' => 'password',
            'from' => 'Library System'
        ],
        'website' => [
            'name' => 'Library System',
            'short_name' => 'TS',
            'url' => 'http://localhost/library'
        ],
        'system' => [
            'admin' => 'admin',
            'password' => 'password'
        ],
    ];

    public static function get($path = null){
        if($path){
            $config = self::$config;
            $path = explode('/', $path);

            foreach($path as $bit){
                if(isset($config[$bit])){
                    $config = $config[$bit];
                }
            }

            return $config;
        }

        return false;
    }
}
