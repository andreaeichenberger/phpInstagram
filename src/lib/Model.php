<?php

namespace Eichenberger\Instagram\lib;

use Eichenberger\Instagram\lib\Database;

class Model {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    //Para poder hacer una consulta
    public function query($query) {
        return $this->db->connect()->query($query);
    }

    public function prepare($query) {
        return $this->db->connect()->prepare($query);
    }
}