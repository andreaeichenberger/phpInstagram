<?php

namespace Eichenberger\Instagram\controllers;

use Eichenberger\Instagram\lib\Controller;
use Eichenberger\Instagram\models\PostImage;
use Eichenberger\Instagram\models\User;

class Actions extends Controller {

    public function __construct(private User $user)
    {
        parent::__construct();
    }

    public function like() {
        $post_id = $this->post('post_id');
        $origin = $this->post('origin');

        if (!is_null($post_id)&& !is_null($origin)) {
            $post = PostImage::get($post_id);

            $post->addLike($this->user);

            header('location: /instagram/' . $origin);
        }
    }
}