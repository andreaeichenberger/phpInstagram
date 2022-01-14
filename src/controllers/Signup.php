<?php

namespace Eichenberger\Instagram\controllers;

use Eichenberger\Instagram\lib\Controller;
use Eichenberger\Instagram\lib\UtilImages;
use Eichenberger\Instagram\models\User;

class Signup extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    public function register(){
        $username = $this->post('username');
        $password = $this->post('password');
        $profile = $this->file('profile');

        if(!is_null($username) && !is_null($password) && !is_null($profile)){
            $url = UtilImages::storeImage($profile);
            $user = new User($username, $password);
            $user->setProfile($url);
            $user->save();
            header('location: login');
        }else{
            $this->render('errors/index');
        }
    }
}