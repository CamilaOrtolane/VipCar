<?php
require_once '../../php/Locação/conexao.php';

// Buscar clientes
$clientes = $conn->query("SELECT id_cli, nome FROM cliente");

// Buscar veículos
$veiculos = $conn->query("SELECT id_vei, modelo FROM veiculo");

// Buscar locadoras (faremos duas consultas separadas)
$locadoras_retirada = $conn->query("SELECT id_loc, rua, cidade FROM local_locadora");
$locadoras_devolucao = $conn->query("SELECT id_loc, rua, cidade FROM local_locadora");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Locação</title>
  <link rel="stylesheet" href="../Style/edit_locação.css">
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
    <li><a href="Tabela clientes.html">Consultar Clientes</a></li>
    <li><a href="Tabela Veiculos.html">Consultar Veículos</a></li>
    <li><a href="tabela locação.html">Consultar Locações</a></li>
    <li><a href="tabela Local.html">Consultar Locadoras</a></li>
    <li><a href="Catalogo adm.html">Catálogo</a></li>
  </ul>
</aside>
<div class="overlay" id="overlay"></div>

<h2>Realizar Locação</h2>

<form action="../../php/Locação/cadastrar_locacao.php" method="POST">
  <div class="form-grid">

    <!-- Cliente -->
    <div>
      <label for="id_cliente_fk">Cliente:</label>
      <select id="id_cliente_fk" name="id_cliente_fk" required>
        <option value="">Selecione o cliente</option>
        <?php while ($cliente = $clientes->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $cliente['id_cli'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
        <?php } ?>
      </select>
    </div>

    <!-- Veículo -->
    <div>
      <label for="id_veiculo_fk">Veículo:</label>
      <select id="id_veiculo_fk" name="id_veiculo_fk" required>
        <option value="">Selecione o veículo</option>
        <?php while ($veiculo = $veiculos->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $veiculo['id_vei'] ?>"><?= htmlspecialchars($veiculo['modelo']) ?></option>
        <?php } ?>
      </select>
    </div>

    <!-- Datas -->
    <div>
      <label for="data_entrada">Data de Retirada:</label>
      <input type="date" id="data_entrada" name="data_entrada" required>
    </div>

    <div>
      <label for="data_saida">Data de Devolução:</label>
      <input type="date" id="data_saida" name="data_saida" required>
    </div>

    <!-- Horários -->
    <div>
      <label for="horario_entrada">Horário de Retirada:</label>
      <input type="time" id="horario_entrada" name="horario_entrada" required>
    </div>

    <div>
      <label for="horario_saida">Horário de Devolução:</label>
      <input type="time" id="horario_saida" name="horario_saida" required>
    </div>

    <!-- Locais -->
    <div>
      <label for="id_local_retirada">Local de Retirada:</label>
      <select id="id_local_retirada" name="id_local_retirada" required>
        <option value="">Selecione o local</option>
        <?php while ($loc = $locadoras_retirada->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $loc['id_loc'] ?>"><?= htmlspecialchars($loc['rua']) ?> - <?= htmlspecialchars($loc['cidade']) ?></option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="id_local_devolucao">Local de Devolução:</label>
      <select id="id_local_devolucao" name="id_local_devolucao" required>
        <option value="">Selecione o local</option>
        <?php while ($loc = $locadoras_devolucao->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $loc['id_loc'] ?>"><?= htmlspecialchars($loc['rua']) ?> - <?= htmlspecialchars($loc['cidade']) ?></option>
        <?php } ?>
      </select>
    </div>

    <!-- Valores -->
    <div>
      <label for="valor_por_dia">Valor da Diária (R$):</label>
      <input type="number" step="0.01" id="valor_por_dia" name="valor_por_dia" placeholder="Ex.: 150.00" required>
    </div>

    <div>
      <label for="valor_total">Valor Total (R$):</label>
      <input type="number" step="0.01" id="valor_total" name="valor_total" placeholder="Ex.: 450.00" required>
    </div>

    <!-- Status -->
    <div>
      <label for="status">Status:</label>
      <input type="text" id="status" name="status" placeholder="Ex.: Ativa, Finalizada" required>
    </div>

    <!-- Locais texto (se desejar preencher também) -->
    <div>
      <label for="local_retirada_cidade">Descrição Local de Retirada:</label>
      <input type="text" id="local_retirada_cidade" name="local_retirada_cidade" required>
    </div>

    <div>
      <label for="local_entrega">Descrição Local de Entrega:</label>
      <input type="text" id="local_entrega" name="local_entrega" required>
    </div>

  </div>

  <div class="button-group">
    <button type="button" class="btn cancel" onclick="window.history.back()">Cancelar</button>
    <button type="submit" class="btn save">Salvar</button>
  </div>
</form>

<script src="../js/Veiculos.js"></script>

</body>
</html>

