<?php
App::uses('SchoolManagerAppController', 'SchoolManager.Controller');
/**
 * Lessons Controller
 *
 */
class LessonsController extends SchoolManagerAppController {
    public $uses = array('SchoolManager.Lesson', 'Users.User', 'SchoolManager.AppUser');
    public $components = array('Paginator', 'Auth', 'Twilio.Twilio');

    public function beforeFilter() {
        $this->Auth->allow('ratePaper');
        // allowed only for teachers.
        if ($this->Auth->user('role') == 'teacher') {
            $this->Auth->allowedActions = array('index', 'view', 'add', 'edit');
        }
        // actions allowed only to users
        if ($this->Auth->user('role') == 'student') {
            $this->Auth->allowedActions = array('enroll', 'disenroll');
        }

        if ($this->Auth->user('role') == 'admin') {
            $this->Auth->allow('*');
        }
    }

    public function index() {
        $this->helpers[] = 'SchoolManager.Lesson';
        if ($this->request->is('get')) {
            $query = $this->request->query;
            $filters = $this->Lesson->buildFilter($query);
            if ((isset($data['date_start']) && !isset($data['date_end'])) &&
                (!empty($data['date_start']) && empty($data['date_end'])) ||
                (!isset($data['date_start']) && isset($data['date_end'])) &&
                (empty($data['date_start']) && !empty($data['date_end']))
            ) {
                $this->Session->setFlash(__('If you choose the start date,
                then you must also pick an end date.'));
                return $this->redirect('/lessons');
            }
            $data = $this->Paginator->paginate('Lesson', $filters);
        } else {
            $data = $this->Paginator->paginate('Lesson', array('Lesson.is_active'
            => '1'));
        }
        $this->set(array('data' => $data, 'user' => $this->Auth->user()));
    }

    public function add() {
        // don't allow people other than admins to add lessons.
        $teachers = $this->User->findAllByRole('teacher');
        $this->set(compact('teachers'));
        $this->set('modal', false);
        if ($this->request->is('post')) {
            $post = $this->request->data;
            $data = array(
                'name' => $post['lesson-name'],
                'date_start' => date('Y-m-d',
                strtotime($post['lesson-date_start'])),
                'date_end' => date('Y-m-d',
                    strtotime($post['lesson-date_end'])),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
                'user_id' => $this->Auth->user('id')
            );

            if(array_key_exists('phone', $post)) {
                $this->AppUser->savePhone($post['phone']);
            }

            if (isset($post['lesson-is_active'])) {
                $data['is_active'] = $post['lesson-is_active'];
            }
            if ($this->Lesson->save($data)) {
                $this->Session->setFlash(__('The lesson has been saved'));
                // send text message
                if(CakeSession::read('Auth.User.phone_no')) {
                    $this->Twilio->sendSingleSms('', 'You have just added ' . $data['name'] . ' to your courses catalog');
                } else {
                    // mark the lesson as inactive
                    $this->Lesson->markInactive($this->Lesson->getLastInsertId());
                    // send an email to the user telling them to update their profile and include a phone number.
                    $this->set('modal', true);
                }

            } else {
                $errors = $this->Lesson->invalidFields();
                $values = $this->request->data;
                $this->set(compact('errors', 'values'));
                $this->Session->setFlash(__('There were problems saving the
                lesson'));
            }
        }
    }

    public function edit($id = null) {
        if($this->Auth->user('role') != 'admin') {
            $this->Session->setFlash(__('Only admins can add lessons'));
            return $this->redirect('/lessons');
        }
        if ($this->request->is('post')) {
            if($this->Lesson->save($this->request->data)) {
                $this->Session->setFlash(__('Lesson saved'));
                return $this->redirect('/lessons');
            }
        }
        $this->set('lesson', $this->Lesson->findById($id));
    }

    public function delete($id = null) {
        // this will always come from a form.
        if($this->Auth->user('role') != 'admin') {
            $this->Session->setFlash(__('Only admins can add lessons'));
            return $this->redirect('/lessons');
        }
        if ($id) {
            if ($this->Lesson->delete($this->request->data('Lesson.id'))) {
                $this->Session->setFlash(__('The lesson has been deleted'));
                return $this->redirect('/lessons');
            }
        }
    }

    public function view() {
        $id = $this->request->params['id'];
        if ($id) {
            $lesson = $this->Lesson->getBySlug($id);
            $user = $this->Auth->user();
            $this->set(compact('lesson', 'user'));
        }
    }

    /**
     * This method will be used <em>ONLY</em> by students to enroll to new classes.
     */
    public function enroll() {
        if ($this->Auth->user('role') != 'student') {
            $this->Session->setFlash(__('Only students can enroll into
            classes'));
            return $this->redirect('/lessons');
        }
        /*$userId = $this->Auth->user('id');
        $lessonId = $this->request->params['id'];
        $lesson = explode('-', $lessonId);*/
        $this->Session->setFlash($this->Lesson->enroll($this->request->params['id']));
        return $this->redirect('/lessons');
    }

    /**
     * Opposite of the enroll method.
     */
    public function disenroll() {
        if ($this->Auth->user('role') != 'student') {
            $this->Session->setFlash(__('Only students can enroll into
            classes'));
            return $this->redirect('/lessons');
        }
        $userId = $this->Auth->user('id');
        $lessonId = $this->request->params['id'];
        $lesson = explode('-', $lessonId);
        $this->Session->setFlash($this->Lesson->disenroll($userId, $lesson[count($lesson) - 1]));
        return $this->redirect('/lessons');
    }
    
    /**
     * Get all the classes, and students attending a class.
     *
     * @author aoporanu@gmail.com
     */
    public function classes_index() {
      $user = $this->Auth->user();
      $this->set('user', $user);
    }

    /**
     * Method should be called through ajax.
     */
    public function ratePaper() {
        // take the teacher id from the auth user
        // allow only teachers to this method.
        $teacherId = '2';
        $studentId = 1;
        $paperId = 31;
        $this->set('showRating', 0);
        $this->set('showError', 0);
        if ($this->Lesson->ratePaper($paperId, $studentId, $teacherId)) {
            $this->set('showRating', 1);
            // process and set a flag so we can show a field.
        } else {
            $this->set('showError', 1);
        }
    }

    /**
     * If the teacher has not entered his phone no yet, present this method which will save the number they enter into the user table.
     */
    public function enterPhone() {
        if ($this->request->is('post')) {
            $this->Session->setFlash($this->Lesson->enterPhone($this->request->data));
        } else {
            $this->layout = 'ajax_dialog';
        }
    }
}
