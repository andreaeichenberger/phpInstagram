<?php

namespace Eichenberger\Instagram\controllers;

use Eichenberger\Instagram\lib\Controller;
use Eichenberger\Instagram\models\User;

class Profile extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getUserProfile(User $user) {
        $user->fetchPosts();
        $this->render('profile/index', ['user' => $user]);
    }

    public function getUsernameProfile(string $username) {
        $user = User::get($username);
        $user->fetchPosts();
        $this->getUserProfile($user);
    }
}