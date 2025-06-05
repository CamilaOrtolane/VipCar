<?php
require_once '../../php/config/Database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID da locação não informado.");
}

$db = (new Database())->getConnection();

$query = "
    SELECT 
        loc.id,
        cli.nome AS nome_cliente,
        vei.modelo AS modelo_veiculo,
        loc.data_entrada,
        loc.data_saida,
        loc.horario_entrada,
        loc.horario_saida,
        loc.valor_por_dia,
        loc.valor_total,
        loc.status,
        loc.local_retirada_cidade,
        loc.local_entrega,
        loc_retirada.rua AS rua_retirada,
        loc_retirada.cidade AS cidade_retirada,
        loc_devolucao.rua AS rua_devolucao,
        loc_devolucao.cidade AS cidade_devolucao
    FROM locacao loc
    JOIN cliente cli ON loc.id_cliente_fk = cli.id_cli
    JOIN veiculo vei ON loc.id_veiculo_fk = vei.id_vei
    LEFT JOIN local_locadora loc_retirada ON loc.id_local_retirada = loc_retirada.id_loc
    LEFT JOIN local_locadora loc_devolucao ON loc.id_local_devolucao = loc_devolucao.id_loc
    WHERE loc.id = :id
";

$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$dados = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$dados) {
    die("Locação não encontrada.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Visualizar Locação</title>
  <link rel="stylesheet" href="../Style/Clientes.css">
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
      <li><a href="../../admin/html/Tabela_clientes.php">Consultar Clientes</a></li>
      <li><a href="../../admin/html/Tabela_Veiculos.php">Consultar Veículos</a></li>
      <li><a href="../../admin/html/Tabela_locacao.php">Consultar Locações</a></li>
      <li><a href="../../admin/html/Tabela_Local.php">Consultar Locadoras</a></li>
      <li><a href="../../admin/html/Catalogo_adm.html">Catálogo</a></li>
    </ul>
  </aside>
  <div class="overlay" id="overlay"></div>

  <main>
    <h2>Visualizar Locação</h2>

    <p><strong>ID:</strong> <?= htmlspecialchars($dados['id']) ?></p>
    <p><strong>Cliente:</strong> <?= htmlspecialchars($dados['nome_cliente']) ?></p>
    <p><strong>Veículo:</strong> <?= htmlspecialchars($dados['modelo_veiculo']) ?></p>

    <p><strong>Data de Retirada:</strong> <?= htmlspecialchars($dados['data_entrada']) ?></p>
    <p><strong>Horário de Retirada:</strong> <?= htmlspecialchars($dados['horario_entrada']) ?></p>
    <p><strong>Local de Retirada:</strong> <?= htmlspecialchars($dados['rua_retirada'] . ' - ' . $dados['cidade_retirada']) ?></p>

    <p><strong>Data de Devolução:</strong> <?= htmlspecialchars($dados['data_saida']) ?></p>
    <p><strong>Horário de Devolução:</strong> <?= htmlspecialchars($dados['horario_saida']) ?></p>
    <p><strong>Local de Devolução:</strong> <?= htmlspecialchars($dados['rua_devolucao'] . ' - ' . $dados['cidade_devolucao']) ?></p>

    <p><strong>Valor por Dia:</strong> R$ <?= number_format($dados['valor_por_dia'], 2, ',', '.') ?></p>
    <p><strong>Valor Total:</strong> R$ <?= number_format($dados['valor_total'], 2, ',', '.') ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($dados['status']) ?></p>

    <br>
    <a href="Tabela_locacao.php" class="button">← Voltar</a>
  </main>

  <script src="../js/Clientes.js"></script>
</body>
</html>
