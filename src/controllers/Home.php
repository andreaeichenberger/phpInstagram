<?php

namespace Eichenberger\Instagram\controllers;

use Eichenberger\Instagram\lib\Controller;
use Eichenberger\Instagram\models\User;
use Eichenberger\Instagram\lib\UtilImages;

class Home extends Controller {

    public function __construct(private User $user) {
        parent::__construct();
    }

    public function index() {
       $this->render('home/index', ['user' => $this->user]);
    }

    public function store() {
        $title = $this->post('title');
        $image = $this->file('image');

        if(!is_null($title) && !is_null($image)) {
        $fileName = UtilImages::storeImage($image);
        } else {
            header('location: /instagram/home');
        };
    }
}