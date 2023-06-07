<?php
$library_request = new LibraryRequest();
$requests = $library_request->getLibraryApprovedRequestsByLike('student_id', $student->getStudentId());
?>
<div class="row">
    <div class="col-xl-12 d-flex">

        <div class="card flex-fill comman-shadow">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title ">Request History </h5>
            </div>
            <div class="card-body">
                <?php if($requests > 0):?>
                <?php foreach($requests as $r): ?>
                    <a class="activity-groups" href="?page=logs&id=<?= $r->id ?>">
                        <div class="activity-awards">
                            <div class="award-boxs">
                                <?php if($r->status == 1): ?>
                                    <i class="fas fa-xs fa-check"></i>
                                <?php else: ?>
                                    <i class="fas fa-xs fa-times"></i>
                                <?php endif; ?>
                            </div>
                            <div class="award-list-outs">
                                <h4>
                                    <?= date('d M Y h:i A', strtotime($r->req_datetime)) ?>
                                </h4>
                                <h5>
                                    <?= $r->req_description ?>
                                </h5>
                            </div>
                            <div class="award-time-list">
                                <span><?= $r->status == 1 ? 'Approved' : 'Pending' ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">No Request has been accepted yet</div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>