<form method="get" class="form-inline">
    <div class="form-group">
        <label class="sr-only" for="name">Lesson name</label>
        <input type="text" id="name" name="name" class="form-control"
        placeholder="Lesson name" />
        <label class="sr-only" for="start-date">Start date</label>
        <input type="text" id="start-date" name="start-date"
        class="form-control" placeholder="Start date" />
        <label class="sr-only" for="end-date">End date</label>
        <input type="text" id="end-date" name="end-date"
        class="form-control" placeholder="End date" />
        <label class="sr-only" for="lesson-teacher">Teacher</label>
        <input type="text" id="lesson-teacher" name="teacher"
        class="form-control" placeholder="Teacher's name" />
        <label for="active">
        <input type="checkbox" name="active" id="active" value="1"
        class="form-control" />
        Active (y/n)
        </label>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-success" name="search"
        value="Filter" />
    </div>
</form>