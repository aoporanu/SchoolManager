<?php 
/**
 * Users CakePHP Plugin
 *
 * Copyright 2010 - 2014, Cake Development Corporation
 *                 1785 E. Sahara Avenue, Suite 490-423
 *                 Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @Copyright 2010 - 2014, Cake Development Corporation
 * @link      http://github.com/CakeDC/users
 * @package   plugins.users.config.schema
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class SchoolManagerSchema extends CakeSchema {

	public $name = 'schools';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $lessons = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 36),
		'name' => array('type' => 'string', 'null' => false, 'length' => '100'),
		'date_start' => array('type' => 'datetime'),
		'date_end' => array('type' => 'datetime'),
		'created' => array('type' => 'datetime'),
		'updated' => array('type' => 'datetime'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => 0),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1),
			'UNIQUE_PROFILE_PROPERTY' => array('column' => array('user_id'), 'unique' => 1)
		)
	);

	public $lesson_students = array(
		'id' => array('type' => 'integer', 'null' => false, 'length' => '3', 'key' => 'primary'),
		'user_id' => array('type' => 'string', 'null' => false, 'length' => '36'),
		'lesson_id' => array('type' => 'integer', 'null' => false, 'length' => '3')
	);

	public $supplies = array(
		'id' => array(
			'type' => 'integer',
			'null' => false,
			'length' => '4',
			'key' => 'primary',
		),
		'name' => array(
			'type' => 'string',
			'null' => false,
			'length' => '100'
		),
		'no_in_stock' => array(
			'type' => 'integer',
			'null' => false,
			'length' => '3',
			'default' => '1'
		),
		'created' => array(
			'type' => 'datetime'
		),
		'updated' => array(
			'type' => 'datetime'
		)
	);
}
