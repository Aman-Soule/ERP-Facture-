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
    //Supression d'une facture
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $id = $_POST['id'];

        if ($facture->deleteFacture($id)) {
            echo "success";
        } else {
            echo "error";
        }
    }

    //Exportation
    if (isset($_GET['action']) && $_GET['action'] === 'export') {

        $exceFileName = "factures".date("YmdHis").".xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$exceFileName");

        $columnName = ['id', 'Client', 'Caissier', 'Montant', 'Percu', 'Retourné', 'Etat'];

        $data = implode("\t",array_values($columnName)). "\n";

        // Connexion directe à la base (si tu n’as pas encore d’objet $db)
        $pdo = new PDO("pgsql:host=localhost;dbname=crud_ajax", "postgres", "tarte07?");

        // Lecture directe des factures
        $stmt = $pdo->query("SELECT id, customer, cashier, amount, received, returned, status FROM factures");
        $bills = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($bills) {
            foreach ($bills as $bill) {
                $excelData = [
                    $bill['id'],
                    $bill['customer'],
                    $bill['cashier'],
                    $bill['amount'],
                    $bill['received'],
                    $bill['returned'],
                    $bill['status']
                ];
                $data .= implode("\t", $excelData) . "\r\n";
            }
        }
        else {
            $data = "Aucune facture trouvées ... ". "\n";
        }
        echo $data;
        die();
    }

