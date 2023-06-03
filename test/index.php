<?php

require('../autoload.php');

$student = new Student();

$students = $student->insert([
    'student_id' => '2018-00001',
    'password' => 'password',
    'first_name' => 'John',
    'middle_name' => 'Maximo',
    'last_name' => 'Doe',
    'year_level' => '1',
    'section' => 'A',
]);

echo json_encode($students);

// $admin = new Admin();

// $admins = $admin->findAll();

// echo json_encode($admins);

// $library = new Library();

// $libraries = $library->getLibraries();

// echo json_encode($libraries);