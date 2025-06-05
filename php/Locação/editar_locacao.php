<?php
require_once '../../php/Locação/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $sql = "UPDATE locacao SET 
        id_cliente_fk = :id_cliente_fk,
        id_veiculo_fk = :id_veiculo_fk,
        data_entrada = :data_entrada,
        data_saida = :data_saida,
        horario_entrada = :horario_entrada,
        horario_saida = :horario_saida,
        id_local_retirada = :id_local_retirada,
        id_local_devolucao = :id_local_devolucao,
        valor_por_dia = :valor_por_dia,
        valor_total = :valor_total,
        status = :status,
        local_retirada_cidade = :local_retirada_cidade,
        local_entrega = :local_entrega
        WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id_cliente_fk' => $_POST['id_cliente_fk'],
        ':id_veiculo_fk' => $_POST['id_veiculo_fk'],
        ':data_entrada' => $_POST['data_entrada'],
        ':data_saida' => $_POST['data_saida'],
        ':horario_entrada' => $_POST['horario_entrada'],
        ':horario_saida' => $_POST['horario_saida'],
        ':id_local_retirada' => $_POST['id_local_retirada'],
        ':id_local_devolucao' => $_POST['id_local_devolucao'],
        ':valor_por_dia' => $_POST['valor_por_dia'],
        ':valor_total' => $_POST['valor_total'],
        ':status' => $_POST['status'],
        ':local_retirada_cidade' => $_POST['local_retirada_cidade'],
        ':local_entrega' => $_POST['local_entrega'],
        ':id' => $id
    ]);

    header("Location: ../../admin/html/Tabela_locacao.php");
    exit;
} else {
    echo "Método não permitido.";
}
?>
