<?php
require_once '../../php/Locação/conexao.php';

$clientes = $conn->query("SELECT id_cli, nome FROM cliente");

$veiculos = $conn->query("SELECT id_vei, modelo FROM veiculo");

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

<h2>Realizar Locação</h2>

<form action="../../php/Locação/cadastrar_locacao.php" method="POST">
  <div class="form-grid">

    <div>
      <label for="id_cliente_fk">Cliente:</label>
      <select id="id_cliente_fk" name="id_cliente_fk" required>
        <option value="">Selecione o cliente</option>
        <?php while ($cliente = $clientes->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $cliente['id_cli'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="id_veiculo_fk">Veículo:</label>
      <select id="id_veiculo_fk" name="id_veiculo_fk" required>
        <option value="">Selecione o veículo</option>
        <?php while ($veiculo = $veiculos->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $veiculo['id_vei'] ?>"><?= htmlspecialchars($veiculo['modelo']) ?></option>
        <?php } ?>
      </select>
    </div>

    <div>
      <label for="data_entrada">Data de Retirada:</label>
      <input type="date" id="data_entrada" name="data_entrada" required>
    </div>

    <div>
      <label for="data_saida">Data de Devolução:</label>
      <input type="date" id="data_saida" name="data_saida" required>
    </div>

    <div>
      <label for="horario_entrada">Horário de Retirada:</label>
      <input type="time" id="horario_entrada" name="horario_entrada" required>
    </div>

    <div>
      <label for="horario_saida">Horário de Devolução:</label>
      <input type="time" id="horario_saida" name="horario_saida" required>
    </div>

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

    <div>
      <label for="valor_por_dia">Valor da Diária (R$):</label>
            <input type="text" id="valor_por_dia" name="valor_por_dia" placeholder="R$" value="<?= htmlspecialchars($loc['valor_por_dia']) ?>" required>
    </div>

    <div>
      <label for="valor_total">Valor Total (R$):</label>
      <input type="text" id="valor_total" name="valor_total" placeholder="R$" readonly>
    </div>

    <div>
      <label for="status">Status:</label>
        <select id="status" name="status" required>
          <option value="">Selecione o status</option>
          <option value="Ativa">Ativa</option>
          <option value="Cancelada">Cancelada</option>
          <option value="Finalizada">Finalizada</option>
        </select>
    </div>
   

  </div>


  <div class="button-group">
    <button type="button" class="btn cancel" onclick="window.history.back()">Cancelar</button>
    <button type="submit" class="btn save">Salvar</button>
  </div>
</form>

<script src="../js/Veiculos.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const dataEntrada = document.getElementById("data_entrada");
  const dataSaida = document.getElementById("data_saida");
  const valorDiaria = document.getElementById("valor_por_dia");
  const valorTotal = document.getElementById("valor_total");

  function calcularValorTotal() {
    const entradaStr = dataEntrada.value;
    const saidaStr = dataSaida.value;
    const diariaStr = valorDiaria.value.replace("R$", "").trim().replace(",", ".");
    const diaria = parseFloat(diariaStr);

    if (entradaStr && saidaStr && !isNaN(diaria)) {
      const entrada = new Date(entradaStr);
      const saida = new Date(saidaStr);

      if (!isNaN(entrada) && !isNaN(saida) && saida > entrada) {
        const diffMs = saida - entrada;
        const diffDias = Math.ceil(diffMs / (1000 * 60 * 60 * 24));
        const total = diffDias * diaria;
        valorTotal.value = "R$ " + total.toFixed(2).replace(".", ",");
        return;
      }
    }

    valorTotal.value = "";
  }

  calcularValorTotal();

  dataEntrada.addEventListener("change", calcularValorTotal);
  dataSaida.addEventListener("change", calcularValorTotal);
  valorDiaria.addEventListener("input", calcularValorTotal);
});

</script>

</body>
</html>

