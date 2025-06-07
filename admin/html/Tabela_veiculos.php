<?php
require_once('../../php/config/Database.php');
$db = (new Database())->getConnection();

try {
    $stmt = $db->query("SELECT * FROM veiculo"); // Tabela de veículos
    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Veículos</title>
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
    <li><a href="../../admin/html/Catalogo_adm.html">Catálogo</a></li>
    </ul>
  </aside>
  <div class="overlay" id="overlay"></div>

  <main>
    <div class="header-section">
      <h2>Veículos</h2>
      <a class="button" href="../../admin/html/cadas_veiculos.html">Cadastrar Veículo</a>
    </div>

    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Disponibilidade</th>
        <th>Imagem</th>
        <th>Placa</th>
        <th>Modelo</th>
        <th>Ações</th>
      </tr>

      <?php
      if (count($veiculos) > 0) {
          foreach ($veiculos as $veiculo) {
            $imagem = isset($veiculo['imagem']) ? str_replace('../', '', $veiculo['imagem']) : '';

              echo "<tr>";
              echo "<td>" . htmlspecialchars($veiculo['id_vei']) . "</td>";
              echo "<td>" . htmlspecialchars($veiculo['nome']) . "</td>";
              echo "<td>" . htmlspecialchars($veiculo['disponibilidade_status']) . "</td>";
              echo "<td><img src='../../" . htmlspecialchars($imagem) . "' alt='Imagem' width='80'></td>";
              echo "<td>" . htmlspecialchars($veiculo['placa']) . "</td>";
              echo "<td>" . htmlspecialchars($veiculo['modelo']) . "</td>";
              echo "<td>
                      <a href='../../admin/html/visu_veiculos.php?id_vei=" . $veiculo['id_vei'] . "' class='aTabela'>Visualizar</a> |
                      <a href='../../admin/html/edit_veiculos.php?id_vei=" . $veiculo['id_vei'] . "' class='aTabela'>Editar</a> |
                      <a href='../../admin/html/delete_veiculo.php?id_vei=" . $veiculo['id_vei'] . "' onclick=\"return confirm('Tem certeza que deseja excluir?');\" class='aTabela'>Excluir</a>
                    </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='16'>Nenhum veículo encontrado.</td></tr>";
      }
      ?>
    </table>
  </main>

  <script src="../../admin/js/veiculos.js"></script>
</body>
</html>
