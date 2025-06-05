<?php
require_once('../../php/config/Database.php');

$db = (new Database())->getConnection();

try {
    $stmt = $db->query("SELECT * FROM cliente");
    $cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Clientes</title>
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
    <li><a href="../../admin/html/Tabela_veiculos.php">Consultar Veículos</a></li>
    <li><a href="../../admin/html/Tabela_locacao.php">Consultar Locações</a></li>
    <li><a href="../../admin/html/Tabela_Local.php">Consultar Locadoras</a></li>
    <li><a href="Catalogo adm.html">Catálogo</a></li>
  </ul>
</aside>
<div class="overlay" id="overlay"></div>

  <main>
    <div class="header-section">
      <h2>Clientes</h2>
      <a class="button" href="../../admin/html/cadas_clientes.html">Cadastrar Cliente</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php
        if (count($cliente) > 0) {
            foreach ($cliente as $cliente) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($cliente['nome']) . "</td>";
                echo "<td>" . htmlspecialchars($cliente['cpf']) . "</td>";
                echo "<td>" . htmlspecialchars($cliente['telefone']) . "</td>";
                echo "<td>" . htmlspecialchars($cliente['cidade']) . "</td>";
                echo "<td>
                        <a href='../../admin/html/visu_clientes.php?id_cli=" . $cliente['id_cli'] . "' class='aTabela'>Visualizar</a> |
                        <a href='../../admin/html/edit_clientes.php?id_cli=" . $cliente['id_cli'] . "' class='aTabela'>Editar</a> |
                        <a href='../../admin/html/delete_cliente.php?id_cli=" . $cliente['id_cli'] . "' onclick=\"return confirm('Tem certeza que deseja excluir?');\" class='aTabela'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum cliente encontrado.</td></tr>";
        }
        ?>
    </table>
  </main>

  <script src="../../admin/js/Clientes.js"></script>
</body>
</html>
