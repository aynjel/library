<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try{
        $log = new LibraryLogs();

        $log->createLog([
            'student_id' => $student->getStudentId(),
            'library_id' => Input::get('id'),
            'date' => Input::get('datetime'),
            'logs_status' => Input::get('logs_status'),
        ]);
    }catch(Exception $e){
        $error = $e->getMessage();
    }
}

$log = new LibraryLogs();
$logs = $log->getLibraryLogsByLike('library_id', Input::get('id'));

$library_request = new LibraryRequest();
$req = $library_request->getLibraryRequestById(Input::get('id'));

// $library = new Library();
// $lib = $library->getLibraryById(Input::get('id'));
?>

<div class="row">
    <div class="col-xl-12 d-flex">

        <div class="card flex-fill comman-shadow">
            <div class="card-header">
                <h3 class="card-title ">
                    Purpose: <?= $req->req_description ?>
                </h3>

                <h4 class="card-title ">
                    Date Requested: <?= date('d M Y h:i A', strtotime($req->req_datetime)) ?>
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title ">
                            Logs Form
                        </h5>
                        <hr>
                        <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        <?php if(isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="datetime">Date and Time</label>
                                <input type="datetime-local" class="form-control" id="datetime" name="datetime"
                                    placeholder="Enter date and time" value="">
                            </div>
                            <div class="form-group">
                                <label for="logs_status">Log Status</label>
                                <select class="form-control" id="logs_status" name="logs_status">
                                    <option selected disabled hidden>Select Status</option>
                                    <option value="In">In</option>
                                    <option value="Out">Out</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="col-8 h-100 scroll-y-auto">
                        <h5 class="card-title ">Pending Request </h5>
                        <hr>
                        <?php if($logs > 0):?>
                        <?php foreach($logs as $l): ?>
                            <div class="activity-groups">
                                <div class="activity-awards">
                                    <div class="award-boxs">
                                        <?php if($l->logs_status == 'In'): ?>
                                            In
                                        <?php else: ?>
                                            Out
                                        <?php endif; ?>
                                    </div>
                                    <div class="award-list-outs">
                                        <h4>
                                            <?= date('d M Y h:i A', strtotime($l->date)) ?>
                                        </h4>
                                        <h5>
                                            <?= $l->student_id ?>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info">No Request has been accepted yet</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>