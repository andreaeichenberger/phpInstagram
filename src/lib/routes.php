<?php

//Controladores que voy a usar
use Eichenberger\Instagram\controllers\Signup;
use Eichenberger\Instagram\controllers\Login;
use Eichenberger\Instagram\controllers\Home;

$router = new \Bramus\Router\Router();
session_start();


//Permitiendo a Dotenv que sobrescriba las variables de entorno

$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . '/../config');
$dotenv->load();


//Rutas por get y por post

$router->get('/', function(){
    echo "Inicio";
});

$router->get('/login', function(){
    $controller = new Login;
    $controller->render('login/index');
});

$router->post('/auth', function() {
    $controller = new Login;
    $controller->auth($_POST);
});

$router->get('/signup', function() { 
    $controller = new Signup;
    $controller->render('signup/index');
});

$router->post('/register', function() { 
    $controller = new Signup;
    $controller->register($_POST);
});

$router->get('/home', function(){
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->index();
});

$router->post('/publish', function(){
    echo "futuro publish";
});

$router->get('/profile', function(){
    echo "futuro profile";
});

$router->post('/addLike', function(){
    echo "futuro addLike";
});

$router->get('/signout', function(){
    echo "futuro signout";
});

$router->get('/profile/{username}', function($username){
    echo "futuro profile";
});

$router->run();