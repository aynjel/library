<?php

require('./../../autoload.php');

try{
    $library_request = new LibraryRequest();
    $library_requests = $library_request->findAll();

    if($library_requests){
        echo json_encode([
            'status' => 'success',
            'data' => $library_requests
        ]);
    }else{
        echo json_encode([
            'status' => 'error',
            'message' => 'No library requests found.'
        ]);
    }
}catch(Exception $e){
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}