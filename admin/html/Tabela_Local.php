<?php
require_once('../../php/config/Database.php');

$db = (new Database())->getConnection();

try {
    $stmt = $db->query("SELECT * FROM local_locadora");
    $locais = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Locadoras</title>
  <link rel="stylesheet" href="../../admin/Style/Clientes.css">
</head>
<body>
  <header>
    <div class="menu-icon" id="menu-toggle">☰</div>
    <nav>
      <a href="home adm.html">Início</a>
      <a href="perfil adm.html">Perfil</a>
    </nav>
  </header>

  <aside class="sidebar" id="sidebar">
    <div class="close-btn" id="close-sidebar">✖</div>
    <ul>
      <li><a href="Tabela_clientes.php">Consultar Clientes</a></li>
      <li><a href="Tabela_veiculos.php">Consultar Veículos</a></li>
      <li><a href="tabela_locacao.php">Consultar Locações</a></li>
      <li><a href="tabela_Local.php">Consultar Locadoras</a></li>
      <li><a href="Catalogo adm.html">Catálogo</a></li>
    </ul>
  </aside>
  <div class="overlay" id="overlay"></div>

  <main>
    <div class="header-section">
      <h2>Locadoras</h2>
      <a class="button" href="cadas_local.html">Cadastrar Locadora</a>
    </div>

   

    <table>
      <tr>
        <th>ID</th>
        <th>Logradouro</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>Ações</th>
      </tr>

      <?php
      if (count($locais) > 0) {
          foreach ($locais as $local) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($local['id_loc']) . "</td>";
              echo "<td>" . htmlspecialchars($local['rua']?? '') . "</td>";
              echo "<td>" . htmlspecialchars($local['bairro']) . "</td>";
              echo "<td>" . htmlspecialchars($local['cidade']) . "</td>";
              echo "<td>" . htmlspecialchars($local['estado']) . "</td>";
              echo "<td>
                      <a href='../../admin/html/visu_local.php?id_loc=" . $local['id_loc'] . "' style='color: #222; font-weight:normal;'>Visualizar</a> |
                      <a href='../../admin/html/edit_local.php?id_loc=" . $local['id_loc'] . "' style='color: #222; font-weight:normal;'>Editar</a> |
                      <a href='../../admin/html/delete_local.php?id_loc=" . $local['id_loc'] . "' onclick=\"return confirm('Tem certeza que deseja excluir?');\" style='color: #222; font-weight:normal;'>Excluir</a>
                    </td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='16'>Nenhum veículo encontrado.</td></tr>";
      }
      ?>
    </table>
  </main>

  <script src="../js/Veiculos.js"></script>
</body>
</html>
