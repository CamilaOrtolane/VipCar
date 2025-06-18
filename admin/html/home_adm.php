<?php
require_once('../../php/config/Database.php');

$db = (new Database())->getConnection();

try {
    $stmt = $db->query("SELECT COUNT(*) AS total_disponiveis FROM veiculo WHERE disponibilidade_status = 'Disponível'");
    $veiculosDisponiveis = $stmt->fetch(PDO::FETCH_ASSOC)['total_disponiveis'];
} catch (PDOException $e) {
    echo "Erro na consulta de veículos: " . $e->getMessage();
    exit;
}

try {
    $stmt = $db->query("SELECT COUNT(*) AS total_locacoes FROM locacao");
    $totalLocacoes = $stmt->fetch(PDO::FETCH_ASSOC)['total_locacoes'];
} catch (PDOException $e) {
    echo "Erro na consulta de locações: " . $e->getMessage();
    exit;
}

try {
    $stmt = $db->query("SELECT SUM(valor_total) AS soma_valor FROM locacao");
    $somaValor = $stmt->fetch(PDO::FETCH_ASSOC)['soma_valor'];
    $somaValor = $somaValor ? $somaValor : 0;
} catch (PDOException $e) {
    echo "Erro na consulta do valor total: " . $e->getMessage();
    exit;
}

try {
    $stmt = $db->query("
        SELECT 
            l.id,
            l.data_saida,
            l.valor_total,
            l.status,
            c.nome AS nome_cliente,
            v.modelo AS modelo_veiculo
        FROM locacao l
        INNER JOIN cliente c ON l.id_cliente_fk = c.id_cli
        INNER JOIN veiculo v ON l.id_veiculo_fk = v.id_vei
        ORDER BY l.data_saida DESC
        LIMIT 5
    ");
    $locacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na consulta de locações recentes: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../Style/home adm.css">
  <script src="../js/home adm.js"></script>
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
    <li><a href="Tabela_veiculos.php">Consultar Veículos</a></li>
    <li><a href="Tabela_locacao.php">Consultar Locações</a></li>
    <li><a href="Tabela_Local.php">Consultar Locadoras</a></li>
  </ul>
</aside>
<div class="overlay" id="overlay"></div>

  <div class="dashboard">
<div class="cards">
  <div class="card">
    <img src="https://img.icons8.com/ios-filled/50/f7931e/calendar--v1.png" alt="Calendário">
    <div class="text">
      <h3 class="valor"><?= $totalLocacoes ?></h3>
      <p class="label">Total de Locações</p>
    </div>
  </div>

  <div class="card">
    <img src="https://img.icons8.com/ios-filled/50/f7931e/car--v1.png" alt="Veículo">
    <div class="text">
      <h3 class="valor"><?= $veiculosDisponiveis ?></h3>
      <p class="label">Veículos Disponíveis</p>
    </div>
  </div>

  <div class="card">
    <img src="https://img.icons8.com/ios-filled/50/f7931e/money.png" alt="Dinheiro">
    <div class="text">
      <h3 class="valor">R$ <?= number_format($somaValor, 2, ',', '.') ?></h3>
      <p class="label">Valor Total das Locações</p>
    </div>
  </div>
</div>


    <h3>Locações Recentes</h3>
    <button class="button-consultar" onclick="window.location.href='Tabela_locacao.php'">Consultar Locações ➔</button>

    <!-- <table>
      <thead>
        <tr>
          <th>Cliente</th>
          <th>Veículo</th>
          <th>Valor</th>
          <th>Data</th>
          <th>Status</th>
        </tr>
      </thead>
      
    </table> -->
    <table>
      <tr>
          <th>Cliente</th>
          <th>Veículo</th>
          <th>Data</th>
          <th>Valor Total</th>
          <th>Status</th>
      </tr>
        <?php
        if (count($locacoes) > 0) {
            foreach ($locacoes as $locacao) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($locacao['nome_cliente']) . "</td>";
                echo "<td>" . htmlspecialchars($locacao['modelo_veiculo']) . "</td>";
                echo "<td>" . htmlspecialchars($locacao['data_saida']) . "</td>";
                echo "<td>R$ " . number_format($locacao['valor_total'], 2, ',', '.') . "</td>";
                echo "<td>" . htmlspecialchars($locacao['status']) . "</td>";
                
            }
        } else {
            echo "<tr><td colspan='7'>Nenhuma locação encontrada.</td></tr>";
        }
        ?>
    </table>
  </div>
</body>
</html>