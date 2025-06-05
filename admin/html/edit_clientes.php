<?php
require_once '../../php/config/Database.php';
require_once '../../php/Cliente/Cliente.php';

$id = $_GET['id_cli'] ?? null;

if (!$id) {
    die("ID do cliente não informado na URL.");
}

$db = (new Database())->getConnection();
$cliente = new Cliente($db);

$cliente->id_cli = $id;
$dados = $cliente->buscarPorId();

if (!$dados) {
    die("Cliente não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar cliente</title>
  <link rel="stylesheet" href="../Style/Cadastrar_cliente.css">
  <script src="../js/home adm.js"></script>
</head>
<body>
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
    <li><a href="Tabela clientes.html">Consultar Clientes</a></li>
    <li><a href="Tabela Veiculos.html">Consultar Veículos</a></li>
    <li><a href="tabela locação.html">Consultar Locações</a></li>
    <li><a href="tabela Local.html">Consultar Locadoras</a></li>
    <li><a href="Catalogo adm.html">Catálogo</a></li>
  </ul>
</aside>
<div class="overlay" id="overlay"></div>
<h1><b>Editar Cliente</b></h1>
<div class="container">
  <form action="../../php/Cliente/editar_cliente.php" method="post" class="Cadastro">
          <div class="form-group">
            <input type="hidden" name="id_cli" value="<?= $dados['id_cli'] ?? '' ?>">
            <label>Nome:</label>
            <input type="text" placeholder="Digite aqui..." name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" required/>
          </div>
          <div class="form-group">
            <label>CPF:</label>
            <input type="text" placeholder="Digite aqui..." name="cpf" value="<?= htmlspecialchars($dados['cpf']) ?>" required/>
          </div>
              <div class="invi"></div>
          <div class="form-group">
            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="<?= htmlspecialchars($dados['data_nascimento']) ?>" required/>
          </div>
          <div class="form-group">
            <label>Telefone:</label>
            <input type="tel" placeholder="Digite aqui..." name="telefone" value="<?= htmlspecialchars($dados['telefone']) ?>" required/>
          </div>
          <div class="form-group">
            <label>CNH:</label>
            <input type="text" placeholder="Digite aqui..." name="cnh" value="<?= htmlspecialchars($dados['cnh']) ?>" required/>
          </div>
            <div class="invi"></div>
          <div class="form-group">
            <label class=>Logradouro:</label> 
            <input type="text" placeholder="Digite aqui..." name="rua" value="<?= htmlspecialchars($dados['rua']) ?>" required/>
          </div>
          <div class="form-group">
            <label>Bairro:</label>
            <input type="text" placeholder="Digite aqui..." name="bairro" value="<?= htmlspecialchars($dados['bairro']) ?>" required/>
            
          </div>
              <div class="invi"></div>
          <div class="form-group">
            <label>CEP:</label>
            <input type="text" placeholder="Digite aqui..." name="cep" value="<?= htmlspecialchars($dados['cep']) ?>" required/>
          </div>
          <div class="form-group">
            <label>Cidade:</label>
            <input type="text" placeholder="Digite aqui..." name="cidade" value="<?= htmlspecialchars($dados['cidade']) ?>" required/>
          </div>
          <div class="form-group">
            <label>Estado:</label>
            <input type="text" placeholder="Digite aqui..." name="estado" value="<?= htmlspecialchars($dados['estado']) ?>" required/>
          </div>
          <div class="invi"></div>
          <div class="form-group">
            <label>Email:</label>
            <input type="email" placeholder="Digite aqui..." name="email" value="<?= htmlspecialchars($dados['email']) ?>" required/>
          </div>
          <div class="invi"></div>
          <div class="form-group-full botoes">
            <a href="Tabela_clientes.php"><button type="button" class="btn cancelar">Cancelar</button></a>
            
            <button type="submit" class="btn entrar">Salvar</button>
        </form>

</body>
</html>