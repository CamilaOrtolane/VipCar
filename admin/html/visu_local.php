<?php
require_once '../../php/config/Database.php';

$id = $_GET['id_loc'] ?? null;

if (!$id) {
    die("ID da locadora não informado.");
}

$db = (new Database())->getConnection();

try {
    $stmt = $db->prepare("SELECT * FROM local_locadora WHERE id_loc = :id_loc");
    $stmt->bindParam(':id_loc', $id, PDO::PARAM_INT);
    $stmt->execute();
    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dados) {
        die("Locadora não encontrada.");
    }
} catch (PDOException $e) {
    die("Erro ao buscar locadora: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Visualizar Locadora</title>
  <link rel="stylesheet" href="../Style/vizu_local.css">
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
      <li><a href="tabela_locacao.php">Consultar Locações</a></li>
      <li><a href="tabela_Local.php">Consultar Locadoras</a></li>
      <li><a href="Catalogo_adm.html">Catálogo</a></li>
    </ul>
  </aside>
  <div class="overlay" id="overlay"></div>

  <main>
    <h2>Visualizar Locadora</h2>
    <div class="info-container">
      <div class="info-box"><strong>Logradouro:</strong> <span><?= htmlspecialchars($dados['rua']) ?></span></div>
      <div class="info-box"><strong>Bairro:</strong> <span><?= htmlspecialchars($dados['bairro']) ?></span></div>
      <div class="info-box"><strong>CEP:</strong> <span><?= htmlspecialchars($dados['cep']) ?></span></div>
      <div class="info-box"><strong>Cidade:</strong> <span><?= htmlspecialchars($dados['cidade']) ?></span></div>
      <div class="info-box"><strong>Estado:</strong> <span><?= htmlspecialchars($dados['estado']) ?></span></div>
      <div class="info-box"><strong>Horário de Abertura:</strong> <span><?= htmlspecialchars($dados['horario_abertura']) ?></span></div>
      <div class="info-box"><strong>Horário de Fechamento:</strong> <span><?= htmlspecialchars($dados['horario_fechamento']) ?></span></div>
    </div>
    <div class="button-group-view">
      <a href="Tabela_Local.php" class="btn-view">← Voltar</a>
    </div>
  </main>

  <script src="../js/Veiculos.js"></script>
</body>
</html>
