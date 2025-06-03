<?php
require_once '../config/Database.php';
require_once 'Locacao.php';

$db = (new Database())->getConnection();
$locacao = new Locacao($db);
$resultado = $locacao->listar();

// Inclui o HTML que vai exibir a lista
include ('../../admin/html/Tabela_Locacao.php');
