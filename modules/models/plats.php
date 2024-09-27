<?php

namespace Blog\Models;

use Database;

/**
 * Modèle de la page dédié aux plats
 */
class Plats {

    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getPlats(): ?array{
        $db = $this->db;
        $query = 'SELECT * FROM plat';
        $stmt = $db->getConn()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetch($db->getConn()::FETCH_ASSOC);

        return $result;
    }

    public function getIngredients(): ?array{
        $db = $this->db;
        $query = 'SELECT * FROM ';
    }

    public function removePlat(string $nom_plat): void {
        $db = $this->db;
        $query = 'DELETE FROM plat WHERE nom_plat = :nom_plat';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->execute();
    }

    public function updatePlat(string $nom_plat,): void {
        $db = $this->db;
        $query = 'UPDATE plat SET nom_plat = :nom_plat';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->execute();
    }

    public function addPlat(string $nom_plat): void{
        $db = $this->db;
        $query = 'INSERT INTO plat VALUES (:nom_plat)';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->execute();
    }

}