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

    /**
     * On vérifie si l'utilisateur existe dans le BS, si oui return vrai(true) sinon faux(false)
     * @param string $id_tenrac
     * @param string $passwordLogs
     * @return bool
     */
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
            }
        }
        return false;
    }
}
?>
