<?php
require_once '../config/Database.php';
require_once 'Locacao.php';

$db = (new Database())->getConnection();
$locacao = new Locacao($db);
$resultado = $locacao->listar();

include ('../../admin/html/Tabela_Locacao.php');
