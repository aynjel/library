<?php

// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     try{
//         $validate = new Validate();
//         $validation = $validate->check($_POST, array(
//             'datetime' => [
//                 'display' => 'Date and Time',
//                 'required' => true,
//             ],
//             'description' => [
//                 'display' => 'Description',
//                 'required' => true,
//             ]
//         ));

//         if($validation->passed()){
//             $library_request = new LibraryRequest();
//             $res = $library_request->addLibraryRequest([
//                 'student_id' => $student->getStudentId(),
//                 'req_datetime' => Input::get('datetime'),
//                 'req_description' => Input::get('description'),
//             ]);
//             if($res){
//                 $success = 'Request sent successfully';
//                 echo "<script>setTimeout(\"location.href = '?page=request';\",1500);</script>";
//             }else{
//                 $error = 'Something went wrong';
//             }
//         }else{
//             $error = implode('<br>', $validation->errors());
//         }
//     }catch(Exception $e){
//         $error = $e->getMessage();
//     }
// }

// $library_request = new LibraryRequest();
// $requests = $library_request->getLibraryRequestsByLike('student_id', $student->getStudentId());

?>

<div class="row">
    <div class="col-xl-12 d-flex">

        <div class="card flex-fill comman-shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title ">Request Slot Information </h5>
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
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"
                                placeholder="Enter description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <h5 class="card-title ">Pending Request </h5>
                        <hr>
                        <div class="activity-groups">
                            <div class="activity-awards">
                                <div class="award-boxs">
                                    <i class="fas fa-xs fa-check"></i>
                                    <!-- <?php if($r->status == 1): ?>
                                    <?php else: ?>
                                        <i class="fas fa-xs fa-times"></i>
                                    <?php endif; ?> -->
                                </div>
                                <div class="award-list-outs">
                                    <h4>Datetime</h4>
                                    <h5>Purpose</h5>
                                </div>
                                <div class="award-time-list">
                                    Pending
                                    <!-- <span><?= $r->status == 1 ? 'Approved' : 'Pending' ?></span> -->
                                </div>
                            </div>
                        </div>
                        <!-- <?php foreach($requests as $r): ?> -->
                        <!-- <?php endforeach; ?> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>