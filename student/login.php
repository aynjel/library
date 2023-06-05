<?php

require('../autoload.php');

error_reporting(0);

if(isset($_SESSION['student_id'])){
    header('Location: index.php');
}

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){

    try{
        $validate = new Validate();
        $validation = $validate->check($_POST, [
            'student_id' => [
                'display' => 'Student ID',
                'required' => true,
            ],
            'password' => [
                'display' => 'Password',
                'required' => true,
            ],
        ]);

        if($validation->passed()){
            $student = new Student();

            $login = $student->findBy('student_id', $_POST['student_id']);
            if($login){
                if(password_verify($_POST['password'], $login->password) || $_POST['password'] == $login->password){
                    Session::put('student_id', $login->student_id);
                    $success = 'Login successful. Redirecting...';
                    header('Refresh:1;url=index.php?page=dashboard');
                }else{
                    $error = 'Invalid student ID or password.';
                }
            }else{
                $error = 'Invalid student ID or password.';
            }
        }else{
            $error = $validation->errors()[0];
        }
    }catch(Exception $e){
        die('There was an error.' . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>EZ-LIBRARY PASS - Login</title>

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

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox shadow-lg">
                    <div class="login-left bg-warning d-flex align-items-center justify-content-center">
                        <img class="img-fluid" src="../assets/img/login-logo.png" alt="Logo">
                        <h3 class="text-white text-center mt-3">EZ-LIBRARY PASS</h3>
                        <h1 class="text-white text-center mt-3">
                            <i class="fas fa-book-reader"></i> <i class="fas fa-user-graduate"></i>
                        </h1>
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            
                            <h2 class="h1 text-uppercase">Sign in</h2>

                            <?php if(isset($error)): ?>
                            <div class="alert alert-danger mb-3" role="alert">
                                <?= $error ?>
                            </div>
                            <?php endif; ?>

                            <?php if(isset($success)): ?>
                            <div class="alert alert-success mb-3" role="alert">
                                <?= $success ?>
                            </div>
                            <?php endif; ?>

                            <form method="POST">
                                <div class="form-group">
                                    <label>Student ID <span class="login-danger">*</span></label>
                                    <input class="form-control" type="number" name="student_id" value="<?= Input::get('student_id') ?>" autofocus>
                                    <span class="profile-views"><i class="fas fa-id-badge"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" name="password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                <!-- <div class="forgotpass">
                                    <div class="remember-me">
                                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                                            <input type="checkbox" name="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <a href="forgot-password.html">Forgot Password?</a>
                                </div> -->
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                    
                                    <p class="account-subtitle mt-3">Need an account? <a href="register.php">Sign Up</a></p>
                                </div>
                            </form>

                            <!-- <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>

                            <div class="social-login">
                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/js/script.js"></script>
</body>

</html>