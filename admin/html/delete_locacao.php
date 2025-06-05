<?php
    require_once '../../php/config/Database.php';
    require_once '../../php/Locação/Locacao.php';

    $db = (new Database())->getConnection();
    $locacao = new Locacao($db);
    $locacao->id = $_GET['id'];
    
    if ($locacao->deletar()) {
        header("Location: Tabela_locacao.php");
        exit;
    }
?>