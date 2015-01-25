<h2>Lessons index</h2>
<?php echo $this->element('SchoolManager.filters') ?>
<?php if (isset($data)) { ?>
    <table class="table responsive">
        <thead>
            <th><?php echo $this->Paginator->sort('id', 'ID #') ?></th>
            <th><?php echo $this->Paginator->sort('name', 'Lesson name') ?></th>
            <th><?php echo $this->Paginator->sort('user_id', 'Teacher\'s name' ) ?></th>
            <th><?php echo $this->Paginator->sort('date_start', 'Start date') ?></th>
            <th><?php echo $this->Paginator->sort('date_end', 'End date') ?></th>
            <th><?php echo $this->Paginator->sort('attendees', 'Students attending') ?></th>
            <th>Actions</th>
        </thead>
        <tbody>
            <?php foreach ($data as $lesson) { ?>
                <tr>
                    <td><?php echo $lesson['Lesson']['id'] ?></td>
                    <td><?php echo $lesson['Lesson']['name'] ?></td>
                    <td><?php echo $this->Lesson->teacherFor($lesson['Lesson']['id']); ?></td>
                    <td><?php echo $lesson['Lesson']['date_start'] ?></td>
                    <td><?php echo $lesson['Lesson']['date_end'] ?></td>
                    <!-- <td><?php echo $lesson['Lesson']['attendees']; ?></td>
                     -->
                    <td><?php echo $this->Lesson->attendeesFor
                    ($lesson['Lesson']['id']) ?></td>
                    <td>
                        <?php echo $this->Html->link('View', '/lesson/' .
                        strtolower(str_replace(' ', '-',
                        $lesson['Lesson']['name'])) . '-' .
                        $lesson['Lesson']['id'],
                        array('class' => 'btn btn-warning')) ?>
                        <?php echo $this->Html->link('Edit', '/lesson/',
                        array('class' => 'btn btn-success')) ?>
                        <?php if($user['role'] == 'student') { ?>
                            <?php
                                // the date on which the lesson starts.
                                $dateStart = new DateTime
                                ($lesson['Lesson']['date_start']);
                                $dateEnd = new DateTime
                                ($lesson['Lesson']['date_end']);
                                $today = new DateTime;
                                if ($dateStart->format('Y-m-d') >
                                $today->format('Y-m-d')) {
                                    $enrolled = $this->Lesson->isEnrolled
                                    ($user['id'], $lesson['Lesson']['id']);
                                    if ($enrolled == true) {
                                        $this->Lesson->generateDisEnrollLink
                                        ($user['id'], strtolower(str_replace(' ', '-', $lesson['Lesson']['name'] . '-' . $lesson['Lesson']['id'])));
                                    } else {
                                        $this->Lesson->generateEnrollLink
                                        ($user['id'], strtolower(str_replace(' ', '-', $lesson['Lesson']['name'] . '-' . $lesson['Lesson']['id'])));
                                    }
                                }
                            ?>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <tbody>
    </table>
    <?php echo $this->Paginator->numbers(array('first' => 'First page')); ?>
<?php } ?>