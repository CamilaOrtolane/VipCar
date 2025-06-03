<?php
require_once '../../php/Locação/conexao.php';

// Buscar clientes
$clientes = $conn->query("SELECT id_cli, nome FROM cliente");

// Buscar veículos
$veiculos = $conn->query("SELECT id_vei, modelo FROM veiculo");

// Buscar locadoras
$locadoras = $conn->query("SELECT id_loc, rua, cidade FROM local_locadora");
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
      <label for="id_cli">Cliente:</label>
      <select id="id_cli" name="id_cli" required>
        <option value="">Selecione o cliente</option>
        <?php while ($cliente = $clientes->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $cliente['id_cli'] ?>"><?= $cliente['nome'] ?></option>
        <?php } ?>
      </select>
    </div>

    <!-- Veículo -->
    <div>
      <label for="id_vei">Veículo:</label>
      <select id="id_vei" name="id_vei" required>
        <option value="">Selecione o veículo</option>
        <?php while ($veiculo = $veiculos->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $veiculo['id_vei'] ?>"><?= $veiculo['modelo'] ?></option>
        <?php } ?>
      </select>
    </div>

    <!-- Datas -->
    <div>
      <label for="data_retirada">Data de Retirada:</label>
      <input type="date" id="data_retirada" name="data_retirada" required>
    </div>

    <div>
      <label for="data_devolucao">Data de Devolução:</label>
      <input type="date" id="data_devolucao" name="data_devolucao" required>
    </div>

    <!-- Horários -->
    <div>
      <label for="hora_retirada">Horário de Retirada:</label>
      <input type="time" id="hora_retirada" name="hora_retirada" required>
    </div>

    <div>
      <label for="hora_devolucao">Horário de Devolução:</label>
      <input type="time" id="hora_devolucao" name="hora_devolucao" required>
    </div>

    <!-- Local de Retirada -->
    <div>
      <label for="id_local_retirada">Local de Retirada:</label>
      <select id="id_local_retirada" name="id_local_retirada" required>
        <option value="">Selecione o local</option>
        <?php
        // Resetar o ponteiro dos dados da locadora
        $locadoras->execute();
        while ($loc = $locadoras->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $loc['id_loc'] ?>"><?= $loc['rua'] ?> - <?= $loc['cidade'] ?></option>
        <?php } ?>
      </select>
    </div>

    <!-- Local de Devolução -->
    <div>
      <label for="id_local_devolucao">Local de Devolução:</label>
      <select id="id_local_devolucao" name="id_local_devolucao" required>
        <option value="">Selecione o local</option>
        <?php
        $locadoras->execute();
        while ($loc = $locadoras->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $loc['id_loc'] ?>"><?= $loc['rua'] ?> - <?= $loc['cidade'] ?></option>
        <?php } ?>
      </select>
    </div>

    <!-- Valores -->
    <div>
      <label for="valor_diaria">Valor da Diária (R$):</label>
      <input type="number" step="0.01" id="valor_diaria" name="valor_diaria" placeholder="Ex.: 150.00" required>
    </div>

    <div>
      <label for="valor_total">Valor Total (R$):</label>
      <input type="number" step="0.01" id="valor_total" name="valor_total" placeholder="Ex.: 450.00" required>
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


