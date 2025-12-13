<?php
ob_start();
session_start();

// Inclure la configuration de la base de données
require_once("config/database.php");

// Déterminer la page demandée
$p = $_GET['page'] ?? 'page/accueil.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Si connecté, afficher le header
    include_once("page/inc/header.php");
    include_once("page/inc/nav.php");
    $users = allUsers();
    // Router vers la page appropriée
    switch($p) {
        case 'accueil':
            include_once("page/accueil.php");
            break;
        case 'cours':
            include_once("page/cours/cours.php");
            break;
        case 'progression':
            include_once("page/progression/progression.php");
            break;
        case 'profil':
            include_once("page/profil/profil.php");
            break;
        case 'admin':
            include_once("page/admin/admin.php");
            break;
        case 'parametre':
            include_once("page/parametre/parametre.php");
            break;
        case 'deconnexion':
            // Gérer la déconnexion
            session_destroy();
            header("Location: index.php");
            exit();
            break;

        default:
            // Page par défaut (accueil)
            include_once("page/accueil.php");
            break;
    }

    // Afficher le footer
    include_once("page/inc/footer.php");
} else {
    // Si NON connecté, afficher la page de connexion
    include_once("page/login.php");
}
ob_end_flush();