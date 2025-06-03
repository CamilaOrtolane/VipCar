<?php
require_once '../config/Database.php';
require_once 'local_locacao.php';

$db = (new Database())->getConnection();
$local = new LocalLocadora($db);
$resultado = $local->listar();

// Inclui o HTML que vai exibir a lista
include ('../../admin/html/Tabela_Local.php');
