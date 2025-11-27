<?php

require_once "model/model.php";

$facture = new Facture();
$data = $facture->getAllFactures();

// Retourner en JSON pour DataTables
echo json_encode(["data" => $data]);


