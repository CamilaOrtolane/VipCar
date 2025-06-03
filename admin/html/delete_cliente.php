<?php
    require_once '../../php/config/Database.php';
    require_once '../../php/Cliente/Cliente.php';

    $db = (new Database())->getConnection();
    $cliente = new Cliente($db);
    $cliente->id_cli = $_GET['id_cli'];
    
    if ($cliente->deletar()) {
        header("Location: Tabela_clientes.php");
        exit;
    }
?>