<?php
require_once '../config/Database.php';
require_once 'Veiculos.php';

$db = (new Database())->getConnection();
$veiculo = new Veiculo($db);
$resultado = $veiculo->listar();

// Inclui o HTML que vai exibir a lista
include ('../../admin/html/Tabela_veiculos.php');
