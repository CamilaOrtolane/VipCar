<?php
require_once '../../php/Locação/conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $cpf = trim($_POST['cpf']);
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = trim($_POST['telefone']);
    $cnh = trim($_POST['cnh']);
    $rua = trim($_POST['rua']);
    $bairro = trim($_POST['bairro']);
    $cep = trim($_POST['cep']);
    $cidade = trim($_POST['cidade']);
    $estado = strtoupper(trim($_POST['estado']));
    $email = strtolower(trim($_POST['email']));
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($senha !== $confirmar_senha) {
        die("Erro: As senhas não coincidem.");
    }

    $stmt = $conn->prepare("SELECT id_cli FROM cliente WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->fetch()) {
        die("Erro: Este e-mail já está cadastrado.");
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO cliente (
        nome, cpf, data_nascimento, telefone, cnh,
        rua, bairro, cep, cidade, estado,
        email, senha
    ) VALUES (
        :nome, :cpf, :data_nascimento, :telefone, :cnh,
        :rua, :bairro, :cep, :cidade, :estado,
        :email, :senha
    )";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':cnh', $cnh);
    $stmt->bindParam(':rua', $rua);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha_hash);

    try {
        $stmt->execute();
        header("Location: ../../paginas/login.php?cadastro=sucesso");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
} else {
    echo "Método de requisição inválido.";
}
