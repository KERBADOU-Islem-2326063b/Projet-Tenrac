<?php
namespace Blog\Models;

use Database;

class Account {

    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function returnAll(string $id_tenrac) {
        $db = $this->db;
        $query = 'SELECT * FROM users WHERE id_tenrac = :id_tenrac';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':id_tenrac', $id_tenrac);
        $stmt->execute();

        $result = $stmt->fetch($db->getConn()::FETCH_ASSOC);

        if ($result) {
            return $result;
        }

        return null;
    }
}
?>
