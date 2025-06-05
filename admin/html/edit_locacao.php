<?php
require_once '../../php/Locação/conexao.php';

if (!isset($_GET['id'])) {
    die('ID da locação não especificado.');
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM locacao WHERE id = ?");
$stmt->execute([$id]);
$locacao = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$locacao) {
    die('Locação não encontrada.');
}

$clientes = $conn->query("SELECT id_cli, nome FROM cliente");

$veiculos = $conn->query("SELECT id_vei, modelo FROM veiculo");

$locadoras_retirada = $conn->query("SELECT id_loc, rua, cidade FROM local_locadora");
$locadoras_devolucao = $conn->query("SELECT id_loc, rua, cidade FROM local_locadora");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Locação</title>
  <link rel="stylesheet" href="../Style/edit_locação.css">
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

<h2>Editar Locação</h2>

<form action="../../php/Locação/editar_locacao.php" method="POST">
  <input type="hidden" name="id" value="<?= $locacao['id'] ?>">

  <div class="form-grid">

    <div>
      <label for="id_cliente_fk">Cliente:</label>
      <select id="id_cliente_fk" name="id_cliente_fk" required>
        <option value="">Selecione o cliente</option>
        <?php while ($cliente = $clientes->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $cliente['id_cli'] ?>" <?= ($cliente['id_cli'] == $locacao['id_cliente_fk']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($cliente['nome']) ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="id_veiculo_fk">Veículo:</label>
      <select id="id_veiculo_fk" name="id_veiculo_fk" required>
        <option value="">Selecione o veículo</option>
        <?php while ($veiculo = $veiculos->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $veiculo['id_vei'] ?>" <?= ($veiculo['id_vei'] == $locacao['id_veiculo_fk']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($veiculo['modelo']) ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="data_entrada">Data de Retirada:</label>
      <input type="date" id="data_entrada" name="data_entrada" value="<?= $locacao['data_entrada'] ?>" required>
    </div>

    <div>
      <label for="data_saida">Data de Devolução:</label>
      <input type="date" id="data_saida" name="data_saida" value="<?= $locacao['data_saida'] ?>" required>
    </div>

    <div>
      <label for="horario_entrada">Horário de Retirada:</label>
      <input type="time" id="horario_entrada" name="horario_entrada" value="<?= $locacao['horario_entrada'] ?>" required>
    </div>

    <div>
      <label for="horario_saida">Horário de Devolução:</label>
      <input type="time" id="horario_saida" name="horario_saida" value="<?= $locacao['horario_saida'] ?>" required>
    </div>

    <div>
      <label for="id_local_retirada">Local de Retirada:</label>
      <select id="id_local_retirada" name="id_local_retirada" required>
        <option value="">Selecione o local</option>
        <?php while ($loc = $locadoras_retirada->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $loc['id_loc'] ?>" <?= ($loc['id_loc'] == $locacao['id_local_retirada']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($loc['rua']) ?> - <?= htmlspecialchars($loc['cidade']) ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="id_local_devolucao">Local de Devolução:</label>
      <select id="id_local_devolucao" name="id_local_devolucao" required>
        <option value="">Selecione o local</option>
        <?php while ($loc = $locadoras_devolucao->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $loc['id_loc'] ?>" <?= ($loc['id_loc'] == $locacao['id_local_devolucao']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($loc['rua']) ?> - <?= htmlspecialchars($loc['cidade']) ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="valor_por_dia">Valor da Diária (R$):</label>
      <input type="number" step="0.01" id="valor_por_dia" name="valor_por_dia" value="<?= $locacao['valor_por_dia'] ?>" required>
    </div>

    <div>
      <label for="valor_total">Valor Total (R$):</label>
      <input type="number" step="0.01" id="valor_total" name="valor_total" value="<?= $locacao['valor_total'] ?>" required>
    </div>

   <div>
    <label for="status">Status:</label>
    <select id="status" name="status" required>
      <option value="">Selecione o status</option>
      <option value="Ativa" <?= ($locacao['status'] == 'Ativa') ? 'selected' : '' ?>>Ativa</option>
      <option value="Cancelada" <?= ($locacao['status'] == 'Cancelada') ? 'selected' : '' ?>>Cancelada</option>
      <option value="Finalizada" <?= ($locacao['status'] == 'Finalizada') ? 'selected' : '' ?>>Finalizada</option>
    </select>
</div>


  </div>

  <div class="button-group">
    <button type="button" class="btn cancel" onclick="window.history.back()">Cancelar</button>
    <button type="submit" class="btn save">Salvar Alterações</button>
  </div>
</form>

<script src="../js/Veiculos.js"></script>

</body>
</html>
