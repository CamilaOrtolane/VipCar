<?php
session_start();
require_once '../php/Locação/conexao.php'; // ajuste o caminho conforme seu projeto

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id_cli = $_SESSION['usuario_id'];

$query = "
    SELECT 
        loc.id,
        vei.modelo AS modelo_veiculo,
        loc.data_entrada,
        loc.data_saida,
        loc.valor_total,
        loc.status,
        loc_retirada.rua AS rua_retirada,
        loc_retirada.cidade AS cidade_retirada,
        loc_devolucao.rua AS rua_devolucao,
        loc_devolucao.cidade AS cidade_devolucao,
        vei.imagem AS imagem_veiculo -- ajuste se o campo existir
    FROM locacao loc
    JOIN veiculo vei ON loc.id_veiculo_fk = vei.id_vei
    LEFT JOIN local_locadora loc_retirada ON loc.id_local_retirada = loc_retirada.id_loc
    LEFT JOIN local_locadora loc_devolucao ON loc.id_local_devolucao = loc_devolucao.id_loc
    WHERE loc.id_cliente_fk = :id_cli
    ORDER BY loc.data_entrada DESC
";

$stmt = $conn->prepare($query);
$stmt->bindParam(':id_cli', $id_cli, PDO::PARAM_INT);
$stmt->execute();

$locacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reservas</title>
  <link rel="stylesheet" href="../Style/reserva.css" />
</head>
<body>
  <header class="topbar">
    <div class="container">
      <img src="../img/logo.png" alt="Logo" class="logo" />
      <nav class="menu">
        <a href="home.php">Início</a>
        <a href="catalogo.php">Catálogo</a>
        <a href="reserva.php" class="active">Reservas</a>
        <a href="perfil.php">Perfil</a>
      </nav>
    </div>
  </header>

  <main class="container2">
    <h1>Reservas</h1>

    <?php if (empty($locacoes)) : ?>
      <p>Você não possui reservas no momento.</p>
    <?php else: ?>
      <?php foreach ($locacoes as $loc) : ?>
        <div class="reserva-card">
          <div class="reserva-info">
            <p><strong>Modelo:</strong> <?= htmlspecialchars($loc['modelo_veiculo']) ?></p>
            <p><strong>Valor Total:</strong> R$ <?= number_format($loc['valor_total'], 2, ',', '.') ?></p>
            <p><strong>Data de Retirada:</strong> <?= date('d/m/Y', strtotime($loc['data_entrada'])) ?></p>
            <p><strong>Data de Entrega:</strong> <?= date('d/m/Y', strtotime($loc['data_saida'])) ?></p>
            <p><strong>Local da Retirada:</strong> 
              <?= htmlspecialchars(trim(($loc['rua_retirada'] ?? '') . ' - ' . ($loc['cidade_retirada'] ?? 'Não informado'))) ?>
            </p>
            <p><strong>Local da Entrega:</strong> 
              <?= htmlspecialchars(trim(($loc['rua_devolucao'] ?? '') . ' - ' . ($loc['cidade_devolucao'] ?? 'Não informado'))) ?>
            </p>
            <p><strong>Status:</strong> <?= htmlspecialchars($loc['status']) ?></p>
          </div>
          <div class="reserva-img">
            <?php
              $imgPath = '../img/' . ($loc['imagem_veiculo'] ?: 'default.png');
            ?>
            <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($loc['modelo_veiculo']) ?>" />
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </main>
</body>
</html>
