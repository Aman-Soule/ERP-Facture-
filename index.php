<?php
session_start();

// Inclure la configuration de la base de données
require_once ("config/database.php");

//$liste = allUsers();
//var_dump($liste);
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Si connecté, afficher l'accueil
    include_once("page/inc/header.php");
    include_once("page/inc/nav.php");
    include_once("page/accueil.php");
    include_once("page/inc/footer.php");
} else {
    // Si NON connecté, afficher la page de connexion
    include_once("page/login.php");
}

?>
