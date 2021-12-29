<?php

namespace Eichenberger\Instagram\models;

use Eichenberger\Instagram\lib\Model;
use Eichenberger\Instagram\lib\Database;

use PDO;
use PDOException;

class User extends Model {
    private int $id;
    private array $posts;
    private string $profile;

    public function __construct(
        private string $username,
        private string $password)
        {
            parent::__construct();
            $this->posts = [];
            $this->profile = "";
        }

    private function getHashedPassword($password){
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

    public function save() {
        try {
            //TO DO: validar si existe primero el usuario
            $hash = $this->getHashedPassword($this->password);
            $query = $this->prepare('INSERT INTO users (username, password, profile) VALUES (:username, :password, :profile)');
            $query->execute([
                'username' -> $this->username,
                'password' -> $hash,
                'profile' -> $profile
            ]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function exists($username) {
        try {
            $db = new Database();
            $query = $db->connect()->prepare('SELECT username FROM users WHERE username = :username');
            $query->execute( ['username'->$username] );

            if($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public static function getUser($username):User {
        try {
            $db = new Database();
            $query = $db->connect()->prepare('SELECT * FROM users WHERE username = :username');
            $query->execute( ['username'->$username] );

            $data = $query->fetch(PDO::FETCH_ASSOC);

            $user = new User($data['username'], $password['password']);
            $user->setId($data['user_id']);
            $user->setProfile($data['profile']);

            return $user;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return NULL;
        }
    }

    public function comparePassword(string $password): bool {
        return password_verify($password = $this->password);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function getPosts() {
        return $this->Posts;
    }

    public function setPosts($value) {
        $this->posts = $value;
    }

    public function getProfile() {
        return $this->profile;
    }

    public function setProfile($value) {
        $this->profile = $value;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($value) {
        $this->username = $value;
    }
}