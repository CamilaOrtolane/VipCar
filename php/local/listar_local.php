<?php
require_once '../config/Database.php';
require_once 'local_locacao.php';

$db = (new Database())->getConnection();
$local = new LocalLocadora($db);
$resultado = $local->listar();

include ('../../admin/html/Tabela_Local.php');
