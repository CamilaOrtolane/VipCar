<?php
require_once '../config/Database.php';
require_once 'Cliente.php';

if ($_POST) {
    $db = (new Database())->getConnection();
    $cliente = new Cliente($db);

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

    if ($_POST['senha'] !== $_POST['confirmar_senha']) {
        echo "As senhas não coincidem.";
        exit;
    }

    $cliente->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    if ($cliente->criar()) {
        header("Location: listar_cli.php");
        exit;
    } else {
        echo "Erro ao criar cliente.";
    }
}
?>
