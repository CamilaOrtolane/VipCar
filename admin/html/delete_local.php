<?php
    require_once '../../php/config/Database.php';
    require_once '../../php/local/local_locacao.php';

    $db = (new Database())->getConnection();
    $local = new LocalLocadora($db);
    $local->id_loc = $_GET['id_loc'];
    
    if ($local->deletar()) {
        header("Location: Tabela_Local.php");
        exit;
    }
?>