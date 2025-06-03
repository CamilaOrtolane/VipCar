<?php
$servidor = "localhost";
$usuario = "root";
$senha = "root";
$banco = "vip_db";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
?>
