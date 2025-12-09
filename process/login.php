<?php
session_start();
require_once("../config/database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        die("Veuillez remplir tous les champs");
    }

    try {
        $conn = getConnection();
        $query = "SELECT * FROM utilisateurs WHERE email = :email AND password = :password";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // ATTENTION: mot de passe en clair
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Stockez TOUTES les colonnes dans la session
            // Méthode 1 : Toutes les colonnes comme variables séparées
            foreach ($user as $key => $value) {
                $_SESSION[$key] = $value;
            }

            // Méthode 2 : ET stockez aussi dans un tableau user (recommandé)
            $_SESSION['user'] = $user;

            // Stockez aussi les données fréquemment utilisées
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'] ?? '';
            $_SESSION['email'] = $user['email'];
            $_SESSION['adresse'] = $user['adresse'];
            $_SESSION['tel'] = $user['tel'];
            $_SESSION['etablissement'] = $user['etablissement'] ?? '';
            header('Location: ../index.php');
            exit();
        }
        else
        {
//            error_log("Identifiant ou mot de passe incorrect");
            header('Location: ../page/login.php?error=Identifiants incorrects');
            exit();
        }

    } catch(PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
}