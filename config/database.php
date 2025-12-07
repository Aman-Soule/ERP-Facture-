<?php
function getConnection() {
    $host = "dpg-d4qmetqdbo4c73bug47g-a.oregon-postgres.render.com";
    $dbname = "mini_erp_db_cb04";
    $user = "mini_erp_db_cb04_user";
    $password = "5A3zRTr4DfzQ4LZtgYl2PhinRmtzvbSl";

    try {
        $dsn = "pgsql:host=$host;port=5432;dbname=$dbname;sslmode=require";
        $conn = new PDO($dsn, $user, $password);
        return $conn;
    } catch(PDOException $e) {
        die("Erreur connexion: " . $e->getMessage());
    }
}

function allUsers(): array
{
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM utilisateurs");
    $stmt->execute();
    $users = $stmt->fetchAll();
    return $users;
}
?>

