<?php

require('../autoload.php');

if(!Admin::isLoggedIn()){
    header('Location: ./login.php');
}

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 'dashboard';
}

$admin_info = Admin::find(Admin::getAdminId());
H::debug($admin_info);
