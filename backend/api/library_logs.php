<?php

require('./../../autoload.php');

try{
    $library_id = Input::get('library_id');
    $library_log = new LibraryLogs();

    $library_logs = $library_log->findBy([
        'conditions' => 'library_id = ?',
        'bind' => [$library_id]
    ]);

    if($library_logs){
        echo json_encode([
            'status' => 'success',
            'data' => $library_logs
        ]);
    }else{
        echo json_encode([
            'status' => 'error',
            'message' => 'No library logs found.'
        ]);
    }
}catch(Exception $e){
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}