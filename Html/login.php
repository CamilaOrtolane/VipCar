<?php
session_start();
require_once '../php/Locação/conexao.php';

$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];

  if ($usuario === 'admin' && $senha === 'admin123') {
    $_SESSION['usuario_id'] = 'admin'; 
    header("Location: ../admin/html/home_adm.php"); 
    exit();
  }

  $stmt = $conn->prepare("SELECT * FROM cliente WHERE email = :usuario");
  $stmt->bindParam(':usuario', $usuario);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($senha, $user['senha'])) {
    $_SESSION['usuario_id'] = $user['id_cli'];
    header("Location: home.php");
    exit();
  } else {
    $erro = "Usuário ou senha inválidos.";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link rel="stylesheet" href="../Style/style.css" />
</head>
<body>
  <div class="login-container">
    <form method="POST" action="login.php">
      <img src="../img/logo.png" alt="vipCar" class="logo" />
      <h2>Login</h2>
      <?php if ($erro): ?>
        <p style="color: red;"><?= $erro ?></p>
      <?php endif; ?>
      <div class="input-group">
        <label for="usuario">Usuário (e-mail):</label>
        <input type="text" id="usuario" name="usuario" required />
      </div>
      <div class="input-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required />
      </div>
      <a href="esqueci_senha.php" class="esqueci-senha">Esqueci minha senha</a>
      <button type="submit" class="btn-entrar">Entrar</button>
      <div class="divider"></div>
      <button onclick="window.location.href='Cadastro-Clientes.html'" type="button" class="btn-cadastrar">Cadastre-se</button>
    </form>
  </div>
</body>
</html>
