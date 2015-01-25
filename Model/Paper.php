<?php
/**
 * Created by PhpStorm.
 * User: adyopo
 * Date: 1/20/2015
 * Time: 5:59 PM
 */
App::uses('SchoolManagerAppModel', 'SchoolManager.Model');

/**
 * Class Paper Model
 */
class Paper extends SchoolManagerAppModel {

    public function __construct() {
        parent::__construct();
    }

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'student_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'teacher_id'
        )
    );

    public $validate = array(
        'subject' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Letters and numbers only'
            )
        )
    );

    /**
     * @param $paperId
     * Using this method, a teacher can rate a students paper. The student gets an email telling them that their paper has been rated.
     */
    public function ratePaper($paperId, $studentId, $teacherId) {
        // selects the paper by the id
        // this will need to be refactored and a date added, so that a pupil can have more than one paper at the same teacher.
        $paperModel = new Paper();
        $paper = $paperModel->find('first', array(
            'conditions' => array(
                'paper_id' => $paperId,
                'student_id' => $studentId,
                'teacher_id' => $teacherId
            )
        ));
        debug($paper);
        // this means we have a paper
        if(!is_null($paper['Paper'])) {
            return true;
        } else {
            return false;
        }
        // check if the user is a teacher and the student the paper belongs to is enrolled to the
        // teachers course

        // TRUE: show the rating dialog
        // return to this method and send an email (possibly a text message
        // FALSE: show error.
    }
}