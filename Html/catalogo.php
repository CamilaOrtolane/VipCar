<?php
require_once('../php/config/Database.php');
$db = (new Database())->getConnection();

try {
    $stmt = $db->query("SELECT * FROM veiculo");
    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}

// Recupera dados da URL (formulário anterior)
$localRetirada   = $_GET['local_retirada']   ?? '';
$dataRetirada    = $_GET['data_retirada']    ?? '';
$horaRetirada    = $_GET['hora_retirada']    ?? '';
$localDevolucao  = $_GET['local_devolucao']  ?? '';
$dataDevolucao   = $_GET['data_devolucao']   ?? '';
$horaDevolucao   = $_GET['hora_devolucao']   ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Catálogo</title>
  <link rel="stylesheet" href="../Style/catalago.css">
  <script src="../js/catalogo.js"></script>
</head>
<body>
<header class="topbar">
  <div class="container">
    <img src="../img/logo.png" alt="Logo" class="logo">
    <nav class="menu">
      <a href="home.html">Início</a>
      <a href="catalogo.php">Catálogo</a>
      <a href="reserva.html">Reservas</a>
      <a href="login.html">Perfil</a>
    </nav>
  </div>
</header>

<main class="container2">
  <h1>Catálogo</h1>

  <div class="filtros">
    <input type="text" placeholder="Nome ou modelo">
    <input type="text" placeholder="Faixa de preço">
    <button class="btn-buscar">Buscar</button>
  </div>

  <div class="catalogo-grid">
    <?php foreach ($veiculos as $veiculo): ?>
      <div class="card-carro">
        <img src="../../php/uploads/<?= htmlspecialchars($veiculo['imagem']) ?>" alt="<?= htmlspecialchars($veiculo['modelo']) ?>">
        <h3><?= htmlspecialchars($veiculo['modelo']) ?></h3>
        <p>R$<?= number_format($veiculo['preco_dia'], 2, ',', '.') ?> /dia</p>
        
        <a class="btn-alugar" 
          href="alugar.php?
            id_veiculo_fk=<?= $veiculo['id_vei'] ?>&
            modelo=<?= urlencode($veiculo['modelo']) ?>&
            preco=<?= $veiculo['preco_dia'] ?>&
            imagem=<?= htmlspecialchars($veiculo['imagem']) ?>&
            id_local_retirada=<?= $_GET['id_local_retirada'] ?? '' ?>&
            data_retirada=<?= $_GET['data_retirada'] ?? '' ?>&
            hora_retirada=<?= $_GET['hora_retirada'] ?? '' ?>&
            id_local_devolucao=<?= $_GET['id_local_devolucao'] ?? '' ?>&
            data_devolucao=<?= $_GET['data_devolucao'] ?? '' ?>&
            hora_devolucao=<?= $_GET['hora_devolucao'] ?? '' ?>"
        >
          Alugar
        </a>

      </div>
    <?php endforeach; ?>
  </div>
</main>
</body>
</html>
