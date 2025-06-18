<?php
require_once('../../php/config/Database.php');

$db = (new Database())->getConnection();

try {
    $stmt = $db->query("SELECT * FROM locacao");
    $locacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
    exit;
}

require_once('../../php/config/Database.php');

$db = (new Database())->getConnection();

try {
    $stmt = $db->query("
        SELECT 
            l.id,
            l.data_saida,
            l.data_entrada,
            l.valor_total,
            l.status,
            c.nome AS nome_cliente,
            v.modelo AS modelo_veiculo
        FROM locacao l
        INNER JOIN cliente c ON l.id_cliente_fk = c.id_cli
        INNER JOIN veiculo v ON l.id_veiculo_fk = v.id_vei
    ");
    $locacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Locações</title>
  <link rel="stylesheet" href="../../admin/Style/Clientes.css">
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
  </ul>
</aside>
<div class="overlay" id="overlay"></div>

<main>
  <div class="header-section">
    <h2>Locações</h2>
    <a class="button" href="cadas_locacao.php">Cadastrar Locação</a>
  </div>

  <table>
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Veículo</th>
        <th>Data Retirada</th>
        <th>Data Devolução</th>
        <th>Valor Total</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>
    <?php
    if (count($locacoes) > 0) {
        foreach ($locacoes as $locacao) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($locacao['id']) . "</td>";
            echo "<td>" . htmlspecialchars($locacao['nome_cliente']) . "</td>";
            echo "<td>" . htmlspecialchars($locacao['modelo_veiculo']) . "</td>";
            echo "<td>" . htmlspecialchars($locacao['data_saida']) . "</td>";
            echo "<td>" . htmlspecialchars($locacao['data_entrada']) . "</td>";
            echo "<td>R$ " . number_format($locacao['valor_total'], 2, ',', '.') . "</td>";
            echo "<td>" . htmlspecialchars($locacao['status']) . "</td>";
            echo "<td>
                    <a href='../../admin/html/visu_locacao.php?id=" . $locacao['id'] . "' class='aTabela'>Visualizar</a> |
                    <a href='../../admin/html/edit_locacao.php?id=" . $locacao['id'] . "' class='aTabela'>Editar</a> |
                    <a href='../../admin/html/delete_locacao.php?id=" . $locacao['id'] . "' onclick=\"return confirm('Tem certeza que deseja excluir?');\" class='aTabela'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Nenhuma locação encontrada.</td></tr>";
    }
    ?>
</table>

</main>

<script src="../js/Clientes.js"></script>
</body>
</html>
