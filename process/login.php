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
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            header('Location: ../index.php');
            exit();
        }
        else{
            header('Location: ../page/login.php?error=Identifiants incorrects');
            exit();
        }

    } catch(PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
}
