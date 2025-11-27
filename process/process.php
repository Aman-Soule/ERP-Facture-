<?php
//creation des factures
    require_once("../model/model.php");
    $db = new Facture();
    if(isset($_POST["action"]) && $_POST["action"] === 'create'){
        extract($_POST);
        $returned = (int)$received - (int)$amount;
        $db->createFacture($customer, $cashier, (int)$amount, (int)$received, $returned, $status);
        echo "perfect";
    }
