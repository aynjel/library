<?php

require('../autoload.php');

$student = new Student();

if($student->isLoggedIn()){
    $student->logout();
}else{
    header('Location: ./login.php');
}

Session::put('success', 'You have been logged out successfully!');

header('Location: ./login.php');