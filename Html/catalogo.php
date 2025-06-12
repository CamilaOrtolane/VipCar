<?php
session_start();

echo "Sessão ID: " . session_id() . "<br>";
echo "ID do cliente: " . ($_SESSION['usuario_id'] ?? 'NÃO LOGADO');


// if (!isset($_SESSION['id_cliente'])) {
//     header('Location: login.php');
//     exit;
// }

require_once('../php/config/Database.php');
$db = (new Database())->getConnection();

$id_cliente_logado = $_SESSION['usuario_id'] ?? null;

$stmt = $db->prepare("SELECT nome FROM cliente WHERE id_cli = ?");
$stmt->execute([$id_cliente_logado]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

try {
    $stmt = $db->query("SELECT * FROM veiculo");
    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
      <a href="home.php">Início</a>
      <a href="catalogo.php">Catálogo</a>
      <a href="reserva.html">Reservas</a>
      <a href="perfil.php">Perfil</a>
    </nav>
    <div class="usuario-logado">
      Bem-vindo, <?= htmlspecialchars($cliente['nome']) ?>
    </div>
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
            hora_devolucao=<?= $_GET['hora_devolucao'] ?? '' ?> "
        >
          Alugar
        </a>

      </div>
    <?php endforeach; ?>
  </div>
</main>
</body>
</html>
