<?php
require_once '../config/Database.php';
require_once 'Cliente.php';

$db = (new Database())->getConnection();
$cliente = new Cliente($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente->id_cli = $_POST['id_cli'];  // Correto
} else {
    $cliente->id_cli = $_GET['id_cli'];   // Correto ao carregar dados
}
$dados = $cliente->buscarPorId();

if ($_POST) {
    $cliente->nome = $_POST['nome'];
    $cliente->cpf = $_POST['cpf'];
    $cliente->email = $_POST['email'];
    $cliente->telefone = $_POST['telefone'];
    $cliente->rua = $_POST['rua'];
    $cliente->bairro = $_POST['bairro'];
    $cliente->cep = $_POST['cep'];
    $cliente->cidade = $_POST['cidade'];
    $cliente->estado = $_POST['estado'];
    $cliente->data_nascimento = $_POST['data_nascimento'];
    $cliente->cnh = $_POST['cnh'];

    if ($cliente->editar()) {
        header("Location: listar_clientes.php");
        exit;
    }
}
?>
