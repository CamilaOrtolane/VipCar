<?php
require_once '../config/Database.php';
require_once 'Veiculos.php';

if ($_POST && isset($_FILES['imagem'])) {
    $db = (new Database())->getConnection();
    $veiculo = new Veiculo($db);

    $targetDir = "../uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["imagem"]["name"]);
    $targetFile = $targetDir . time() . "_" . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    // Verifica se o arquivo é uma imagem
    $check = getimagesize($_FILES["imagem"]["tmp_name"]);
    if ($check !== false && in_array($imageFileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $targetFile)) {
            
            $veiculo->nome = $_POST['nome'];
            $veiculo->disponibilidade_status = $_POST['disponibilidade_status'];
            $veiculo->preco_dia = $_POST['preco_dia'];
            $veiculo->capacidade = $_POST['capacidade'];
            $veiculo->bagageiro = $_POST['bagageiro'];
            $veiculo->cambio = $_POST['cambio'];
            $veiculo->imagem = $targetFile; 
            $veiculo->placa = $_POST['placa'];
            $veiculo->ano_fabricacao = $_POST['ano_fabricacao'];
            $veiculo->modelo = $_POST['modelo'];
            $veiculo->chassi = $_POST['chassi'];
            $veiculo->renavam = $_POST['renavam'];
            $veiculo->marca = $_POST['marca'];
            $veiculo->km_rodados = $_POST['km_rodados'];
            $veiculo->ultima_revisao = $_POST['ultima_revisao'];

            if ($veiculo->criar()) {
                header("Location: lista_veiculos.php");
                exit;
            } else {
                echo "Erro ao salvar no banco de dados.";
            }
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } else {
        echo "Arquivo inválido. Apenas imagens JPG, PNG, GIF, WEBP são permitidas.";
    }
} else {
    echo "Formulário ou imagem inválidos.";
}
?>
