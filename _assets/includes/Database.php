<?php
/**
 * Classe s'occupant de la connexion à la base de données
 */
class Database {
    private string $host = "mysql-tenrac.alwaysdata.net";
    private string $user = "tenrac_db";
    private string $pass = "JdozlVeieo628hK";
    private string $dbname = "tenrac_db";
    private PDO $conn;

    /**
     * Constructeur de la classe Database
     * Lors de la construction de l'objet Database, une tentative de connexion est faite vers la bd
     */
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie";
        } catch (PDOException $e) {
            echo "Erreur de connexion: " . $e->getMessage();
        }
    }

    public function getConn(): PDO {
        return $this->conn;
    }
}
?>