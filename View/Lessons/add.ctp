<form method="post">
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