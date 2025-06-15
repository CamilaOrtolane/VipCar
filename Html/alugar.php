<?php
ini_set('session.cookie_path', '/');
session_start();

echo "Sessão ID: " . session_id() . "<br>";
echo "ID do cliente: " . ($_SESSION['id_cliente'] ?? 'NÃO LOGADO');

require_once '../php/Locação/conexao.php';
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id_cliente_logado = $_SESSION['usuario_id'] ?? null;

if (!$id_cliente_logado) {
    die("Usuário não está logado. Faça login para continuar.");
}


$id_veiculo_fk = isset($_GET['id_veiculo_fk']) ? (int) $_GET['id_veiculo_fk'] : null;
$modelo = $_GET['modelo'] ?? '';
$preco = $_GET['preco'] ?? '';
$imagem = $_GET['imagem'] ?? '';


$clientes = $conn->query("SELECT id_cli, nome FROM cliente");
$veiculos = $conn->query("SELECT id_vei, modelo FROM veiculo");
$locais = $conn->query("SELECT id_loc, rua, cidade FROM local_locadora")->fetchAll(PDO::FETCH_ASSOC);
$idLocalRetirada = $_GET['id_local_retirada'] ?? '';
$idLocalDevolucao = $_GET['id_local_devolucao'] ?? '';


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
      <a href="home.php">Início</a>
      <a href="catalogo.php">Catálogo</a>
      <a href="reserva.php">Reservas</a>
      <a href="login.php">Perfil</a>
    </nav>
  </div>
</header>

<main class="container2">
  <h1>Realizar Locação</h1>

  <form id="form-locacao" method="post" action="../php/Locação/alugar_loc.php">
    <input type="hidden" name="id_cliente_fk" value="<?= $id_cliente_logado ?>">

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

  
    <div class="car-image">
      <img id="carImg" src="<?= htmlspecialchars($imagem) ?>" alt="Carro Selecionado">
    </div>


    <div class="form-group">
      <label for="data_saida">Data de Retirada:</label>
      <input type="date" id="data_saida" name="data_saida" value="<?= $_GET['data_retirada'] ?? '' ?>" required>
    </div>


    <div class="form-group">
      <label for="data_entrada">Data de Entrega:</label>
      <input type="date" id="data_entrada" name="data_entrada" value="<?= $_GET['data_devolucao'] ?? '' ?>"  required>
    </div>


    <div class="form-group">
      <label for="valor_por_dia">Valor da Diária</label>
      <input type="text" id="valor_por_dia" name="valor_por_dia" placeholder="R$" value="<?= htmlspecialchars($preco) ?>" required>
    </div>


    <div class="form-group">
      <label for="valor_total">Valor Total</label>
      <input type="text" id="valor_total" name="valor_total" placeholder="R$" readonly>
    </div>


    <div class="form-group">
      <label for="horario_saida">Horário de Retirada:</label>
      <input type="time" id="horario_saida" name="horario_saida" value="<?= $_GET['hora_retirada'] ?? '' ?>" required>
    </div>

    <div class="form-group">
      <label for="horario_entrada">Horário de Entrega:</label>
      <input type="time" id="horario_entrada" name="horario_entrada" value="<?= $_GET['hora_devolucao'] ?? '' ?>" required>
    </div>
    
    <select id="id_local_retirada" name="id_local_retirada" required>
      <option value="">Selecione o local</option>
      <?php foreach ($locais as $loc) { ?>
        <option value="<?= $loc['id_loc'] ?>" <?= ($loc['id_loc'] == ($_GET['id_local_retirada'] ?? '')) ? 'selected' : '' ?>>
          <?= htmlspecialchars($loc['rua'] . ' - ' . $loc['cidade']) ?>
        </option>
      <?php } ?>
    </select>

    
    <select id="id_local_devolucao" name="id_local_devolucao" required>
      <option value="">Selecione o local</option>
      <?php foreach ($locais as $loc) { ?>
        <option value="<?= $loc['id_loc'] ?>" <?= ($loc['id_loc'] == ($_GET['id_local_devolucao'] ?? '')) ? 'selected' : '' ?>>
          <?= htmlspecialchars($loc['rua'] . ' - ' . $loc['cidade']) ?>
        </option>
      <?php } ?>
    </select>

    <div class="actions">
      <button type="button" class="btn btn-cancelar" onclick="history.back()">Cancelar ✖</button>
      <button type="submit" class="btn save">Salvar</button>
    </div>

    <input type="hidden" name="status" value="Ativa">

  </form>
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const dataSaida = document.getElementById("data_saida");
  const dataEntrada = document.getElementById("data_entrada");
  const valorDiaria = document.getElementById("valor_por_dia");
  const valorTotal = document.getElementById("valor_total");

  function calcularValorTotal() {
    const data1 = dataSaida.value;
    const data2 = dataEntrada.value;
    const diariaStr = valorDiaria.value.replace("R$", "").trim().replace(",", ".");
    const diaria = parseFloat(diariaStr);

    if (data1 && data2 && !isNaN(diaria)) {
      const d1 = new Date(data1);
      const d2 = new Date(data2);

      if (!isNaN(d1) && !isNaN(d2) && d2 > d1) {
        const diffMs = d2 - d1;
        const diffDias = Math.ceil(diffMs / (1000 * 60 * 60 * 24));
        const total = diffDias * diaria;
        valorTotal.value = "R$ " + total.toFixed(2).replace(".", ",");
        return;
      }
    }

    valorTotal.value = ""; 
  }

  calcularValorTotal();

  dataSaida.addEventListener("change", calcularValorTotal);
  dataEntrada.addEventListener("change", calcularValorTotal);
  valorDiaria.addEventListener("input", calcularValorTotal);
});
</script>


</body>
</html>

