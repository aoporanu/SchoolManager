<?php
App::uses('Lesson', 'SchoolManager.Model');

/**
 * Lesson Test Case
 *
 */
class LessonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.school_manager.lesson',
		'plugin.school_manager.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Lesson = ClassRegistry::init('SchoolManager.Lesson');
	}

	public function testRatePaper($paperId) {
		$query = $this->Lesson->findById($paperId);
		$this->assertInstanceOf('Cake\ORM\Query', $query);
		$result = $query->hydrate(false)->toArray();
		
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Lesson);

		parent::tearDown();
	}

}
