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

    public function addOrdre($nom, $adresse) {
        $db = $this->db;
        $query = 'INSERT INTO club (nom, adresse)';
        $stmt = $db->getConn()->prepare($query);
        $stmt->execute();
    }

    public function deleteOrdre($nom) {
        $db = $this->db;
        $query = 'DELETE FROM club WHERE nom = :nom_';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
    }

}