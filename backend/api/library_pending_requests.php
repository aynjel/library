<?php

require('./../../autoload.php');

try{
    $library_request = new LibraryRequest();
    $library_approved_requests = $library_request->findBy([
        'conditions' => 'status = ?',
        'bind' => [0]
    ]);

    if($library_approved_requests){
        echo json_encode([
            'status' => 'success',
            'data' => $library_approved_requests
        ]);
    }else{
        echo json_encode([
            'status' => 'error',
            'message' => 'No library approved requests found.'
        ]);
    }
}catch(Exception $e){
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}