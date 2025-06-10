<?php
session_start();
require_once '../php/Locação/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
  header("Location: login.php");
  exit();
}

$id_cli = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT * FROM cliente WHERE id_cli = :id_cli");
$stmt->bindParam(':id_cli', $id_cli);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
  echo "Erro ao carregar perfil.";
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil do Usuário</title>
  <link rel="stylesheet" href="../Style/perfil.css">
</head>
<body>
  <header class="topbar">
    <div class="container">
      <img src="../img/logo.png" alt="Logo" class="logo">
      <nav class="menu">
        <a href="home.php">Início</a>
        <a href="catalogo.php">Catálogo</a>
        <a href="reserva.html">Reservas</a>
        <a href="perfil.php">Perfil</a>
      </nav>
    </div>
  </header>

  <main class="container2">
    <h1>Perfil do usuário</h1>

    <section class="perfil-dados">
      <div class="perfil-titulo">
        <h2>Perfil</h2>
        <button class="btn-editar">Editar Perfil</button>
      </div>

      <div class="info-usuario">
        <div class="coluna">
          <p><strong>Nome:</strong> <?= htmlspecialchars($cliente['nome']) ?></p>
          <p><strong>CPF:</strong> <?= htmlspecialchars($cliente['cpf']) ?></p>
          <p><strong>Data de nascimento:</strong> <?= htmlspecialchars($cliente['data_nascimento']) ?></p>
          <p><strong>Telefone:</strong> <?= htmlspecialchars($cliente['telefone']) ?></p>
          <p><strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?></p>
          <p><strong>CNH:</strong> <?= htmlspecialchars($cliente['cnh']) ?></p>
        </div>
        <div class="coluna">
          <p><strong>Logradouro:</strong> <?= htmlspecialchars($cliente['rua']) ?></p>
          <p><strong>Bairro:</strong> <?= htmlspecialchars($cliente['bairro']) ?></p>
          <p><strong>CEP:</strong> <?= htmlspecialchars($cliente['cep']) ?></p>
          <p><strong>Cidade:</strong> <?= htmlspecialchars($cliente['cidade']) ?></p>
          <p><strong>Estado:</strong> <?= htmlspecialchars($cliente['estado']) ?></p>
        </div>
      </div>
    </section>

    <section class="historico-locacoes">
      <h2>Histórico de Locações</h2>
 
      <p>Em breve</p>
    </section>
  </main>
</body>
</html>
