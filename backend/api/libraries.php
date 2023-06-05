<?php

require('./../../autoload.php');

try{
    $library = new Library();
    $libraries = $library->findAll();

    if($libraries){
        echo json_encode([
            'status' => 'success',
            'data' => $libraries
        ]);
    }else{
        echo json_encode([
            'status' => 'error',
            'message' => 'No libraries found.'
        ]);
    }
}catch(Exception $e){
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}