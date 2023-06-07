
<div class="card flex-fill student-space comman-shadow">
    <div class="card-header d-flex align-items-center">
        <h5 class="card-title">Library Requests</h5>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($requests > 0): ?>
                    <?php foreach($requests as $r): ?>
                    <tr>
                        <td><?= $r->student_id; ?></td>
                        <td><?= $r->req_description; ?></td>
                        <td><?= date('F d, Y h:i A', strtotime($r->req_datetime)); ?></td>
                        <td>
                            <?php if($r->status == 0): ?>
                            <span class="badge badge-warning">Pending</span>
                            <?php elseif($r->status == 1): ?>
                            <span class="badge badge-success">Approved</span>
                            <?php else: ?>
                            <span class="badge badge-danger">Rejected</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <select name="status" id="status" class="form-control" onchange="changeStatus(this.value, <?= $r->id; ?>)">
                                <option value="0" <?= $r->status == 0 ? 'selected' : ''; ?>>Pending</option>
                                <option value="1" <?= $r->status == 1 ? 'selected' : ''; ?>>Approved</option>
                                <option value="2" <?= $r->status == 2 ? 'selected' : ''; ?>>Rejected</option>
                            </select>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                        
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No requests found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
