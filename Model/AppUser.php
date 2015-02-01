<?php
/**
 * Created by PhpStorm.
 * User: adyopo
 * Date: 29.10.2014
 * Time: 21:22
 */

App::uses('User', 'Users.Model');

class AppUser extends User {
    public $name = 'AppUser';

    public $useTable = 'users';

    public function savePhone() {
        $user = CakeSession::read('Auth.User');
        var_dump($user);
        $userDb = $this->findById($user['id']);
        var_dump($userDb);
        die('xxx');
    }
} 