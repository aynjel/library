<?php

if(isset($_GET['lists'])){
    $lists = $_GET['lists'];
    
    $library_request = new LibraryRequest();
    $library_request_set = $library_request->findByLike('status', 1);

    $lib = [];

    foreach ($library_request_set as $r) {
        $library = new Library();
        $library_set = $library->findBy('library_req_id', $r->id);

        if($library_set != null){
            array_push($lib, $library_set);
        }
    }
?>
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-sub-header">
                <h3 class="page-title">
                    <?= $title ?> Lists
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
                <th scope="col">Library ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Purpose</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($lib != null){
            foreach ($lib as $r) {
            ?>
                <tr>
                    <td><?= $r->id; ?></td>
                    <?php
                        $student = new Student();
                        $student_set = $student->findByStudentId($r->student_id);
                    ?>
                    <td><?= $student_set->first_name . " " . $student_set->middle_name . " " . $student_set->last_name; ?></td>
                    <?php
                        $library_request = new LibraryRequest();
                        $library_request_set = $library_request->findBy('id', $r->library_req_id);
                    ?>
                    <td><?= $library_request_set->req_description; ?></td>
                    <td>
                        <a href="?page=library&lists&view&id=<?= $r->id; ?>" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            <?php
            }
            }else{
            ?>
                <tr>
                    <td colspan="3" class="text-center">No data found.</td>
                </tr>
            <?php
            }
            ?>
    </table>
</div>

<?php
if(isset($_GET['view'])){
    $id = $_GET['id'];

    $library = new Library();
    $library_set = $library->find($id);

    $student = new Student();
    $student_set = $student->findByStudentId($library_set->student_id);
    ?>
    
    <div class="card d-absolute top-50 start-50 translate-middle shadow-lg" style="height: 500px; width: 50rem;">
        <div class="card-header">
            <h4 class="card-title">
                Details
            </h4>
        </div>
        <div class="card-body" style="overflow-y: scroll;">
            <div class="row">
                <div class="col-sm-2">
                    <h6>Library ID</h6>
                    <p class="card-text text-muted text-uppercase">
                        <?= $library_set->id; ?>
                    </p>
                </div>
                <div class="col-sm-3">
                    <h6>Student ID</h6>
                    <p class="card-text text-muted text-uppercase">
                        <?= $student_set->student_id; ?>
                    </p>
                </div>
                <div class="col-sm-3">
                    <h6>Student Name</h6>
                    <p class="card-text text-muted text-uppercase">
                        <?= $student_set->first_name . " " . $student_set->middle_name . " " . $student_set->last_name; ?>
                    </p>
                </div>
                <div class="col-sm-2">
                    <h6>Logs In</h6>
                    <a href="?page=library&lists&view&logs=in&id=<?= $library_set->id; ?>" class="btn btn-success btn-sm">In</a>
                </div>
                <div class="col-sm-2">
                    <h6>Logs Out</h6>
                    <a href="?page=library&lists&view&logs=out&id=<?= $library_set->id; ?>" class="btn btn-danger btn-sm">Out</a>
                </div>
            </div>
            <hr>
                <?php
                $library_request = new LibraryRequest();
                $library_request_set = $library_request->find($library_set->library_req_id);
                ?>
            <h6 class="card-title">
                Purpose
            </h6>
            <p class="card-text text-muted text-uppercase">
                <?= $library_request_set->req_description; ?>
            </p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date and Time</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $library_logs = new LibraryLogs();
                        $library_logs_set = $library_logs->findByLike('library_id', $library_set->id);
                        foreach ($library_logs_set as $r) {
                        ?>
                            <tr>
                                <td><?= date('F d, Y h:i A', strtotime($r->logs_datetime)); ?></td>
                                <td>
                                    <?php if($r->logs_status == 'in'): ?>
                                        <span class="badge bg-success">In</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Out</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <a href="?page=library&lists" class="btn btn-secondary">Close</a>
        </div>
    </div>

    <?php

}

}elseif(isset($_GET['requests'])){
    $requests = $_GET['requests'];
    
    $library_request = new LibraryRequest();
    $library_request_set = $library_request->findAll();
?>
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-sub-header">
                <h3 class="page-title">
                    <?= $title ?> Requests
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
                <th scope="col">Request ID</th>
                <th scope="col">Student ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Date and Time</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($library_request_set as $r) {
            ?>
                <tr>
                    <td><?= $r->id; ?></td>
                    <?php
                        $student = new Student();
                        $student_set = $student->findByStudentId($r->student_id);
                    ?>
                    <td><?= $student_set->student_id; ?></td>
                    <td><?= $student_set->first_name . " " . $student_set->middle_name . " " . $student_set->last_name; ?></td>
                    <td><?= date('F d, Y h:i A', strtotime($r->req_datetime)); ?></td>
                    <td><?= $r->req_description; ?></td>
                    <td>
                        <?php if($r->status == 0): ?>
                            <a href="?page=library&requests&approve&id=<?= $r->id; ?>" class="btn btn-success btn-sm">Approve</a>
                            <a href="?page=library&requests&deny&id=<?= $r->id; ?>" class="btn btn-danger btn-sm">Deny</a>
                        <?php elseif($r->status == 1): ?>
                            <span class="badge bg-success">Approved</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Denied</span>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php
            }
            ?>
    </table>
</div>
<?php
if(isset($_GET['approve'])){
    $id = $_GET['id'];
    
    $library_request = new LibraryRequest();
    $library_request_set = $library_request->find($id);
    
    $library = new Library();

    $library_set = $library->insert([
        'library_req_id' => $library_request_set->id,
        'student_id' => $library_request_set->student_id
    ]);
    
    $library_request->update($id, [
        'status' => 1
    ]);
    
    echo "<script>window.location.href = '?page=library&requests'; </script>";
}elseif(isset($_GET['deny'])){
    $id = $_GET['id'];
    
    $library_request = new LibraryRequest();
    $library_request_set = $library_request->find($id);
    
    $library_request->update($id, [
        'status' => 2
    ]);
    
    echo "<script>window.location.href = '?page=library&requests'; </script>";
}elseif(isset($_GET['logs']) && $_GET['logs'] == 'in'){
    $logs = $_GET['logs'];
    $id = $_GET['id'];

    $library_logs = new LibraryLogs();
    $library_logs_set = $library_logs->insert([
        'student_id' => 1,
        'library_id' => 1,
        'date' => date('Y-m-d H:i:s'),
        'logs_status' => $logs
    ]);

    echo "<script>window.location.href = '?page=library&lists&view&logs=out&id=$id'; </script>";
}elseif(isset($_GET['logs']) && $_GET['logs'] == 'out'){
    $logs = $_GET['logs'];
    $id = $_GET['id'];

    $library = new Library();
    $library_set = $library->find($id);

    $library_logs = new LibraryLogs();
    $library_logs_set = $library_logs->insert([
        'student_id' => $library_set->student_id,
        'library_id' => $library_set->id,
        'date' => date('Y-m-d H:i:s'),
        'logs_status' => $logs
    ]);

    // echo "<script>window.location.href = '?page=library&lists&view&id=$id'; </script>";
}

}