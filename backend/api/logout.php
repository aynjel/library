<?php

require('./../../autoload.php');

if(Session::exists('student_id')){
    Session::delete('student_id');
}else if(Session::exists('admin_id')){
    Session::delete('admin_id');
}

echo json_encode([
    'status' => 'success',
    'message' => 'Logged out successfully.'
]);