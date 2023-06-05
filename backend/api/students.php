<?php

require('./../../autoload.php');

try{
    $student = new Student();
    $students = $student->findAll();

    if($students){
        echo json_encode([
            'status' => 'success',
            'data' => $students
        ]);
    }else{
        echo json_encode([
            'status' => 'error',
            'message' => 'No students found.'
        ]);
    }
}catch(Exception $e){
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}