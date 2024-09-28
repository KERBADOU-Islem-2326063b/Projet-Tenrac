<?php

namespace Blog\Models;

use Database;
use PDOException;

/**
 * Modèle destiné à effectuer les requêtes sur les table de membres
 */
class Members {
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    /**
     * Récupère les membres tenrac en fonction du numéro de la page demandé,
     * @param int $page numéro de la page souhaité
     * @return bool|array l'array de tous les membres, false si erreur ou aucune donnée
     */
    public function getMembers(int $page): bool|array
    {
        $nbTotalMembres = $this->getMembersCount();
        $parPage = 5;
        $nbPages = ceil($nbTotalMembres / $parPage);

        $db = $this->db->getConn();
        $stmt = "SELECT * FROM membre LIMIT " . $parPage * ($page - 1) . "," . $parPage * $page;

        return $db->query($stmt)->fetchAll();
    }

    /**
     * Supprime un membre de la base de données en fonction de son id de tenrac.
     * @param string $id son id de tenrac
     * @return true|string true si réussi, un string sinon
     */
    public function deleteMember(string $id): true|string {
        $db = $this->db->getConn();
        $query = "DELETE FROM membre WHERE id_tenrac = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Renvoie le nombre total de membres dans la base de données.
     * @return int
     */
    public function getMembersCount(): int {
        $db = $this->db->getConn();
        $stmt = "SELECT COUNT(*) AS nb_membres FROM membre";
        $query = $db->prepare($stmt);
        $query->execute();
        $result = $query->fetch();

        return (int) $result['nb_membres'];

    }

    /**
     * Renvoie le nombre de pages maximales, 5 éléments par page
     * @return int
     */
    public function getMaxPages(): int {
        $nbTotalMembres = $this->getMembersCount();
        $parPage = 5;
        return ceil($nbTotalMembres / $parPage);
    }

    /**
     * Ajoute un nouveau membre tenrac à la base de données,
     * avec les nombreux paramètres que ce
     * gourou de prof nous demande.
     * @param $id_tenrac
     * @param $mdp_tenrac
     * @param $nom
     * @param $courriel
     * @param $adresse_postale
     * @param $num_tel
     * @param $grade
     * @param $rang
     * @param $titre
     * @param $dignite
     * @return bool|string true si réussi, string sinon
     */
    public function addNewMember($id_tenrac, $mdp_tenrac, $nom, $courriel, $adresse_postale,
        $num_tel, $grade, $rang, $titre, $dignite): bool|string
    {
        $db = $this->db->getConn();
        $query = "INSERT INTO membre (id_tenrac, mdp_tenrac, nom_, courriel, adresse_postale, num_tel, rang, grade, titre, dignite)
              VALUES (:id_tenrac, :mdp_tenrac, :nom, :courriel, :adresse_postale, :num_tel, :rang, :grade, :titre, :dignite)";
        $stmt = $db->prepare($query);

        $stmt->bindParam(':id_tenrac', $id_tenrac);
        $stmt->bindParam(':mdp_tenrac', $mdp_tenrac);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':courriel', $courriel);
        $stmt->bindParam(':adresse_postale', $adresse_postale);
        $stmt->bindParam(':num_tel', $num_tel);
        $stmt->bindParam(':rang', $rang);
        $stmt->bindParam(':grade', $grade);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':dignite', $dignite);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function addNewMemberFromPost(): bool|string
    {
        $id_tenrac = strtoupper($_POST["id"]);
        $mdp_tenrac = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $nom = strtoupper($_POST["nom"]);
        $courriel = $_POST["courriel"];
        $adresse_postale = strtoupper($_POST["adresse_postale"]);
        $num_tel = $_POST["num_tel"];
        $grade = $_POST["grade"];
        $rang = $_POST["rang"];
        $titre = $_POST["titreTenrac"];
        $dignite = $_POST["dignite"];

        return $this->addNewMember($id_tenrac, $mdp_tenrac, $nom, $courriel, $adresse_postale, $num_tel, $grade, $rang, $titre, $dignite);
    }
}