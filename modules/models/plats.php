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
        $parPage = 4;
        $offset = ($page-1)*$parPage;
        $db = $this->db->getConn();
        $stmt = "SELECT * FROM plat LIMIT $offset, $parPage";


        return $db->query($stmt)->fetchAll();
    }

    /**
     * Récupère les ingrédients en fonction du plat demandé
     * @param string $nom_plat
     * @return array|null
     */
    public function getIngredients(string $nom_plat): ?array{
        $db = $this->db;
        $query = 'SELECT * FROM compose_plat WHERE nom_plat = :nom_plat';
        $stmt = $db->getConn()->prepare($query);
        $stmt->bindParam(':nom_plat', $nom_plat);
        $stmt->execute();

        $result = $stmt->fetchAll($db->getConn()::FETCH_ASSOC);

        return $result ?:[];
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
     * Retire le lien d'un plat et de ses aliments en fonction du nom du plat
     * @param string $nom_plat le nom du plat
     * @return true|string true si réussi, un string sinon
     */
    public function removeComposePlat(string $nom_plat, string $nom_aliment): true|string {
        $db = $this->db->getConn();
        $query = 'DELETE FROM compose_plat WHERE nom_plat = :nom_plat AND nom_aliment = :nom_aliment';
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
     * Failt la mise à jour d'un ingredient en fonction d'un nom de plat
     * @param string $nom_plat nom du plat concerné
     * @param string $old_nom_aliment ancien aliment à modifier
     * @param string $new_nom_aliment nouvel aliment
     * @return bool|string
     */
    public function updateIngredients(string $nom_plat, string $old_nom_aliment, string $new_nom_aliment): bool|string {

        $error = $this->removeComposePlat($nom_plat, $old_nom_aliment);

        if($error !== true) {
            return $error;
        }

        $error = $this->linkPlatAliment($nom_plat, $new_nom_aliment);

        if($error !== true) {
            return $error;
        } else {
            return true;
        }

    }

    /**
     * Ajoute un nouveau plat à la base de données en fonction de son nom
     * @param string $nom_plat le nom du plat
     * @return bool|string true si réussi, string sinon
     */
    public function addPlat(string $nom_plat): bool|string {
        $nom_plat = strtoupper($nom_plat);

        $db = $this->db->getConn();
        $query = 'INSERT INTO plat (nom_plat) VALUES (:nom_plat)';
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
    public function linkPlatAliment(string $nom_plat, string $nom_aliment): bool|string {
        $nom_plat = strtoupper($nom_plat);
        $nom_aliment = strtoupper($nom_aliment);
        $nom_aliment = trim(preg_replace('/\s+/',' ', $nom_aliment));

        $db = $this->db->getConn();
        $query = 'INSERT INTO compose_plat (nom_plat,nom_aliment) VALUES (:nom_plat, :nom_aliment)';
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
     * Ajoute un aliment à la bd
     * @param string $nom_aliment aliment à ajouter
     * @return bool|string true si réussi, string sinon
     */
    public function addAliment(string $nom_aliment): bool|string {
        $nom_aliment = strtoupper($nom_aliment);

        $db = $this->db->getConn();
        $query = 'INSERT INTO aliment (nom_aliment) VALUES (:nom_aliment)';
        $stmt = $db->prepare($query);

        $stmt->bindParam(':nom_aliment', $nom_aliment);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Vérifie si le membre est allergique à un aliment en particulier
     * @param string $nom_aliment le nom de l'aliment
     * @return bool string si réussi, string sinon
     */
    public function isAllergic(string $nom_aliment): bool {
        $db = $this->db->getConn();
        $query = 'SELECT nom_aliment FROM est_allergique WHERE id_tenrac = :id_tenrac AND nom_aliment = :nom_aliment';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_tenrac', $_SESSION['id_tenrac']);
        $stmt->bindParam(':nom_aliment', $nom_aliment);

        try {
            $stmt->execute();
            return $stmt->fetchColumn() !== false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

}