<?php
App::uses('SchoolManagerAppController', 'SchoolManager.Controller');

class PapersController extends SchoolManagerAppController {
    public $uses = array('SchoolManager.Paper', 'Users.User');
    public $components = array('Paginator', 'Auth');

    /**
     * Must build a filter.
     * The method will only show papers that the teacher can give out.
     */
    public function index() {
        $this->set(array('data' => $this->Paginator->paginate('Paper')));
    }

    public function add() {

    }

    public function paperRating() {

    }
}