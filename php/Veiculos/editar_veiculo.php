<?php
require_once '../config/Database.php';
require_once 'Veiculos.php';

$db = (new Database())->getConnection();
$veiculo = new Veiculo($db);


$veiculo->id_vei = $_POST['id_vei'] ?? $_GET['id_vei'] ?? null;

if (!$veiculo->id_vei) {
    die("ID do veículo não fornecido.");
}

$dados = $veiculo->buscarPorId();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $veiculo->nome = $_POST['nome'] ?? '';
    $veiculo->disponibilidade_status = $_POST['disponibilidade_status'] ?? '';
    $veiculo->preco_dia = $_POST['preco_dia'] ?? '';
    $veiculo->capacidade = $_POST['capacidade'] ?? '';
    $veiculo->bagageiro = $_POST['bagageiro'] ?? '';
    $veiculo->cambio = $_POST['cambio'] ?? '';
    $veiculo->imagem = $_POST['imagem'] ?? '';
    $veiculo->placa = $_POST['placa'] ?? '';
    $veiculo->ano_fabricacao = $_POST['ano_fabricacao'] ?? '';
    $veiculo->modelo = $_POST['modelo'] ?? '';
    $veiculo->chassi = $_POST['chassi'] ?? '';
    $veiculo->renavam = $_POST['renavam'] ?? '';
    $veiculo->marca = $_POST['marca'] ?? '';
    $veiculo->km_rodados = $_POST['km_rodados'] ?? '';
    $veiculo->ultima_revisao = $_POST['ultima_revisao'] ?? '';

    if ($veiculo->editar()) {
        header("Location: ../../admin/html/Tabela_veiculos.php");
        exit;
    } else {
        echo "Erro ao editar veículo.";
    }
}
?>
