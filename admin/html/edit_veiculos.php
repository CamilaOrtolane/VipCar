<?php
require_once '../../php/config/Database.php';
require_once '../../php/Veiculos/Veiculos.php';

$id = $_GET['id_vei'] ?? null;

if (!$id) {
    die("ID do veículo não informado na URL.");
}

$db = (new Database())->getConnection();
$veiculo = new Veiculo($db);

$veiculo->id_vei = $id;
$dados = $veiculo->buscarPorId();

if (!$dados) {
    die("Veículo não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Veículo</title>
  <link rel="stylesheet" href="../Style/Cadastrar_cliente.css">
  <script src="../js/home adm.js"></script>
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
    <li><a href="Tabela_clientes.php">Consultar Clientes</a></li>
    <li><a href="Tabela_veiculos.php">Consultar Veículos</a></li>
    <li><a href="tabela_locacao.html">Consultar Locações</a></li>
    <li><a href="tabela_Local.html">Consultar Locadoras</a></li>
    <li><a href="Catalogo_adm.html">Catálogo</a></li>
  </ul>
</aside>

<div class="overlay" id="overlay"></div>
<h1><b>Editar Veículo</b></h1>
<div class="container">
  <form action="../../php/Veiculos/editar_veiculo.php" method="post" class="Cadastro">
    <input type="hidden" name="id_vei" value="<?= $dados['id_vei'] ?? '' ?>">

    <div class="form-group">
      <label>Nome:</label>
      <input type="text" name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" required />
    </div>
    <div class="form-group">
      <label>Status de Disponibilidade:</label>
      <input type="text" name="disponibilidade_status" value="<?= htmlspecialchars($dados['disponibilidade_status']) ?>" required />
    </div>
    <div class="form-group">
      <label>Capacidade:</label>
      <input type="number" name="capacidade" value="<?= htmlspecialchars($dados['capacidade']) ?>" required />
    </div>
    <div class="form-group">
      <label>Bagageiro:</label>
      <input type="text" name="bagageiro" value="<?= htmlspecialchars($dados['bagageiro']) ?>" required />
    </div>
    <div class="form-group">
      <label>Câmbio:</label>
      <input type="text" name="cambio" value="<?= htmlspecialchars($dados['cambio']) ?>" required />
    </div>
    <div class="form-group">
      <label>Imagem (URL):</label>
      <input type="text" name="imagem" value="<?= htmlspecialchars($dados['imagem']) ?>" required />
    </div>
    <div class="form-group">
      <label>Placa:</label>
      <input type="text" name="placa" value="<?= htmlspecialchars($dados['placa']) ?>" required />
    </div>
    <div class="form-group">
      <label>Ano de Fabricação:</label>
      <input type="number" name="ano_fabricacao" value="<?= htmlspecialchars($dados['ano_fabricacao']) ?>" required />
    </div>
    <div class="form-group">
      <label>Modelo:</label>
      <input type="text" name="modelo" value="<?= htmlspecialchars($dados['modelo']) ?>" required />
    </div>
    <div class="form-group">
      <label>Chassi:</label>
      <input type="text" name="chassi" value="<?= htmlspecialchars($dados['chassi']) ?>" required />
    </div>
    <div class="form-group">
      <label>RENAVAM:</label>
      <input type="text" name="renavam" value="<?= htmlspecialchars($dados['renavam']) ?>" required />
    </div>
    <div class="form-group">
      <label>Marca:</label>
      <input type="text" name="marca" value="<?= htmlspecialchars($dados['marca']) ?>" required />
    </div>
    <div class="form-group">
      <label>KM Rodados:</label>
      <input type="number" name="km_rodados" value="<?= htmlspecialchars($dados['km_rodados']) ?>" required />
    </div>
    <div class="form-group">
      <label>Última Revisão:</label>
      <input type="date" name="ultima_revisao" value="<?= htmlspecialchars($dados['ultima_revisao']) ?>" required />
    </div>

    <div class="form-group-full botoes">
      <a href="Tabela_veiculos.php"><button type="button" class="btn cancelar">Cancelar</button></a>
      <button type="submit" class="btn entrar">Salvar</button>
    </div>
  </form>
</div>
</body>
</html>