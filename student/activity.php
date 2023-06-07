<?php

$library_logs = new LibraryLogs();
$logs = $library_logs->getLibraryLogsByStudentId($student->getStudentId());

?>

<div class="row">
    <div class="col-xl-12 d-flex">

        <div class="card flex-fill comman-shadow">
            <div class="card-body">
                <h5 class="card-title ">Library Logs </h5>
                <hr>
                <?php if(count($logs) == 0): ?>
                    <div class="alert alert-info">No Request has been accepted yet</div>
                <?php endif; ?>
                <?php foreach($logs as $l): ?>
                    <?php 
                    $library = new Library();
                    $lib = $library->getLibraryById($l->library_id);
                    ?>
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
                                    <?= $l->student_id ?> | Library ID: <?= $lib->id ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>