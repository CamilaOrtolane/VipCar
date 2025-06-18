<?php
require_once '../php/config/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    if (empty($email) || empty($nova_senha) || empty($confirmar_senha)) {
        die('Por favor, preencha todos os campos.');
    }

    if ($nova_senha !== $confirmar_senha) {
        die('As senhas não coincidem.');
    }

    $db = (new Database())->getConnection();

    $query = "SELECT id_cli FROM cliente WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        die('E-mail não encontrado.');
    }

    $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    $queryUpdate = "UPDATE cliente SET senha = :senha WHERE email = :email";
    $stmtUpdate = $db->prepare($queryUpdate);
    $stmtUpdate->bindParam(':senha', $nova_senha_hash);
    $stmtUpdate->bindParam(':email', $email);

    if ($stmtUpdate->execute()) {
        echo "Senha redefinida com sucesso! <a href='login.php'>Fazer Login</a>";
    } else {
        echo "Erro ao redefinir a senha.";
    }
}
?>

