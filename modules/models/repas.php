<?php

namespace Blog\Models;

use Database;
use PDOException;

/**
 * Modèle de la page dédié aux repas
 */
class Repas {

    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    /**
     * Récupère les repas en fonction de la page demandée
     * @param int $page numéro de la page souhaitée
     * @return bool|array l'array de tous les repas, false si erreur ou aucune donnée
     */
    public function getRepas(int $page): bool|array{
        $nbTotRepas = $this->getRepasCount();
        $parPage = 5;
        $nbPages = ceil($nbTotRepas / $parPage);

        $db = $this->db->getConn();
        $stmt = 'SELECT * FROM repas LIMIT '. $parPage * ($page - 1) . ',' . $parPage * $page;

        return $db->query($stmt)->fetchAll();
    }

    /**
     * Renvoie les plats qu'il y a dans un repas donné
     * @param string $date_repas la date du repas
     * @param string $adresse l'adresse du repas
     * @return bool|array l'array de tous les plats du repas, false si erreur ou aucune donnée
     */
    public function getPlats(string $date_repas, string $adresse): bool|array{
        $db = $this->db->getConn();
        $stmt = "SELECT date_repas, adresse_postale, nom_plat
                FROM compose_repas
                WHERE date_repas = '" . $date_repas . "'
                AND adresse_postale = '" . $adresse . "'";

        return $db->query($stmt)->fetchAll();
    }

    /**
     * Supprime un repas de la base de données en fonction de son nom
     * @param string $date_repas la date du repas
     * @param string $adresse l'adresse du repas
     * @return true|string true si réussi, un string sinon
     */
    public function removeRepas(string $date_repas, string $adresse): true|string {
        $db = $this->db->getConn();
        $query = 'DELETE FROM repas WHERE date_repas = :date_repas AND adresse_postale = :adresse';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':date_repas', $date_repas);
        $stmt->bindParam(':adresse', $adresse);

        try {
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }

    }

    /**
     * Renvoie le nombre total de repas dans la base de données
     * @return int
     */
    public function getRepasCount():int {
        $db = $this->db->getConn();
        $stmt = 'SELECT COUNT(*) AS nb_repas FROM repas';
        $query = $db->prepare($stmt);
        $query->execute();
        $result = $query->fetch();

        return (int) $result['nb_repas'];
    }

    /**
     * Renvoie le nombre de pages maximales, 5 éléments par page
     * @return int
     */
    public function getMaxPages(): int {
        $nbTotRepas = $this->getRepasCount();
        $parPage = 5;

        return ceil ($nbTotRepas / $parPage);
    }

    /**
     * Fait la mise à jour d'un repas en fonction de son nom
     * @param string $nom_plat le nom du plat
     * @param string $date_repas la date du repas
     * @param string $adresse l'adresse du repas
     * @return bool|string true si réussi, un string sinon
     */
    public function updateRepas(string $nom_plat, string $date_repas, string $adresse): bool|string {
        $db = $this->db->getConn();
        $query = 'UPDATE compose_repas SET nom_plat = :nom_plat WHERE date_repas = :date_repas AND adresse_postale = :adresse_postale';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->bindParam(':date_repas', $date_repas);
        $stmt->bindParam(':adresse', $adresse);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Ajoute un nouveau repas à la base de données en fonction de son nom
     * @param string $date_repas la date du repas
     * @param string $adresse l'adresse du repas
     * @return bool|string true si réussi, string sinon
     */
    public function addRepas(string $date_repas, string $adresse): bool|string {
        $db = $this->db->getConn();
        $query = 'INSERT INTO repas(date_repas, adresse_postale) VALUES (:date_repas, :adresse)';
        $stmt1 = $db->prepare($query);
        $stmt1->bindParam(':date_repas', $date_repas);
        $stmt1->bindParam(':adresse', $adresse);

        $query = 'INSERT INTO compose_repas(date_repas, adresse_postale) VALUES (:date_repas, :adresse)';
        $stmt2 = $db->prepare($query);
        $stmt2->bindParam(':date_repas', $date_repas);
        $stmt2->bindParam(':adresse', $adresse);

        try {
            $stmt1->execute();
            $stmt2->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Ajoute un plat à la base de données en fonction de son nom, de la date et de l'adresse du repas
     * @param string $nom_plat le nom du plat
     * @param string $date_repas la date du repas
     * @param string $adresse l'adresse du repas
     * @return bool|string string si réussi, string sinon
     */
    public function addPlat(string $nom_plat, string $date_repas, string $adresse): bool|string {
        $db = $this->db->getConn();
        $query = 'INSERT INTO compose_repas(nom_plat) VALUES (:nom_plat) WHERE date_repas = :date_repas AND adresse_postale = :adresse';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->bindParam(':date_repas', $date_repas);
        $stmt->bindParam(':adresse', $adresse);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}