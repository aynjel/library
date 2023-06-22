<?php

require('../autoload.php');

$admin = new Admin();

if(!$admin->isLoggedIn()){
    header('Location: ./login.php');
}

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 'dashboard';
}

$a = $admin->getAdmin($_SESSION['admin']);

$title = ucwords(str_replace('-', ' ', $page));

$student = new Student();
$students = $student->getStudents();

$library_request = new LibraryRequest();
$requests = $library_request->getRequests();
$approved_req = $library_request->getApprovedRequests();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>
        <?= $title ?> | Library Management System
    </title>
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="../assets/img/logo.png" alt="Logo">
                </a>
                <a href="index.html" class="logo logo-small">
                    <img src="../assets/img/logo-small.png" alt="Logo" width="30" height="30">
                </a>
            </div>
            <div class="menu-toggle">
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="fas fa-bars"></i>
                </a>
            </div>

            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list win-maximize">
                        <i class="fas fa-expand"></i>
                    </a>
                </li>

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <i class="fas fa-user-circle text-primary"></i>
                            <div class="user-text">
                                <h6>
                                    <?= $a->name ?>
                                </h6>
                                <p class="text-muted mb-0">
                                    <?= $a->username ?>
                                </p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="../assets/img/profiles/avatar-01.jpg" alt="User Image"
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>
                                    <?= $a->name ?>
                                </h6>
                                <p class="text-muted mb-0">
                                    <?= $a->username ?>
                                </p>
                            </div>
                        </div>
                        <?php if(isset($_POST['logout'])): ?>
                        <?php
                            $admin->logout();
                            header('Location: ./login.php');
                        ?>
                        <?php endif; ?>
                        <form method="POST">
                            <button type="submit" name="logout" class="dropdown-item" onclick="return confirm('Are you sure you want to logout?')">
                                Logout
                            </button>
                        </form>
                    </div>
                </li>

            </ul>

        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main Menu</span>
                        </li>
                        <?php if($page == 'dashboard'): ?>
                        <li class="active">
                            <a href="index.php"><i class="fas fa-th-large"></i> <span> Dashboard</span></a>
                        </li>
                        <?php else: ?>
                        <li>
                            <a href="index.php"><i class="fas fa-th-large"></i> <span> Dashboard</span></a>
                        </li>
                        <?php endif; ?>

                        <?php if($page == 'students'): ?>
                        <li class="submenu active">
                            <a href="#" class="active"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="?page=students" class="active">Student List</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="?page=students">Student List</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if($page == 'library' || $page == 'request'): ?>
                        <li class="submenu active">
                            <a href="#" class="active"><i class="fas fa-book-reader"></i> <span> Library</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <?php if($page == 'library'): ?>
                                <li><a href="?page=library" class="active">Master List</a></li>
                                <li><a href="?page=request">View Requests</a></li>
                                <?php else: ?>
                                <?php endif; ?>
                                <?php if($page == 'request'): ?>
                                <li><a href="?page=library">Master List</a></li>
                                <li><a href="?page=request" class="active">View Requests</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php else: ?>
                            <li class="submenu">
                                <a href="#"><i class="fas fa-book-reader"></i> <span> Library</span> <span
                                class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="?page=library">Master List</a></li>
                                <li><a href="?page=request">View Requests</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Welcome Admin!</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php"><?= $title ?></a></li>
                                    <li class="breadcrumb-item active">Admin</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <?php 

                    if(file_exists("{$page}.php")){
                        require("{$page}.php");
                    }else{
                        require("dashboard.php");
                    }

                ?>

            </div>
            <footer>
                <p>Copyright © 2023 Anggi.</p>
            </footer>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="../assets/plugins/apexchart/chart-data.js"></script>
    <script src="../assets/js/script.js"></script>
    
    <script>
        function changeStatus(status, id){
            $.ajax({
                url: './../backend/api/changeStatus.php',
                method: 'POST',
                data: {
                    status: status,
                    id: id
                },
                success: function(data){
                    if(data == 'success'){
                        alert('Status updated successfully.');
                        location.reload();
                    }else{
                        console.log(data);
                        alert('Something went wrong.');
                    }
                },
                error: function(err){
                    console.log(err);
                }
            });
        }
    </script>
</body>

</html>