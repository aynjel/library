<?php

require('../autoload.php');

$admin = new Admin();

if($admin->isLoggedIn()){
    $admin->logout();
}else{
    header('Location: ./login.php');
}

Session::put('success', 'You have been logged out successfully!');

header('Location: ./login.php');