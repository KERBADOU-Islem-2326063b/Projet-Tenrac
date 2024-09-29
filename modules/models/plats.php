<?php

namespace Blog\Models;

use Database;
use PDOException;

/**
 * Modèle de la page dédié aux plats
 */
class Plats {

    private Database $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    /**
     * Récupère les plats en fonction de la page demandée
     * @param int $page numéro de la page souhaitée
     * @return bool|array l'array de tous les plats, false si erreur ou aucune donnée
     */
    public function getPlats(int $page): bool|array{
        $nbTotPlats = $this->getPlatsCount();
        $parPage = 4;
        $nbPages = ceil($nbTotPlats / $parPage);

        $db = $this->db->getConn();
        $stmt = 'SELECT * FROM plat LIMIT'. $parPage * ($page - 1) . ',' . $parPage * $page;

        return $db->query($stmt)->fetchAll();
    }

    /**
     * Récupère les ingrédients en fonction du plat demandé
     * @param string $nom_plat
     * @return array|null
     */
    public function getIngredients(string $nom_plat): ?array{
        $db = $this->db;
        $query = 'SELECT * FROM compose_plats WHERE nom_plat = :nom_plat';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->execute();

        $result = $stmt->fetch($db->getConn()::FETCH_ASSOC);

        return $result;
    }

    /**
     * Supprime un plat de la base de données en fonction de son nom
     * @param string $nom_plat le nom du plat
     * @return true|string true si réussi, un string sinon
     */
    public function removePlat(string $nom_plat): true|string {
        $db = $this->db->getConn();
        $query = 'DELETE FROM plat WHERE nom_plat = :nom_plat';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);

        try {
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }

    }

    /**
     * Supprime un aliment en fonction de son nom et le nom du plat
     * @param string $nom_plat le nom du plat
     * @param string $nom_aliment le nom de l'aliment
     * @return true|string true si réussi, un string sinon
     */
    public function removeIngredient(string $nom_plat, string $nom_aliment): true|string {
        $db = $this->db->getConn();
        $query = 'DELETE FROM compose_plat WHERE nom_aliment :nom_aliment AND nom_plat = :nom_plat';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->bindParam(':nom_aliment', $nom_aliment);

        try {
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Renvoie le nombre total de plats dans la base de données
     * @return int
     */
    public function getPlatsCount():int {
        $db = $this->db->getConn();
        $stmt = 'SELECT COUNT(*) AS nb_plats FROM plat';
        $query = $db->prepare($stmt);
        $query->execute();
        $result = $query->fetch();

        return (int) $result['nb_plats'];
    }

    /**
     * Renvoie le nombre de pages maximales, 5 éléments par page
     * @return int
     */
    public function getMaxPages(): int {
        $nbTotPlats = $this->getPlatsCount();
        $parPage = 4;

        return ceil ($nbTotPlats / $parPage);
    }

    /**
     * Fait la mise à jour d'un plat en fonction de son nom
     * @param string $nom_plat le nom du plat
     * @return bool|string true si réussi, un string sinon
     */
    public function updatePlat(string $nom_plat): bool|string {
        $db = $this->db->getConn();
        $query = 'UPDATE plat SET nom_plat = :nom_plat';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Failt la mise à jour d'un ingredient en fonction d'un nom de plat
     * @param string $nom_plat
     * @param string $nom_aliment
     * @return bool|string
     */
    public function updateIngredients(string $nom_plat, string $nom_aliment): bool|string {
        $db = $this->db->getConn();
        $query = 'UPDATE compose_plat SET nom_aliment = :nom_aliment WHERE nom_plat = :nom_plat';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->bindParam(':nom_aliment', $nom_aliment);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Ajoute un nouveau plat à la base de données en fonction de son nom
     * @param string $nom_plat le nom du plat
     * @return bool|string true si réussi, string sinon
     */
    public function addPlat(string $nom_plat): bool|string {
        $db = $this->db->getConn();
        $query = 'INSERT INTO plat VALUES (:nom_plat)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Ajoute un ingrédient à la base de données en fonction de son nom et le nom du plat
     * @param string $nom_plat le nom du plat
     * @param string $nom_aliment le nom de l'aliment
     * @return bool|string string si réussi, string sinon
     */
    public function addIngredients(string $nom_plat, string $nom_aliment): bool|string {
        $db = $this->db->getConn();
        $query = 'INSERT INTO compose_plat VALUES (:nom_aliment) WHERE nom_plat = :nom_plat';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->bindParam(':nom_aliment', $nom_aliment);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}