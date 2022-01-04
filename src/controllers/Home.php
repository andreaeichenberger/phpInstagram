<?php

namespace Eichenberger\Instagram\controllers;

use Eichenberger\Instagram\lib\Controller;
use Eichenberger\Instagram\lib\UtilImages;
use Eichenberger\Instagram\models\User;
use Eichenberger\Instagram\models\PostImage;

class Home extends Controller {

    public function __construct(private User $user) {
        parent::__construct();
    }

    public function index() {
        $posts = PostImage::getFeed();
        $this->render('home/index', ['user' => $this->user, 'posts' => $posts]);
    }

    public function store() {
        $title = $this->post('title');
        $image = $this->file('image');

        if(!is_null($title) && !is_null($image)) {
        $fileName = UtilImages::storeImage($image);

        $post = new PostImage($title, $fileName);
        $this->user->publish($post);
        header('location: /instagram/home');

        } else {
            header('location: /instagram/home');
        };
    }
}