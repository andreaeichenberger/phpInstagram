<?php

//Controladores que voy a usar
use Eichenberger\Instagram\controllers\Signup;
use Eichenberger\Instagram\controllers\Login;
use Eichenberger\Instagram\controllers\Home;
use Eichenberger\Instagram\controllers\Actions;
use Eichenberger\Instagram\controllers\Profile;

$router = new \Bramus\Router\Router();
session_start();


//Permitiendo a Dotenv que sobrescriba las variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../config');
$dotenv->load();

//Middlewares para saber si un usuario está autenticado o no
function notAuth() {
    if (!isset($_SESSION['user'])) {
        header('location: /instagram/login');
        exit;
    }
}

function auth() {
    if (isset($_SESSION['user'])) {
        header('location: /instagram/home');
        exit;
    }
}

//Rutas por get y por post
$router->get('/', function () {
    echo "Inicio";
});

$router->get('/login', function () {
    auth();
    $controller = new Login;
    $controller->render('login/index');
});

$router->post('/auth', function () {
    auth();
    $controller = new Login;
    $controller->auth();
});

$router->get('/signup', function () {
    auth();
    $controller = new Signup;
    $controller->render('signup/index');
});

$router->post('/register', function () {
    auth();
    $controller = new Signup;
    $controller->register();
});

$router->get('/home', function () {
    notAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->index();
});

$router->post('/publish', function () {
    notAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Home($user);
    $controller->store();
});

$router->get('/profile', function () {
    notAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Profile(); 
    $controller->getUserProfile($user);
});

$router->post('/addLike', function () {
    notAuth();
    $user = unserialize($_SESSION['user']);
    $controller = new Actions($user);
    $controller->like();
});

$router->get('/signout', function () {
    notAuth();
    unset($_SESSION['user']);
    header('location: /instagram/login');
});

$router->get('/profile/{username}', function ($username) {
    notAuth();
    $controller = new Profile(); 
    $controller->getUsernameProfile($username);
});

$router->run();
