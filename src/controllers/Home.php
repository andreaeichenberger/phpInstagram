<?php

namespace Eichenberger\Instagram\controllers;

use Eichenberger\Instagram\lib\Controller;
use Eichenberger\Instagram\models\User;

class Home extends Controller {
    public function __construct(private User $user) {
        parent::__construct();
    }
    public function index() {
       $this->render('home/index', ['user'->$this->user]);
    }
}