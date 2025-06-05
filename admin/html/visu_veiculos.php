<?php
require_once '../../php/config/Database.php';
require_once '../../php/Veiculos/Veiculos.php';

$id = $_GET['id_vei'] ?? null;

if (!$id) {
    die("ID do veículo não informado.");
}

$db = (new Database())->getConnection();
$veiculo = new Veiculo($db);
$veiculo->id_vei = $id;

$dados = $veiculo->buscarPorId();

if (!$dados) {
    die("Veículo não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Visualizar Veículo</title>
  <link rel="stylesheet" href="../Style/Clientes.css"> <!-- Reutilizando o estilo do cliente -->
</head>
<body>
  <header>
    <div class="menu-icon" id="menu-toggle">☰</div>
    <nav>
      <a href="home_adm.php">Início</a>
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
    <h2>Visualizar Veículo</h2>
    <p><strong>Nome para Exibição:</strong> <?= htmlspecialchars($dados['nome']) ?></p>
    <p><strong>Modelo:</strong> <?= htmlspecialchars($dados['modelo']) ?></p>
    <p><strong>Marca:</strong> <?= htmlspecialchars($dados['marca']) ?></p>
    <p><strong>Placa:</strong> <?= htmlspecialchars($dados['placa']) ?></p>
    <p><strong>Chassi:</strong> <?= htmlspecialchars($dados['chassi']) ?></p>
    <p><strong>RENAVAM:</strong> <?= htmlspecialchars($dados['renavam']) ?></p>
    <p><strong>Ano de Fabricação:</strong> <?= htmlspecialchars($dados['ano_fabricacao']) ?></p>
    <p><strong>Capacidade:</strong> <?= htmlspecialchars($dados['capacidade']) ?></p>
    <p><strong>Bagageiro:</strong> <?= htmlspecialchars($dados['bagageiro']) ?></p>
    <p><strong>Câmbio:</strong> <?= htmlspecialchars($dados['cambio']) ?></p>
    <p><strong>KM Rodados:</strong> <?= htmlspecialchars($dados['km_rodados']) ?></p>
    <p><strong>Última Revisão:</strong> <?= htmlspecialchars($dados['ultima_revisao']) ?></p>
    <p><strong>Disponibilidade:</strong> <?= htmlspecialchars($dados['disponibilidade_status']) ?></p>

    <?php if (!empty($dados['imagem'])): ?>
      <p><strong>Imagem:</strong></p>
      <img src="../../php/uploads/<?= htmlspecialchars($dados['imagem']) ?>" alt="Imagem do veículo" width="300">
    <?php else: ?>
      <p><strong>Imagem:</strong> Não cadastrada.</p>
    <?php endif; ?>

    <br>
    <a href="Tabela_Veiculos.php" class="button">← Voltar</a>
  </main>

  <script src="../js/Clientes.js"></script> <!-- Pode ser renomeado se necessário -->
</body>
</html>
