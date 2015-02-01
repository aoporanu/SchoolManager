<form method="post">
    <?php
    $userSession = CakeSession::read('Auth.User');
    var_dump($userSession);

    // check if teacher has a phone number attached

    if (!array_key_exists('phone', $userSession) || is_null($userSession['phone'])) {
    if (isset($errors['phone']) && !empty($errors['phone'])) { ?>
        <div class="bs-callout bs-calloud-info">
            <p class="bg-danger">
                <button class="close" type="button">
                    <span area-hidden="true">&times;</span>
                    <span class="sr-only">
                        Close
                    </span>
                </button>
            </p>
        </div>
        <?php } ?>
        <div class="form-group <?php if(isset($errors['phone']) && !empty($errors['phone'])) { echo 'has-error'; } ?>">
            <input class="form-control" type="text" name="phone" placeholder="Teacher phone" autocomplete="off" />
        </div>
    <?php } ?>
    <div class="form-group">
        <input type="checkbox" name="lesson-is_active" id="IsActive"
            value="1" />
        <label for="IsActive">
            Active (y/n)
        </label>
    </div>
    <?php if (isset($errors['name']) && !empty($errors['name'])) { ?>
        <div class="bs-callout bs-callout-info">
            <p class="bg-danger">
                <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <?php echo $errors['name'][0]; ?>
            </p>
        </div>
    <?php } ?>
    <div class="form-group <?php if (isset($errors['name']) && !empty
                              ($errors['name'])) { echo 'has-error'; } ?>">
        <input type="text" name="lesson-name" id="LessonName"
        autocomplete="off" required class="form-control" placeholder="Lesson
        name"/>
    </div>
    <?php if (isset($errors['date_start']) && !empty($errors['date_start']))
    { ?>
        <div class="bs-callout bs-callout-info">
            <p class="bg-danger">
                <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <?php echo $errors['date_start'][0]; ?>
            </p>
        </div>
    <?php } ?>
    <div class="form-group <?php if (isset($errors['date_start']) && !empty
    ($errors['date_start'])) { echo 'has-error'; } ?>">
        <input type="date" name="lesson-date_start" id="DateStart"
        autocomplete="off" required class="form-control" placeholder="Start
        date" />
    </div>
    <?php if (isset($errors['date_end']) && !empty($errors['date_end'])) { ?>
        <div class="bs-callout bs-callout-info">
            <p class="bg-danger">
                <button type="button" class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <?php echo $errors['date_end'][0]; ?>
            </p>
        </div>
    <?php } ?>
    <div class="form-group <?php if (isset($errors['date_end']) && !empty
                              ($errors['date_end'])) { echo 'has-error'; } ?>">
        <input type="date" name="lesson-date_end" id="DateEnd"
        autocomplete="off" required class="form-control" placeholder="End
        date"/>

    </div>
    <div class="form-group">
        <input type="submit" name="add-lesson" class="btn btn-primary"
        value="Add lesson" />
    </div>
</form>
<?php
if($modal == true) {
?>
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form action="/enter-phone" method="post">
                        <label for="phone_no">Phone number</label> *
                        <input type="text" name="phone" id="phone" />
                        <input class="btn btn-primary" name="save" id="save" value="Save" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php } ?>