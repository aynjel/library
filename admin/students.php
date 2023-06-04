<?php

$student = new Student();
$students_set = $student->findAll();

?>
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-sub-header">
                <h3 class="page-title">
                    <?= $title ?> (<?= count($students_set) ?>)
                </h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered" style="width: 100%; white-space: no-wrap;">
        <thead>
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Year Level</th>
                <th scope="col">Course</th>
                <th scope="col">Section</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($students_set as $result) {
            ?>
                <tr>
                    <td><?= $result->student_id; ?></td>
                    <td><?= $result->first_name; ?></td>
                    <td><?= $result->middle_name; ?></td>
                    <td><?= $result->last_name; ?></td>
                    <td><?= $result->year_level; ?></td>
                    <td><?= $result->course; ?></td>
                    <td><?= $result->section; ?></td>
                    <td>
                        <a href="admin\edit_student.php?id=<?= $result->id; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="admin\delete_student.php?id=<?= $result->id; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
    </table>
</div>