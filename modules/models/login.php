<?php
namespace Blog\Models;

use Database;

/**
 * Modèle de la page dédié à la connexion
 */
class Login {

    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function doLogsExist(string $id_tenrac, string $passwordLogs): bool {
        if (empty($id_tenrac) || empty($passwordLogs)) {
            return false;
        }

        $db = $this->db;
        $query = 'SELECT mdp_tenrac FROM membre WHERE id_tenrac = :id_tenrac';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':id_tenrac', $id_tenrac);
        $stmt->execute();

        $result = $stmt->fetch($db->getConn()::FETCH_ASSOC);

        if ($result && isset($result['mdp_tenrac'])) {
            echo $result['mdp_tenrac'];
            if (password_verify($passwordLogs, $result['mdp_tenrac'])) {
                return true;
            };
        }

        return false;
    }

    public function returnAll(string $id_tenrac) {
        $db = $this->db;
        $query = 'SELECT * FROM users WHERE id_tenrac = :id_tenrac';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':$id_tenrac', $id_tenrac, $db->getConn()::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch($db->getConn()::FETCH_ASSOC);

        if ($result) {
            return $result;
        }

        return null;
    }
}
?>
