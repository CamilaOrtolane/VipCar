<?php
require_once '../php/config/Database.php';

$mensagem = '';
$senhaRedefinida = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    if (empty($email) || empty($nova_senha) || empty($confirmar_senha)) {
        $mensagem = 'Por favor, preencha todos os campos.';
    } elseif ($nova_senha !== $confirmar_senha) {
        $mensagem = 'As senhas não coincidem.';
    } else {
        $db = (new Database())->getConnection();

        // Verificar se o e-mail existe
        $query = "SELECT id_cli FROM cliente WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cliente) {
            $mensagem = 'E-mail não encontrado.';
        } else {
            // Atualizar a senha
            $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            $queryUpdate = "UPDATE cliente SET senha = :senha WHERE email = :email";
            $stmtUpdate = $db->prepare($queryUpdate);
            $stmtUpdate->bindParam(':senha', $nova_senha_hash);
            $stmtUpdate->bindParam(':email', $email);

            if ($stmtUpdate->execute()) {
                $senhaRedefinida = true;
            } else {
                $mensagem = 'Erro ao redefinir a senha.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
  <link rel="stylesheet" href="../Style/style.css" />
</head>
<body>

<?php if ($senhaRedefinida) : ?>
    <script>
        alert("Senha redefinida com sucesso!");
        window.location.href = "login.php";
    </script>
<?php endif; ?>

<div class="login-container">
    <form method="POST">
        <div class="logodiv">
            <img src="../img/logo.png" alt="VipCar" class="logo">
            <h2>Redefinir Senha</h2>
        </div>

        <?php if (!empty($mensagem)) : ?>
            <div class="mensagem">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <div class="input-group">
            <label for="email">E-mail cadastrado:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="input-group">
            <label for="nova_senha">Nova senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" required>
        </div>

        <div class="input-group">
            <label for="confirmar_senha">Confirmar nova senha:</label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" required>
        </div>

        <button type="submit" class="btn-entrar">Redefinir Senha</button>
    </form>
</div>

</body>

</body>
</html>
