<?php if (isset($lesson['Lesson']['id'])) { ?>
    <h2>Viewing lesson's <?php echo $lesson['Lesson']['name']; ?>
    details</h2>
    <table class="table table-responsive">
        <tbody>
            <tr>
                <td><strong>Id</strong></td>
                <td><?php echo $lesson['Lesson']['id']; ?></td>
            </tr>
            <tr>
                <td><strong>Lesson Name</strong></td>
                <td><?php echo $lesson['Lesson']['name']; ?></td>
            </tr>
            <tr>
                <td><strong>Students attending</strong></td>
                <td><?php echo $this->Lesson->attendeesFor($lesson['Lesson']['id']) ?></td>
            </tr>
            <tr>
                <td><strong>Teacher</strong></td>
                <td><?php echo $this->Lesson->teacherFor($lesson['Lesson']['id']) ?></td>
            </tr>
            <tr>
                <td><strong>Description</strong></td>
                <td><?php echo $lesson['Lesson']['description']; ?></td>
            </tr>
        <tbody>
    </table>
    <?php if ( $user['role'] == 'student' ) { ?>ve

    <?php } ?>
    <?php if ( $user['role'] == 'teacher' ) { ?>

    <?php } ?>
<?php } ?>