<?php

namespace Eichenberger\Instagram\lib;

class Model {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    //Para poder hacer una consulta
    public function query($query) {
        $this->db->connect()->query($query);
    }

    public function prepare($query) {
        $this->db->connect()->prepare($query);
    }
}