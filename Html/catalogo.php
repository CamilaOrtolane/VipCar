<?php
require_once('../php/config/Database.php');
$db = (new Database())->getConnection();

try {
    // $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    $stmt = $db->query("SELECT * FROM veiculo");
    $veiculo = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}
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
    <?php foreach ($veiculo as $veiculo): ?>
      <div class="card-carro">
        <img src="../../php/uploads/<?= htmlspecialchars($veiculo['imagem']) ?>" alt="<?= htmlspecialchars($veiculo['modelo']) ?>">
        <h3><?= htmlspecialchars($veiculo['modelo']) ?></h3>
        <p>R$<?= number_format($veiculo['preco_dia'], 2, ',', '.') ?> /dia</p>
        <a class="btn-alugar" 
        href="alugar.php?id_veiculo_fk=<?= $veiculo['id_vei'] ?>&modelo=<?= urlencode($veiculo['modelo']) ?>&preco=<?= $veiculo['preco_dia'] ?>&imagem=<?= htmlspecialchars($veiculo['imagem']) ?>">
        Alugar
        </a>

      </div>
    <?php endforeach; ?>
  </div>
</main>
</body>
</html>
