<?php
    require_once '../../php/config/Database.php';
    require_once '../../php/Veiculos/Veiculos.php';

    $db = (new Database())->getConnection();
    $veiculo = new Veiculo($db);
    $veiculo->id_vei = $_GET['id_vei'];
    
    if ($veiculo->deletar()) {
        header("Location: Tabela_veiculos.php");
        exit;
    }
?>