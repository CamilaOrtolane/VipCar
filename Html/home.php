<?php
session_start();
require_once '../php/Locação/conexao.php';

$nome_usuario = $_SESSION['nome'] ?? null;

$locais = $conn->query("SELECT id_loc, rua, cidade FROM local_locadora")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Style/home.css">
  <script src="../js/Home.js"></script>
</head>
<body>

<header class="topbar">
  <div class="container">
    <img src="../img/logo.png" alt="Logo" class="logo">
    
  </div>
  <nav class="menu">
      <a href="home.php">Início</a>
      <a href="catalogo.php">Catálogo</a>
      <a href="reserva.php">Reservas</a>
      <a href="perfil.php">Perfil</a>

      <?php if ($nome_usuario): ?>
        <span class="usuario-logado">Olá, <?= htmlspecialchars($nome_usuario) ?>!</span>
        <a href="logout.php" class="sair">Sair</a>
      <?php else: ?>
        <a href="login.php" class="entrar">Entrar</a>
      <?php endif; ?>
    </nav>
</header>

<section class="painel">
  <div class="texto">
    <h1>Alugue o Carro <br> ideal para sua <br>jornada</h1>
    <button class="btn-ver-veiculos" onclick="window.location.href='catalogo.php'">Ver veículos disponíveis</button>
  </div>
  <div class="imagem">
    <img src="../img/Onix preto.png" alt="Carro para alugar">
  </div>
</section>

<section class="beneficios">
  <div class="beneficio">
    <img src="../img/miniature_car.png">
    <h3>Variedade <br>de Veículos</h3>
    <p>Encontre o carro<br> perfeito para você</p>
  </div>
  <div class="beneficio">
    <img src="../img/miniature_relogio.png">
    <h3>Aluguel<br> rápido e fácil</h3>
    <p>Processo sem<br> complicações</p>
  </div>
  <div class="beneficio">
    <img src="../img/miniature_dindin.png">
    <h3>Preços <br>acessíveis</h3>
    <p>Tarifas compatíveis<br> para todos</p>
  </div>
  <div class="beneficio">
    <img src="../img/miniature_seguro.png">
    <h3>Seguro<br> incluso</h3>
    <p>Maior proteção <br>para você</p>
  </div>
</section>

<section class="form-aluguel">
  <form action="catalogo.php" method="get">
    <div class="linha-form">
      <div class="campo">
        <label>Local para retirada:</label>
        <select name="id_local_retirada" required>
          <option value="">Selecione o local</option>
          <?php foreach ($locais as $loc) { ?>
            <option value="<?= $loc['id_loc'] ?>">
              <?= htmlspecialchars($loc['rua']) ?> - <?= htmlspecialchars($loc['cidade']) ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="campo">
        <label>Data:</label>
        <input type="date" name="data_retirada" required>
      </div>
      <div class="campo">
        <label>Horário:</label>
        <input type="time" name="hora_retirada" required>
      </div>
    </div>

    <div class="linha-form">
      <div class="campo">
        <label>Local para devolução:</label>
        <select name="id_local_devolucao" required>
          <option value="">Selecione o local</option>
          <?php foreach ($locais as $loc) { ?>
            <option value="<?= $loc['id_loc'] ?>">
              <?= htmlspecialchars($loc['rua']) ?> - <?= htmlspecialchars($loc['cidade']) ?>
            </option>
          <?php } ?>
        </select>
      </div>
      <div class="campo">
        <label>Data:</label>
        <input type="date" name="data_devolucao" required>
      </div>
      <div class="campo">
        <label>Horário:</label>
        <input type="time" name="hora_devolucao" required>
      </div>
    </div>

    <button type="submit" class="btn-continuar">Continuar</button>
  </form>
</section>

</body>
</html>
