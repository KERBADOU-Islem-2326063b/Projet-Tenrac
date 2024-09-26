<?php
/**
 * Classe s'occupant de la connexion à la base de données
 */
class Database {
    private string $host = "mysql-thomasthomastrantran.alwaysdata.net";
    private string $user = "377661";
    private string $pass = "D9d2eaa8b7c!";
    private string $dbname = "thomasthomastrantran_db";
    private PDO $conn;
    /**
     * Constructeur de la classe Database
     * Lors de la construction de l'objet Database, une tentative de connexion est faite vers la bd
     */
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion: " . $e->getMessage();
        }
    }

    public function getConn(): PDO {
        return $this->conn;
    }
}
?>