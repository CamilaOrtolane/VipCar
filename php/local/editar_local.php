<?php
require_once '../config/Database.php';
require_once 'local_locacao.php';

$db = (new Database())->getConnection();
$local = new LocalLocadora($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $local->id_loc = $_POST['id_loc'];
} else {
    $local->id_loc = $_GET['id_loc'];
}

$dados = $local->buscarPorId();

if ($_POST) {
    $local->cidade = $_POST['cidade'];
    $local->estado = $_POST['estado'];
    $local->cep = $_POST['cep'];
    $local->rua = $_POST['rua'];
    $local->bairro = $_POST['bairro'];
    $local->numero = $_POST['numero'];
    $local->horario_abertura = $_POST['horario_abertura'];
    $local->horario_fechamento = $_POST['horario_fechamento'];

    if ($local->editar()) {
        header("Location: listar_local.php");
        exit;
    }
}
?>
