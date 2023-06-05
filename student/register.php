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
                'unique' => 'students',
                'min' => 8,
                'max' => 12,
            ],
            'first_name' => [
                'display' => 'First Name',
                'required' => true,
            ],
            'middle_name' => [
                'display' => 'Middle Name',
                'required' => false,
            ],
            'last_name' => [
                'display' => 'Last Name',
                'required' => true,
            ],
            'year_level' => [
                'display' => 'Year Level',
                'required' => true,
            ],
            'section' => [
                'display' => 'Section',
                'required' => false,
            ],
            'course' => [
                'display' => 'Course',
                'required' => false,
            ],
            'password' => [
                'display' => 'Password',
                'required' => true,
            ],
            'c_password' => [
                'display' => 'Confirm Password',
                'required' => true,
                'matches' => 'password',
            ],
        ]);

        if($validation->passed()){
            $student = new Student();

            $register = $student->register([
                'student_id' => $_POST['student_id'],
                'password' => $_POST['password'],
                'first_name' => $_POST['first_name'],
                'middle_name' => $_POST['middle_name'],
                'last_name' => $_POST['last_name'],
                'year_level' => @$_POST['year_level'],
                'section' => $_POST['section'],
                'course' => $_POST['course'],
            ]);

            if(!$register){
                $error = 'Invalid student ID or password.';
            }else{
                $success = 'Registration successful. Redirecting...';
                header('refresh:2;url=login.php');
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
    <title>EZ-LIBRARY PASS - Register</title>

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
                        <h2 class="text-white text-center mt-3">
                            <i class="fas fa-book-reader"></i> <i class="fas fa-user-graduate"></i>
                        </h2>
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Register</h1>
                            <p class="account-subtitle">Already have an account? <a href="login.php">Login</a></p>

                            <?php if(isset($error)): ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                            <?php endif; ?>

                            <?php if(isset($success)): ?>
                            <div class="alert alert-success">
                                <?= $success ?>
                            </div>
                            <?php endif; ?>

                            <form method="POST">
                                <div class="form-group">
                                    <label>Student ID <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" name="student_id" value="<?= Input::get('student_id') ?>">
                                    <span class="profile-views"><i class="fas fa-id-badge"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>First Name <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" name="first_name" value="<?= Input::get('first_name') ?>">
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input class="form-control" type="text" name="middle_name" value="<?= Input::get('middle_name') ?>">
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Last Name <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" name="last_name" value="<?= Input::get('last_name') ?>">
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Year Level <span class="login-danger">*</span></label>
                                            <select class="form-control" name="year_level">
                                                <option selected hidden disabled>Year Level</option>
                                                <option value="1">1st Year</option>
                                                <option value="2">2nd Year</option>
                                                <option value="3">3rd Year</option>
                                                <option value="4">4th Year</option>
                                            </select>
                                            <span class="profile-views"><i class="fas fa-sort-numeric-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Section</label>
                                            <input class="form-control" type="text" name="section" value="<?= Input::get('section') ?>">
                                            <span class="profile-views"><i class="fas fa-network-wired"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <select name="course"class="form-control">
                                                <option selected hidden disabled>Course</option>
                                                <option value="BSIT">BSIT</option>
                                                <option value="BSCS">BSCS</option>
                                                <option value="BSIS">BSIS</option>
                                                <option value="BSEMC">BSEMC</option>
                                                <option value="BSECE">BSECE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" name="password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" name="c_password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                                </div>
                            </form>
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