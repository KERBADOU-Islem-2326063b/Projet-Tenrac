<?php

namespace Blog\Models;
use Database;

/**
 * Model de la page de l'ordre des Tenrac
 */

class Ordre
{
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    /**
     * Récupère les clubs en fonction du numéro de la page demandé,
     * @param int $page numéro de la page souhaité
     * @return array
     */
    public function returnAll() {
        $db = $this->db;
        $query = 'SELECT * FROM club';
        $stmt = $db->getConn()->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll($db->getConn()::FETCH_ASSOC);

        if ($result) {
            return $result;
        }

        return null;
    }

    /**
     * Ajoute un club à la base de données.
     * @param string $nom nom du club
     * @param string $adresse adresse du club
     * @return void
     */
    public function addOrdre(string $nom, string $adresse): void {
        $db = $this->db;
        $query = 'INSERT INTO club (Nom_club, adresse_postale) VALUES (:nom, :adresse)';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->execute();
    }


    /**
     * Supprime un club de la base de données.
     * @param string $nom nom du club
     * @return void
     */
    public function deleteOrdre($nom): void {
        $db = $this->db;
        $query = 'DELETE FROM club WHERE Nom_club = :nom';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();
    }


    /**
     * Modifie un club de la base de données.
     * @param string $oldNom nom du club avant la modification
     * @param string $newNom nom du club après la modification
     * @param string $adresse adresse du club
     * @return void
     */
    public function updateOrdre($oldNom, $newNom, $adresse): void{
        $db = $this->db;
        $query = 'UPDATE club SET Nom_club = :newNom, adresse_postale = :adresse WHERE Nom_club = :oldNom';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':newNom', $newNom);
        $stmt->bindParam(':oldNom', $oldNom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->execute();
    }
}