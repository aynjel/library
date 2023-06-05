<?php

require('./../../autoload.php');

try{
    if(Session::exists('student-register')){
        $student = new Student();
        $student_id = Input::get('student_id');
        $first_name = Input::get('first_name');
        $middle_name = Input::get('middle_name');
        $last_name = Input::get('last_name');
        $year_level = Input::get('year_level');
        $section = Input::get('section');
        $course = Input::get('course');
        $password = Input::get('password');

        $stu = $student->register([
            'student_id' => $student_id,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'year_level' => $year_level,
            'section' => $section,
            'course' => $course,
            'password' => $password
        ]);

        if($stu){
            Session::delete('student-register');

            echo json_encode([
                'status' => 'success',
                'message' => 'Student registered successfully.'
            ]);
        }else{
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid username or password.'
            ]);
        }
    }else{
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid username or password.'
        ]);
    }
}catch(Exception $e){
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}