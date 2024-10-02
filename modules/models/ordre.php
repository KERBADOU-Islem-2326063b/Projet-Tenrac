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
     * @param int $limit nombre de club affiché sur la page
     * @param int $offset permet de prendre les n(limit) clubs suivant
     * @return array
     */
    public function returnAll($limit, $offset) {
        $db = $this->db;
        $query = 'SELECT * FROM club LIMIT :limit OFFSET :offset';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT );
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll($db->getConn()::FETCH_ASSOC);

        if ($result) {
            return $result;
        }

        return [];
    }

    /**
     * Compte le nombre total de club
     * @return int
     */
    public function countAll(): int {
        $db = $this->db;
        $query = 'SELECT COUNT(*) as total FROM club';
        $stmt = $db->getConn()->prepare($query);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Ajoute un club à la base de données.
     * @param string $nom nom du club
     * @param string $adresse adresse du club
     * @return void
     */
    public function addOrdre(string $nom, string $adresse): void {
        $db = $this->db;
        $query = 'INSERT INTO club (Nom_club, adresse_postale) VALUES (UCASE(:nom), UCASE(:adresse))';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':adresse', $adresse);
        try {
            $stmt->execute();
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new \Exception("Le club '$nom' existe déjà.");
            } else {
                throw $e;
            }
        }
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
    public function updateOrdre($oldNom, $adresse): void{
        $db = $this->db;
        $query = 'UPDATE club SET adresse_postale = UCASE(:adresse) WHERE Nom_club = :oldNom';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':oldNom', $oldNom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->execute();
    }
}