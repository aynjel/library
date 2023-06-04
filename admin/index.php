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

$title = ucwords(str_replace('-', ' ', $page));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>
        <?= $title ?> | EZ-LIBRARY PASS (ADMIN)
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

                <!-- <li class="nav-item dropdown noti-dropdown me-2">
                    <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm flex-shrink-0">
                                                <i class="fas fa-birthday-cake"></i>
                                            </span>
                                            <div class="media-body flex-grow-1">
                                                <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                                    approved <span class="noti-title">your estimate</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">View all Notifications</a>
                        </div>
                    </div>
                </li> -->

                <li class="nav-item zoom-screen me-2">
                    <a href="#" class="nav-link header-nav-list win-maximize">
                        <i class="fas fa-expand"></i>
                    </a>
                </li>

                <li class="nav-item dropdown has-arrow new-user-menus">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <i class="fas fa-user-circle fs-4"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="user-text">
                                <h6>
                                    <?= $admin->getAdminName() ?>
                                </h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </div>
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
                        <li class="active">
                            <a href="?page=dashboard"><i class="feather-grid"></i> <span>Dashboard</span></a>
                        </li>
                        <?php else: ?>
                        <li>
                            <a href="?page=dashboard"><i class="feather-grid"></i> <span>Dashboard</span></a>
                        </li>
                        <?php endif; ?>

                        <?php if($page == 'students'): ?>
                        <li class="submenu active">
                            <a href="javascript::void()"><i class="fas fa-graduation-cap"></i> <span> Students</span>
                                <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="?page=students" class="active">Student List</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                            <li class="submenu">
                                <a href="javascript::viod()"><i class="fas fa-graduation-cap"></i> <span> Students</span>   
                                <span class="menu-arrow"></span></a>
                                <ul>
                                <li><a href="?page=students">Student List</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>

                        <?php if($page == 'library'): ?>
                        <li class="submenu active">
                            <a href="javascript::void()"><i class="fas fa-book-reader"></i> <span> Library</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <?php if(isset($_GET['lists'])): ?>
                                <li><a href="?page=library&lists" class="active">Master Lists</a></li>
                                <?php else: ?>
                                <li><a href="?page=library&lists">Master Lists</a></li>
                                <?php endif; ?>

                                <?php if(isset($_GET['requests'])): ?>
                                <li><a href="?page=library&requests" class="active">View Requests</a></li>
                                <?php else: ?>
                                <li><a href="?page=library&requests">View Requests</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="submenu">
                            <a href="javascript::void()"><i class="fas fa-book-reader"></i> <span> Library</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="?page=library&lists">Master List</a></li>
                                <li><a href="?page=library&requests">View Requests</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">
            <div class="content container-fluid">

                <?php 

                    if(file_exists("{$page}.php")){
                        require("{$page}.php");
                    }else{
                        require("404.php");
                    }

                ?>
                
            </div>
            <footer>
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