<?php

namespace Blog\Models;

use Database;
use PDOException;

/**
 * Modèle destiné à effectuer les requêtes sur les table de membres
 */
class Members {
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getMembers(int $page): bool|array
    {
        $nbTotalMembres = $this->getMembersCount();
        $parPage = 5;
        $nbPages = ceil($nbTotalMembres / $parPage);

        $db = $this->db->getConn();
        $stmt = "SELECT * FROM membre LIMIT " . $parPage * ($page - 1) . "," . $parPage * $page;

        return $db->query($stmt)->fetchAll();
    }

    public function deleteMember(string $id): true|string {
        $db = $this->db->getConn();
        $query = "DELETE FROM membre WHERE id_tenrac = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getMembersCount(): int {
        $db = $this->db->getConn();
        $stmt = "SELECT COUNT(*) AS nb_membres FROM membre";
        $query = $db->prepare($stmt);
        $query->execute();
        $result = $query->fetch();

        return (int) $result['nb_membres'];

    }

    public function getMaxPages(): int {
        $nbTotalMembres = $this->getMembersCount();
        $parPage = 5;
        return ceil($nbTotalMembres / $parPage);
    }
}