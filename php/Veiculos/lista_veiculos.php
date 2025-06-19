<?php
require_once '../config/Database.php';
require_once 'Veiculos.php';

$db = (new Database())->getConnection();
$veiculo = new Veiculo($db);
$resultado = $veiculo->listar();

include ('../../admin/html/Tabela_veiculos.php');
