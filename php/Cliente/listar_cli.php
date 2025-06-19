<?php
require_once '../config/Database.php';
require_once 'Cliente.php';

$db = (new Database())->getConnection();
$cliente = new Cliente($db);
$resultado = $cliente->listar();

include ('../../html/perfil.php');
