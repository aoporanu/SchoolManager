<?php
/**
 * Created by PhpStorm.
 * User: adyopo
 * Date: 25.10.2014
 * Time: 21:41
 */

Router::connect('/lessons', array('plugin' => 'SchoolManager',
    'controller' => 'Lessons'));
Router::connect('/add-lesson', array('plugin' => 'SchoolManager',
    'controller' => 'Lessons', 'action'=> 'add'));
Router::connect('/edit-lesson/:id', array('plugin' => 'SchoolManager',
    'controller' =>'Lessons', 'action' => 'edit'));
Router::connect('/enroll/:id', array('plugin' => 'SchoolManager',
    'controller' =>'Lessons', 'action' => 'enroll'));
Router::connect('/disenroll/:id', array('plugin' => 'SchoolManager',
    'controller' =>'Lessons', 'action' => 'disenroll'));
Router::connect('/lesson/:id', array('plugin' => 'SchoolManager',
    'controller' => 'Lessons', 'action' => 'view'));
Router::connect('/classes', array('plugin' => 'SchoolManager', 'controller' => 'lessons', 'action' => 'classes_index'));
Router::connect('/rate-paper', array('plugin' => 'SchoolManager', 'controller' => 'lessons', 'action' => 'ratePaper'));
Router::connect('/enter-phone', array('plugin' => 'SchoolManager', 'controller' => 'lessons', 'action' => 'enterPhone'));
