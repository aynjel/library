<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-sub-header">
                <h3 class="page-title">
                    <?= $title ?>
                </h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-sm-6 col-12 d-flex">
        <a class="card bg-comman w-100" href="?page=students" title="Students">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Students</h6>
                        <h3>
                            <?= count($students) ?>
                        </h3>
                    </div>
                    <div class="db-icon bg-success">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-6 col-sm-6 col-12 d-flex">
        <a class="card bg-comman w-100" href="?page=library_requests" title="Pending Requests">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Requests</h6>
                        <h3>
                            <?= count($req_pending) ?>
                        </h3>
                    </div>
                    <div class="db-icon bg-warning">
                        <i class="fas fa-book-reader"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 d-flex">

        <div class="card flex-fill comman-shadow">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title ">Approved Slot Request <?= count($lib); ?></h5>
            </div>
            <div class="card-body">
                <?php foreach($lib as $l): ?>
                    <?php 
                        $st = $student->findBy(['id'], [$l->student_id])->first();
                        $lib_r = $lib_req->find(['id', '=', $l->library_req_id])->first();
                    ?>
                    <a href="?page=library_view&id=<?=$l->id;?>">
                        <div class="activity-groups">
                            <div class="activity-awards border-bottom shadow-sm">
                                <div class="award-boxs bg-success">
                                    <i class="fas fa-check-circle text-white"></i>
                                </div>
                                <div class="award-list-outs">
                                    <h4>
                                        <span title="Library ID"><i class="fas fa-book-reader"></i> <?= $l->id ?></span> | <span title="Student"><i class="fas fa-user-graduate"></i> <?= $st->first_name.' '.$st->middle_name.' '.$st->last_name ?></span>
                                    </h4>
                                    <h5>
                                        <span title="Request Date"><i class="fas fa-calendar-alt"></i> <?= date('F d, Y h:i A', strtotime($lib_r->req_datetime)) ?></span> | <span title="Purpose"><i class="fas fa-flag"></i> <?= $lib_r->req_description ?></span>
                                    </h5>
                                </div>
                                <div class="award-time-list">
                                    <span class="time-lists" title="Approved Date">
                                        <strong>Approved By:</strong> Admin | <i class="fas fa-clock"></i> <?= date('F d, Y h:i A', strtotime($l->approved_datetime)) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-sm-4 col-12">
        <div class="card flex-fill fb sm-box">
            <div class="social-likes">
                <p>Like us on facebook</p>
                <h6>50,095</h6>
            </div>
            <div class="social-boxs">
                <img src="../assets/img/icons/social-icon-01.svg" alt="Social Icon">
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-4 col-12">
        <div class="card flex-fill twitter sm-box">
            <div class="social-likes">
                <p>Follow us on twitter</p>
                <h6>48,596</h6>
            </div>
            <div class="social-boxs">
                <img src="../assets/img/icons/social-icon-02.svg" alt="Social Icon">
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-4 col-12">
        <div class="card flex-fill insta sm-box">
            <div class="social-likes">
                <p>Follow us on instagram</p>
                <h6>52,085</h6>
            </div>
            <div class="social-boxs">
                <img src="../assets/img/icons/social-icon-03.svg" alt="Social Icon">
            </div>
        </div>
    </div>
</div>