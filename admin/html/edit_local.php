<?php
require_once '../../php/config/Database.php';
require_once '../../php/local/local_locacao.php';

$id = $_GET['id_loc'] ?? null;

if (!$id) {
    die("ID do local não informado na URL.");
}

$db = (new Database())->getConnection();
$local = new LocalLocadora($db);

$local->id_loc = $id;
$dados = $local->buscarPorId();

if (!$dados) {
    die("Local não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Local</title>
  <link rel="stylesheet" href="../Style/edit_local.css">
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
      <li><a href="../../admin/html/Tabela_clientes.php">Consultar Clientes</a></li>
      <li><a href="../../admin/html/Tabela_Veiculos.php">Consultar Veículos</a></li>
      <li><a href="../../admin/html/Tabela_locacao.php">Consultar Locações</a></li>
      <li><a href="../../admin/html/Tabela_Local.php">Consultar Locadoras</a></li>
      <li><a href="../../admin/html/Catalogo_adm.html">Catálogo</a></li>
    </ul>
  </aside>

  <div class="overlay" id="overlay"></div>

  <h2>Editar Local</h2>
  <form action="../../php/Local/editar_local.php" method="post">
    <div class="form-grid">
      <input type="hidden" name="id_loc" value="<?= $dados['id_loc'] ?>">
      <div>
        <label for="logradouro">Logradouro:</label>
        <input type="text" id="rua" name="rua" value="<?= htmlspecialchars($dados['rua']) ?>" required>
      </div>
      <div>
        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" value="<?= htmlspecialchars($dados['bairro']) ?>" required>
      </div>
      <div>
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($dados['cep']) ?>" required>
      </div>
      <div>
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($dados['cidade']) ?>" required>
      </div>
      <div>
        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($dados['estado']) ?>" required>
      </div>
      <div>
        <label for="abertura">Horário de abertura:</label>
        <input type="time" id="horario_abertura" name="horario_abertura" value="<?= htmlspecialchars($dados['horario_abertura']) ?>" required>
      </div>
      <div>
        <label for="fechamento">Horário de fechamento:</label>
        <input type="time" id="horario_fechamento" name="horario_fechamento" value="<?= htmlspecialchars($dados['horario_fechamento']) ?>" required>
      </div>
    </div>

    <div class="button-group">
      <a href="tabela Local.html"><button type="button" class="btn cancel">Cancelar</button></a>
      <button type="submit" class="btn save">Salvar</button>
    </div>
  </form>

  <script src="../js/Veiculos.js"></script>
</body>
</html>

