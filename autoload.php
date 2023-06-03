<?php

spl_autoload_register('autoload');

function autoload($class){
    $core_path = 'backend/core/' . $class . '.php';
    $model_path = 'backend/model/' . $class . '.php';

    if(file_exists($core_path)){
        require_once $core_path;
    }else if(file_exists('../' . $core_path)){
        require_once '../' . $core_path;
    }else if(file_exists('../../' . $core_path)){
        require_once '../../' . $core_path;
    }else if(file_exists($model_path)){
        require_once $model_path;
    }else if(file_exists('../' . $model_path)){
        require_once '../' . $model_path;
    }else if(file_exists('../../' . $model_path)){
        require_once '../../' . $model_path;
    }else{
        die('The file ' . $class . '.php could not be found.');
    }
}

session_start();