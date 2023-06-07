<div class="card flex-fill student-space comman-shadow">
    <div class="card-header d-flex align-items-center">
        <h5 class="card-title">Students</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table
                class="table star-student table-hover table-center table-borderless table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Section</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($students > 0): ?>
                    <?php foreach($students as $student): ?>
                    <tr>
                        <td><?php echo $student->student_id; ?></td>
                        <td><?php echo $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name; ?></td>
                        <td><?php echo $student->course; ?></td>
                        <td><?php echo $student->year_level; ?></td>
                        <td><?php echo $student->section; ?></td>
                    </tr>
                    <?php endforeach; ?>
                        
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No students found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>