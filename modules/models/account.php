<?php
namespace Blog\Models;

use Database;

/**
 * Modèle de la page dédié aux informations du compte courant
 */
class Account {

    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    /**
     * On renvoie tout les informations d'un utilisateur stockées dans la BD
     * @return void
     */
    public function returnAll(string $id_tenrac) {
        $db = $this->db;
        $query = 'SELECT * FROM membre WHERE id_tenrac = :id_tenrac';
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
