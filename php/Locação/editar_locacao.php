<?php
require_once '../config/Database.php';
require_once 'Locacao.php';

$db = (new Database())->getConnection();
$locacao = new Locacao($db);

// Se veio via POST (para salvar edição)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $locacao->id = $_POST['id'];
} else {
    $locacao->id = $_GET['id'];
}

$dados = $locacao->buscarPorId();

if ($_POST) {
    $locacao->data_entrada = $_POST['data_entrada'];
    $locacao->data_saida = $_POST['data_saida'];
    $locacao->horario_entrada = $_POST['horario_entrada'];
    $locacao->horario_saida = $_POST['horario_saida'];
    $locacao->valor_por_dia = $_POST['valor_por_dia'];
    $locacao->valor_total = $_POST['valor_total'];
    $locacao->local_retirada_cidade = $_POST['local_retirada_cidade'];
    $locacao->local_entrega = $_POST['local_entrega'];
    $locacao->status = $_POST['status'];
    $locacao->id_cliente_fk = $_POST['id_cliente_fk'];
    $locacao->id_veiculo_fk = $_POST['id_veiculo_fk'];
    $locacao->id_local_locadora_fk = $_POST['id_local_locadora_fk'];

    if ($locacao->editar()) {
        header("Location: listar_locacao.php");
        exit;
    } else {
        echo "Erro ao editar locação.";
    }
}
?>
