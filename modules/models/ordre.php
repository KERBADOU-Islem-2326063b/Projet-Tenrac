<?php

namespace Blog\Models;
use Database;

class Ordre
{
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function returnAll() {
        $db = $this->db;
        $query = 'SELECT * FROM club';
        $stmt = $db->getConn()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll($db->getConn()::FETCH_DEFAULT);

        if ($result) {
            return $result;
        }

        return null;
    }
}