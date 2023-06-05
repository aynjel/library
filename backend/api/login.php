<?php

require('./../../autoload.php');

try{
    if(Session::exists('admin-login')){
        $admin = new Admin();
        $username = Input::get('username');
        $password = Input::get('password');
        // $username = 'admin';
        // $password = 'password';

        $admin = $admin->login($username, $password);

        if($admin){
            Session::put('admin_id', $admin->id);
            Session::delete('admin-login');

            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful.'
            ]);
        }else{
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid username or password.'
            ]);
        }
    }elseif(Session::exists('student-login')){
        $student = new Student();
        $student_id = Input::get('student_id');
        $password = Input::get('password');

        $stu = $student->login($student_id, $password);

        if($stu){
            Session::put('student_id', $stu->student_id);
            Session::delete('student-login');

            echo json_encode([
                'status' => 'success',
                'message' => 'Login successful.'
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