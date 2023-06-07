
<div class="card flex-fill student-space comman-shadow">
    <div class="card-header d-flex align-items-center">
        <h5 class="card-title">Library List</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table
                class="table star-student table-hover table-center table-borderless table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Student ID</th>
                        <th>Description/Purpose</th>
                        <th>Date and Timed</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($approved_req > 0): ?>
                    <?php foreach($approved_req as $r): ?>
                    <tr>
                        <td><?= $r->student_id; ?></td>
                        <td><?= $r->req_description; ?></td>
                        <td><?= date('F d, Y h:i A', strtotime($r->req_datetime)); ?></td>
                        <td>
                            <span class="badge badge-success">Approved</span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                        
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No approved requests found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function changeStatus(status, id){
        $.ajax({
            url: 'backend/ajax/changeStatus.php',
            method: 'POST',
            data: {
                status: status,
                id: id
            },
            success: function(data){
                if(data == 'success'){
                    location.reload();
                }
            }
        });
    }
</script>