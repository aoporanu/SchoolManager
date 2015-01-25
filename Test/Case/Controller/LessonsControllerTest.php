<?php
App::uses('LessonsController', 'SchoolManager.Controller');

/**
 * LessonsController Test Case
 *
 */
class LessonsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.school_manager.lesson'
	);

	public function startTest() {
		$this->Lessons = new LessonsControllerTest;
		$this->Lessons->constructClasses();
		$this->Lessons->Component->initialize($this->Lessons);
	}

	public function testEnroll() {
		$this->Lessons->Session->write('Auth.User', array(
			'id' => '54511837-6f4c-4f17-9dad-04bfd0d3907e',
			'username' => 'adriannoo',
			'role' => 'teacher'
		));

		$this->Lessons->params = Router::parse('/enroll/id/9');
		$this->Lessons->beforeFilter();
		$this->Lessons->Component->startup($this->Lessons);
		$this->Lessons->enroll();
	}

	public function endTest() {
		unset($this->Lessons);
		ClassRegistry::flush();
	}

}
