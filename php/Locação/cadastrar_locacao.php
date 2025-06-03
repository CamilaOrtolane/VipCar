<?php
require_once '../../php/Locação/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recebendo os dados do formulário
    $id_cli = $_POST['id_cli'];
    $id_vei = $_POST['id_vei'];
    $data_retirada = $_POST['data_retirada'];
    $data_devolucao = $_POST['data_devolucao'];
    $hora_retirada = $_POST['hora_retirada'];
    $hora_devolucao = $_POST['hora_devolucao'];
    $local_retirada = $_POST['local_retirada'];
    $local_devolucao = $_POST['local_devolucao'];
    $valor_diaria = $_POST['valor_diaria'];
    $valor_total = $_POST['valor_total'];

    try {
        // Preparando o SQL para inserção
        $sql = "INSERT INTO locacao 
            (id_cli, id_vei, data_retirada, data_devolucao, hora_retirada, hora_devolucao, local_retirada, local_devolucao, valor_diaria, valor_total) 
            VALUES 
            (:id_cli, :id_vei, :data_retirada, :data_devolucao, :hora_retirada, :hora_devolucao, :local_retirada, :local_devolucao, :valor_diaria, :valor_total)";

        $stmt = $conn->prepare($sql);

        // Vinculando os parâmetros
        $stmt->bindParam(':id_cli', $id_cli);
        $stmt->bindParam(':id_vei', $id_vei);
        $stmt->bindParam(':data_retirada', $data_retirada);
        $stmt->bindParam(':data_devolucao', $data_devolucao);
        $stmt->bindParam(':hora_retirada', $hora_retirada);
        $stmt->bindParam(':hora_devolucao', $hora_devolucao);
        $stmt->bindParam(':local_retirada', $local_retirada);
        $stmt->bindParam(':local_devolucao', $local_devolucao);
        $stmt->bindParam(':valor_diaria', $valor_diaria);
        $stmt->bindParam(':valor_total', $valor_total);

        // Executando
        if ($stmt->execute()) {
            echo "<script>
                alert('Locação cadastrada com sucesso!');
                window.location.href = '../../html/Tabela_locacao.php';
                </script>";
        } else {
            echo "<script>
                alert('Erro ao cadastrar locação!');
                window.history.back();
                </script>";
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    header("Location: Tabela_locacao.php");
    exit;
}
?>

