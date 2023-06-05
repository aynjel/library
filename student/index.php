<?php

require('../autoload.php');

$student = new Student();

if(!$student->isLoggedIn()){
    header('Location: ./login.php');
}

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 'dashboard';
}

$title = ucwords(str_replace('-', ' ', $page));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>
        <?= $title ?> | EZ-LIBRARY PASS (STUDENT)
    </title>
    <link rel="shortcut icon" href="../assets/img/favicon.ico?">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
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
                <a href="./index.php" class="logo">
                    <img src="../assets/img/logo.png" alt="Logo">
                </a>
                <a href="./index.php" class="logo logo-small">
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
                            <i class="fas fa-user-circle fs-4"></i>
                            <div class="user-text">
                                <h6>
                                    <?= $student->getStudentName() ?>
                                </h6>
                                <p class="text-muted mb-0">
                                    <?= $student->getStudentId() ?>
                                </p>
                            </div>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="user-text">
                                <h6>
                                <?= $student->getStudentName() ?>

                                </h6>
                                <p class="text-muted mb-0">
                                <?= $student->getStudentId() ?>
                                </p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="profile();">My Profile</a>
                        <form method="POST" action="./logout.php">
                            <button type="submit" class="dropdown-item"
                                onclick="return confirm('Are you sure you want to logout?');">Logout</button>
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
                        <li class=" active">
                            <a href="?page=dashboard"><i class="feather-grid"></i> <span>Dashboard</span></a>
                        </li>
                        <?php else: ?>
                        <li class="">
                            <a href="?page=dashboard"><i class="feather-grid"></i> <span>Dashboard</span></a>
                        </li>
                        <?php endif; ?>

                        <?php if($page == 'request'): ?>
                        <li class=" active">
                            <a href="?page=request"><i class="feather-book"></i> <span>Request</span></a>
                        </li>
                        <?php else: ?>
                        <li class="">
                            <a href="?page=request"><i class="feather-book"></i> <span>Request</span></a>
                        </li>
                        <?php endif; ?>

                        <?php if($page == 'activity'): ?>
                        <li class=" active">
                            <a href="?page=activity"><i class="feather-activity"></i> <span>Activity</span></a>
                        </li>
                        <?php else: ?>
                        <li class="">
                            <a href="?page=activity"><i class="feather-activity"></i> <span>Activity</span></a>
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
                            <h3 class="page-title"><?= $title ?></h3>
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

            <footer class="footer text-center">
                <p>
                    <script>
                        document.write(new Date().getFullYear())
                    </script> &copy; EZ-LIBRARY PASS
                </p>
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
</body>

</html>