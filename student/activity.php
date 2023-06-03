<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try{
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'datetime' => [
                'display' => 'Date and Time',
                'required' => true,
            ],
            'description' => [
                'display' => 'Description',
                'required' => true,
            ]
        ));

        if($validation->passed()){
            $library_request = new LibraryRequest();
            $res = $library_request->addLibraryRequest([
                'student_id' => $student->getStudentId(),
                'req_datetime' => Input::get('datetime'),
                'req_description' => Input::get('description'),
            ]);
            if($res){
                $success = 'Request sent successfully';
                echo "<script>setTimeout(\"location.href = '?page=request';\",1500);</script>";
            }else{
                $error = 'Something went wrong';
            }
        }else{
            $error = implode('<br>', $validation->errors());
        }
    }catch(Exception $e){
        $error = $e->getMessage();
    }
}

$library_request = new LibraryRequest();
$requests = $library_request->getApprovedLibraryRequest();

$library_logs = new LibraryLogs();
$logs = $library_logs->getLibraryLogsByLike('student_id', $student->getStudentId());

?>

<div class="row">
    <div class="col-xl-12 d-flex">

        <div class="card flex-fill comman-shadow">
            <div class="card-body">
                <h5 class="card-title ">Library Logs </h5>
                <hr>
                <?php if(count($requests) == 0): ?>
                    <div class="alert alert-info">No Request has been accepted yet</div>
                <?php endif; ?>
                <?php foreach($requests as $r): ?>
                    <a href="?page=logs&id=<?= $r->id ?>">
                        <div class="activity-groups">
                            <div class="activity-awards">
                                <div class="award-boxs">
                                    <?php if($r->status == 1): ?>
                                        <i class="fas fa-xs fa-check"></i>
                                    <?php else: ?>
                                        <i class="fas fa-xs fa-times"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="award-list-outs">
                                    <h4><?= date('F d, Y h:i A', strtotime($r->req_datetime)) ?></h4>
                                    <h5><?= $r->req_description ?></h5>
                                </div>
                                <div class="award-time-list">
                                    <span><?= $r->status == 1 ? 'Approved' : 'Pending' ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>