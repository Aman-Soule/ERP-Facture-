<?php

class Database
{
    private $host = "localhost";      // ou 127.0.0.1
    private $port = "5432";           // port par défaut PostgreSQL
    private $dbname = "crud_ajax";  // nom de ta base
    private $user = "postgres";       // utilisateur PostgreSQL
    private $password = "tarte07?"; // mot de passe
    private $pdo;                     // objet PDO

    // Constructeur : initialise la connexion
    public function __construct()
    {
        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";
            $this->pdo = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // gestion des erreurs
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetch par défaut
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Méthode pour récupérer l’objet PDO
    public function getConnection()
    {
        return $this->pdo;
    }
}


//Classe facture
class Facture {
    private $conn;
    private $pdo;

    
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Fonction SELECT
    public function getAllFactures() {
        $sql = "SELECT id, customer,cashier, amount,received, returned, date_facture, status FROM factures ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    // ✅ Méthode pour compter les factures
    public function countBills() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM factures");
        return $stmt->fetchColumn();
    }

    // ✅ Méthode pour lire toutes les factures
    public function read() {
        $stmt = $this->pdo->query("SELECT * FROM factures");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    
    //Fonction de création d'une facture
    public function createFacture($customer, $cashier, $amount, $received, $returned, $status) {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO factures (customer, cashier, amount, received, returned, status) 
            VALUES (:customer, :cashier, :amount, :received, :returned,  :status)";

        // Préparer la requête avec PDO
        $stmt = $this->conn->prepare($sql);

        // Binder les paramètres
        $stmt->bindParam(':customer', $customer);
        $stmt->bindParam(':cashier', $cashier);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':received', $received);
        $stmt->bindParam(':returned', $returned);

        $stmt->bindParam(':status', $status);

        // Exécuter et retourner le résultat
        return $stmt->execute();
    }
    public function deleteFacture($id) {
        // Préparer la requête de suppression
        $sql = "DELETE FROM factures WHERE id = :id";

        // Préparer avec PDO
        $stmt = $this->conn->prepare($sql);

        // Binder le paramètre
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Exécuter et retourner le résultat
        return $stmt->execute();
    }



}
