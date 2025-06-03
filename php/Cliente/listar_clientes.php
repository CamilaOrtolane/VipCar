<?php
require_once '../config/Database.php';
require_once 'Cliente.php';

$db = (new Database())->getConnection();
$cliente = new Cliente($db);
$resultado = $cliente->listar();

// Inclui o HTML que vai exibir a lista
include ('../../admin/html/Tabela_clientes.php');
