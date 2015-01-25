<?php
/**
 * Created by PhpStorm.
 * User: adyopo
 * Date: 31.10.2014
 * Time: 15:24
 */
App::uses('AppHelper', 'View/Helper');
App::import('Model', 'SchoolManager.Lesson');

class LessonHelper extends AppHelper {
    var $helpers = array('Html');

    public function attendeesFor($lessonId) {
        $model = new Lesson;
        return $model->attendeesFor($lessonId);
    }

    public function isEnrolled($userId, $lessonId) {
        $model = new Lesson;
        return $model->isEnrolled($userId, $lessonId);
    }

    public function generateDisEnrollLink($userId, $lessonId) {
        echo $this->Html->link('Un-enroll',  '/disenroll/' . $lessonId, array('class' => 'btn btn-danger'));
    }

    public function generateEnrollLink($userId, $lessonId) {
        echo $this->Html->link('Enroll', '/enroll/' . $lessonId, array('class' => 'btn btn-primary'));
    }

    public function teacherFor($lessonId) {
        $model = new Lesson;
        return $model->teacherFor($lessonId);
    }

    /**
     * Get all teacher's courses.
     * @param $userId teacher id
     */
    public function teachersCourses($userId) {
        $model = new Lesson;
        return $model->teachersCourses($userId);
    }
}