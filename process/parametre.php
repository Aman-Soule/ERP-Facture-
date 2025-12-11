<?php
session_start();
require_once("../config/database.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour modifier votre profil.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $adresse = $_POST['adresse'] ?? '';
    $etablissement = $_POST['etablissement'] ?? '';
    $user_id = $_SESSION['user_id'];

    // Validation simple
    if (empty($nom) || empty($email)) {
        die("Le nom et l'email sont requis.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("L'email n'est pas valide.");
    }

    try {
        $conn = getConnection();

        // Vérifier si l'email existe déjà pour un autre utilisateur
        $check_query = "SELECT id FROM utilisateurs WHERE email = :email AND id != :user_id";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bindParam(':email', $email);
        $check_stmt->bindParam(':user_id', $user_id);
        $check_stmt->execute();

        if ($check_stmt->rowCount() > 0) {
            die("Cet email est déjà utilisé par un autre utilisateur.");
        }

        // Mettre à jour le profil
        $update_query = "UPDATE utilisateurs SET 
                         nom = :nom, 
                         email = :email, 
                         tel = :telephone, 
                         adresse = :adresse, 
                         etablissement = :etablissement 
                         WHERE id = :user_id";

        $stmt = $conn->prepare($update_query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':etablissement', $etablissement);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            // IMPORTANT : Récupérer TOUTES les données mises à jour depuis la base
            $select_query = "SELECT * FROM utilisateurs WHERE id = :user_id";
            $select_stmt = $conn->prepare($select_query);
            $select_stmt->bindParam(':user_id', $user_id);
            $select_stmt->execute();
            $updated_user = $select_stmt->fetch(PDO::FETCH_ASSOC);
            if($updated_user) {
                // Mettre à jour les données dans la session
                $_SESSION['nom'] = $nom;
                $_SESSION['email'] = $email;
                $_SESSION['tel'] = $telephone;
                $_SESSION['adresse'] = $adresse;
                $_SESSION['etablissement'] = $etablissement;

                // Mettre à jour le tableau user complet
                $_SESSION['user'] = $updated_user;
            }

            // Rediriger vers la page profil avec un message de succès
            header('Location: ../page/parametre/parametre.php');
            exit();
        } else {
            die("Erreur lors de la mise à jour du profil.");
        }

    } catch(PDOException $e) {
        die("Erreur: " . $e->getMessage());
    }
} else {
    // Si quelqu'un accède directement à cette page sans formulaire
    header('Location: ../page/profil/profil.php');
    exit();
}