<?php
App::uses('SchoolManagerAppModel', 'SchoolManager.Model');
App::import('Model', 'SchoolManager.Paper');
/**
 * Lesson Model
 *
 * @property User $User
 */
class Lesson extends SchoolManagerAppModel {

    public function __construct() {
        parent::__construct();
    }

    /**
     * belongsTo associations
     *
     * @var array
     */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		)
	);

    public $validate = array(
        'name' => array(
            'alphaNumeric' => array(
                'rule' => 'notEmpty',
                'required' => true
            )
        ),

        'date_start' => array(
            'rule' => 'minToday',
            'message' => 'The start date must be at least today'
        ),

        'date_end' => array(
            'rule' => 'minDateStartPlusThirty',
            'message' => 'The two dates must be at least 30 days apart.'
        ),

        'user_id' => array(
            'rule' => 'notEmpty',
            'required' => true
        )
    );

    /**
     * Validation custom function
     * It should at least be today
     */
    public function minToday($check) {
        $value = array_values($check);
        $value = $value[0];

        return $value <= date('Y-m-d');
    }

    /**
     * Validation custom function
     * date_end should be at least date_start + 30.
     */
    public function minDateStartPlusThirty($check) {
        $value = array_values($check);
        $value = $value[0];
        $date = new DateTime($value);
        $dateStart = new DateTime($this->data['Lesson']['date_start']);
        return $date->sub(new DateInterval("P1M")) > $dateStart;
    }

    /**
     * Build filter array for the pagination.
     * @param null $query
     * @return array
     */
    public function buildFilter($query = null) {
        if($query) {
            $filters = array();
            if (isset($query['name']) && !empty($query['name'])) {
                $filters['Lesson.name LIKE'] = '%' . $query['name'] . '%';
            }
            if (isset($query['start-date']) && !empty($query['start-date'])) {
                $filters['date_start'] = $query['start-date'];
            }
            if (isset($query['end-date']) && !empty($query['end-date'])) {
                $filters['date_end'] = $query['end-date'];
            }

            if (isset($query['active']) && !empty($query['active'])) {
                $filters['is_active'] = $query['active'];
            }
            if (isset($query['teacher']) && !empty($query['teacher'])) {
                throw new NotImplementedException('Filtering by the teacher
                field is not yet implemented');
            }
            return $filters;
        }
    }

    /**
     * Is the user enrolled for a course?
     *
     * @param $userId
     * @param $lessonId
     * @return bool
     */
    public function isEnrolled($userId, $lessonId) {
        $count = $this->query("select count(*) as i from lessson_students where
        user_id =
        '$userId' and lesson_id = $lessonId");
        if($count[0][0]['i'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getBySlug($slug) {
        $plug = explode('-', $slug);
        $id = $plug[count($plug) - 1];
        return $this->findById($id);
    }

    /**
     * @param $userId
     * @param $lessonId
     * @return string
     */
    public function enroll($lessonId) {
        $lesson = explode('-', $lessonId);
        $userId = CakeSession::read('Auth.User.id');
        $count = $this->query("select count(*) as count from lessson_students where
        user_id = '$userId' and
lesson_id ='$lessonId'");
        // vezi ca lectia sa nu fi inceput deja.
        $startDate = $this->read('date_start', $lessonId);
        if ( $this->teacherFor($lessonId) == 'N/A' || is_null($this->teacherFor($lessonId)) ) {
            throw new Exception('There\'s no teacher appointed to this lesson');
        }
        $msg = '';
        if ($startDate['Lesson']['date_start'] <= date('Y-m-d')) {
            $msg .= 'The lesson has already started.';
        } else {
            $msg = '';
            if ($count[0][0]['count'] == '0') {
                $today = date('Y-m-d');
                $this->query("insert into lessson_students set `user_id` = '$userId',
`lesson_id` = '$lessonId', created_at = '$today', `updated_at` = '$today';");
                $this->query("update lessons set students_for_lesson =
            students_for_lesson + 1 where id = '$lessonId'");
                $msg .= 'You have enrolled to this lesson';
            } else {
                $msg .= 'You are already enrolled for this course';
            }
            return $msg;
        }
    }

    public function disenroll($userId, $lessonId) {
        $count = $this->query("select count(*) as count from lessson_students where user_id = '$userId' and
 lesson_id = '$lessonId'");
        $startDate = $this->read('date_start', $lessonId);
        $msg = '';
        if ( $this->teacherFor($lessonId) == '' || is_null($this->teacherFor($lessonId)) ) {
            throw new Exception('There\'s no teacher appointed to this lesson');
            return false;
        }
        if ($startDate['Lesson']['date_start'] <= date('Y-m-d')) {
            $msg .= 'The lesson has already started.';
        } else {
            if ($count[0][0]['count'] != '0') {
                $today = date('Y-m-d');
                $this->query("delete from lessson_students where `user_id` = '$userId' and `lesson_id` =
'$lessonId'");
                $this->query("update lessons set students_for_lesson = students_for_lesson - 1 where id
='$lessonId'");
                $msg .= 'You have unsubscribed from this lesson';
            } else {
                $msg .= 'You have already unsubscribed from this lesson';
            }

        }
        return $msg;
    }

    public function attendeesFor($lessonId) {
        $count = $this->query("select count(*) as count from lessson_students
         where lesson_id = '$lessonId'");
        return $count[0][0]['count'];
    }

    public function teacherFor($lessonId) {
        $teacher = $this->read('user_id', $lessonId);
        if ( !is_null($teacher['Lesson']['user_id']) && ($teacher['Lesson']['user_id'] != '') ) {
            $teacherId = $teacher['Lesson']['user_id'];
            $teacherName = $this->query("select username from users where id = '$teacherId'");
            return $teacherName[0]['users']['username'];
        } else {
            return 'N/A';
        }
    }

    public function teachersCourses($userId) {
        return $this->query("select * from lessons where user_id = '$userId'");
    }
}
