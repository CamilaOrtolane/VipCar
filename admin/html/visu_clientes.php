<?php
require_once '../../php/config/Database.php';
require_once '../../php/Cliente/Cliente.php';

$id = $_GET['id_cli'] ?? null;

if (!$id) {
    die("ID do cliente não informado.");
}

$db = (new Database())->getConnection();
$cliente = new Cliente($db);
$cliente->id_cli = $id;

$dados = $cliente->buscarPorId();

if (!$dados) {
    die("Cliente não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Visualizar Cliente</title>
  <link rel="stylesheet" href="../Style/Clientes.css">
</head>
<body>
  <header>
    <div class="menu-icon" id="menu-toggle">☰</div>
    <nav>
      <a href="home adm.html">Início</a>
      <a href="perfil adm.html">Perfil</a>
    </nav>
  </header>

  <aside class="sidebar" id="sidebar">
    <div class="close-btn" id="close-sidebar">✖</div>
    <ul>
      <li><a href="Tabela_clientes.php">Consultar Clientes</a></li>
      <li><a href="Tabela_Veiculos.php">Consultar Veículos</a></li>
      <li><a href="tabela_locação.php">Consultar Locações</a></li>
      <li><a href="tabela_Local.php">Consultar Locadoras</a></li>
      <li><a href="Catalogo_adm.html">Catálogo</a></li>
    </ul>
  </aside>
  <div class="overlay" id="overlay"></div>

  <main>
    <h2>Visualizar</h2>
    <p><strong>Nome:</strong> <?= htmlspecialchars($dados['nome']) ?></p>
    <p><strong>CPF:</strong> <?= htmlspecialchars($dados['cpf']) ?></p>
    <p><strong>Data de Nascimento:</strong> <?= htmlspecialchars($dados['data_nascimento']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($dados['email']) ?></p>
    <p><strong>Telefone:</strong> <?= htmlspecialchars($dados['telefone']) ?></p>
    <p><strong>Endereço:</strong></p>
    <ul>
      <li><strong>Rua:</strong> <?= htmlspecialchars($dados['rua']) ?></li>
      <li><strong>Bairro:</strong> <?= htmlspecialchars($dados['bairro']) ?></li>
      <li><strong>Cidade:</strong> <?= htmlspecialchars($dados['cidade']) ?></li>
      <li><strong>Estado:</strong> <?= htmlspecialchars($dados['estado']) ?></li>
      <li><strong>CEP:</strong> <?= htmlspecialchars($dados['cep']) ?></li>
    </ul>
    <br>
    <a href="Tabela_clientes.php" class="button">← Voltar</a>
  </main>

  <script src="../js/Clientes.js"></script>
</body>
</html>
