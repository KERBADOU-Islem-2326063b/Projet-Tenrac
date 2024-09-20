<?php
namespace Blog\Models;


use Database;

class Login {

    private Database $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function doLogsExist() {
        // TODO
    }
}

