<?php
require_once '../php/Locação/conexao.php';

// Recupera os dados do veículo via GET
$id_veiculo_fk = isset($_GET['id_veiculo_fk']) ? (int) $_GET['id_veiculo_fk'] : null;
$modelo = $_GET['modelo'] ?? '';
$preco = $_GET['preco'] ?? '';
$imagem = $_GET['imagem'] ?? '';


$clientes = $conn->query("SELECT id_cli, nome FROM cliente");
$veiculos = $conn->query("SELECT id_vei, modelo FROM veiculo");
$locadoras_retirada = $conn->query("SELECT id_loc, rua, cidade FROM local_locadora");
$locadoras_devolucao = $conn->query("SELECT id_loc, rua, cidade FROM local_locadora");

if (!$id_veiculo_fk) {
    die('Veículo não especificado.');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Realizar Locação</title>
  <link rel="stylesheet" href="../Style/alugar.css">
  <script src="../js/alugar.js"></script>
</head>
<body>

<header class="topbar">
  <div class="container">
    <img src="../img/logo.png" alt="Logo" class="logo">
    <nav class="menu">
      <a href="home.html">Início</a>
      <a href="catalogo.php">Catálogo</a>
      <a href="reserva.html">Reservas</a>
      <a href="login.html">Perfil</a>
    </nav>
  </div>
</header>

<main class="container2">
  <h1>Realizar Locação</h1>

  <form id="form-locacao" method="post" action="../php/Locação/cadastrar_locacao.php">
    <!-- Veículo (pré-selecionado) -->
    <div class="form-group">
      <label for="id_veiculo_fk">Veículo:</label>
     <select id="id_veiculo_fk" name="id_veiculo_fk" required>
      <option value="">Selecione o veículo</option>
      <?php while ($veiculo = $veiculos->fetch(PDO::FETCH_ASSOC)) { ?>
        <option value="<?= $veiculo['id_vei'] ?>" <?= ((int)$veiculo['id_vei'] === $id_veiculo_fk) ? 'selected' : '' ?>>
          <?= htmlspecialchars($veiculo['modelo']) ?>
        </option>
      <?php } ?>
    </select>

    </div>

    <!-- Imagem do carro -->
    <div class="car-image">
      <img id="carImg" src="<?= htmlspecialchars($imagem) ?>" alt="Carro Selecionado">
    </div>

    <!-- Data de retirada -->
    <div class="form-group">
      <label for="data_saida">Data de Retirada:</label>
      <input type="date" id="data_saida" name="data_saida" required>
    </div>

    <!-- Data de entrega -->
    <div class="form-group">
      <label for="data_entrada">Data de Entrega:</label>
      <input type="date" id="data_entrada" name="data_entrada" required>
    </div>

    <!-- Valor da diária -->
    <div class="form-group">
      <label for="valor_por_dia">Valor da Diária</label>
      <input type="text" id="valor_por_dia" name="valor_por_dia" placeholder="R$" value="<?= htmlspecialchars($preco) ?>" required>
    </div>

    <!-- Valor total -->
    <div class="form-group">
      <label for="valor_total">Valor Total</label>
      <input type="text" id="valor_total" name="valor_total" placeholder="R$" readonly>
    </div>

    <!-- Horário de retirada -->
    <div class="form-group">
      <label for="horario_saida">Horário de Retirada:</label>
      <input type="time" id="horario_saida" name="horario_saida">
    </div>

    <!-- Horário de entrega -->
    <div class="form-group">
      <label for="horario_entrada">Horário de Entrega:</label>
      <input type="time" id="horario_entrada" name="horario_entrada" required>
    </div>

    <!-- Local de retirada -->
    <div class="form-group full">
      <label for="id_local_retirada">Local de Retirada:</label>
      <select id="id_local_retirada" name="id_local_retirada" required>
        <option value="">Selecione o local</option>
        <?php while ($loc = $locadoras_retirada->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $loc['id_loc'] ?>">
            <?= htmlspecialchars($loc['rua']) ?> - <?= htmlspecialchars($loc['cidade']) ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <!-- Local de devolução -->
    <div class="form-group full">
      <label for="id_local_devolucao">Local de Devolução:</label>
      <select id="id_local_devolucao" name="id_local_devolucao" required>
        <option value="">Selecione o local</option>
        <?php while ($loc = $locadoras_devolucao->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?= $loc['id_loc'] ?>">
            <?= htmlspecialchars($loc['rua']) ?> - <?= htmlspecialchars($loc['cidade']) ?>
          </option>
        <?php } ?>
      </select>
    </div>

    <div class="actions">
      <button type="button" class="btn btn-cancelar" onclick="history.back()">Cancelar ✖</button>
      <button type="submit" class="btn save">Salvar</button>
    </div>
  </form>
</main>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const dataEntrada = document.getElementById("data_saida");
  const dataEntrega = document.getElementById("data_entrada");
  const valorDiaria = document.getElementById("valor_por_dia");
  const valorTotal = document.getElementById("valor_total");

  function calcularValorTotal() {
    const entrada = new Date(dataEntrada.value);
    const entrega = new Date(dataEntrega.value);
    const diaria = parseFloat(valorDiaria.value.replace(",", "."));

    if (!isNaN(entrada) && !isNaN(entrega) && !isNaN(diaria)) {
      const diffMs = entrega - entrada;
      const diffDias = Math.ceil(diffMs / (1000 * 60 * 60 * 24));

      if (diffDias > 0) {
        const total = diffDias * diaria;
        valorTotal.value = "R$ " + total.toFixed(2).replace(".", ",");
      } else {
        valorTotal.value = valorDiaria.value;
      }
    }
  }

  // Atualiza valor total quando qualquer campo relevante muda
  dataEntrada.addEventListener("change", calcularValorTotal);
  dataEntrega.addEventListener("change", calcularValorTotal);
  valorDiaria.addEventListener("input", calcularValorTotal);
});
</script>

</body>
</html>

