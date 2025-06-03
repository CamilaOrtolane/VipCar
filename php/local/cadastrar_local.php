<?php
require_once '../config/Database.php';
require_once 'local_locacao.php';

if ($_POST) {
    $db = (new Database())->getConnection();
    $local = new LocalLocadora($db);

    $local->cidade = $_POST['cidade'];
    $local->estado = $_POST['estado'];
    $local->cep = $_POST['cep'];
    $local->rua = $_POST['rua'];
    $local->bairro = $_POST['bairro'];
    $local->numero = $_POST['numero'];
    $local->horario_abertura = $_POST['horario_abertura'];
    $local->horario_fechamento = $_POST['horario_fechamento'];

    if ($local->criar()) {
        header("Location: listar_local.php");
        exit;
    } else {
        echo "Erro ao criar local da locadora.";
    }
}
?>