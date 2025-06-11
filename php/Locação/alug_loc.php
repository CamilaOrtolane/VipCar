<?php
session_start();
require_once 'conexao.php';

// Verifica se o cliente está logado
$id_cliente_logao = $_SESSION['id_cliente'] ?? null;

if (!$id_cliente_logado) {
    die("Usuário não está logado. Faça login para continuar.");
}

try {
    // Coleta os dados do formulário
    $id_veiculo_fk = $_POST['id_veiculo_fk'] ?? null;
    $data_saida = $_POST['data_saida'] ?? null;
    $data_entrada = $_POST['data_entrada'] ?? null;
    $horario_saida = $_POST['horario_saida'] ?? null;
    $horario_entrada = $_POST['horario_entrada'] ?? null;
    $valor_por_dia = str_replace(['R$', ','], ['', '.'], $_POST['valor_por_dia'] ?? '0');
    $valor_total = str_replace(['R$', ','], ['', '.'], $_POST['valor_total'] ?? '0');
    $id_local_retirada = $_POST['id_local_retirada'] ?? null;
    $id_local_devolucao = $_POST['id_local_devolucao'] ?? null;
    $status = $_POST['status'] ?? 'Ativa';

    // Validação básica
    if (!$id_veiculo_fk || !$data_saida || !$data_entrada || !$horario_saida || !$horario_entrada || !$id_local_retirada || !$id_local_devolucao) {
        throw new Exception("Todos os campos obrigatórios devem ser preenchidos.");
    }

    // Prepara e executa a inserção no banco
    $stmt = $conn->prepare("INSERT INTO locacao (
        id_cliente_fk, id_veiculo_fk, data_saida, data_entrada, horario_saida, horario_entrada,
        valor_por_dia, valor_total, id_local_retirada, id_local_devolucao, status
    ) VALUES (
        :id_cliente_fk, :id_veiculo_fk, :data_saida, :data_entrada, :horario_saida, :horario_entrada,
        :valor_por_dia, :valor_total, :id_local_retirada, :id_local_devolucao, :status
    )");

    $stmt->execute([
        ':id_cliente_fk' => $id_cliente,
        ':id_veiculo_fk' => $id_veiculo_fk,
        ':data_saida' => $data_saida,
        ':data_entrada' => $data_entrada,
        ':horario_saida' => $horario_saida,
        ':horario_entrada' => $horario_entrada,
        ':valor_por_dia' => $valor_por_dia,
        ':valor_total' => $valor_total,
        ':id_local_retirada' => $id_local_retirada,
        ':id_local_devolucao' => $id_local_devolucao,
        ':status' => $status
    ]);

    // Redireciona após o sucesso
    header("Location: ../../Html/reserva.html?sucesso=1");
    exit;

} catch (Exception $e) {
    // Em caso de erro, exibe a mensagem
    echo "Erro ao realizar locação: " . $e->getMessage();
}
?>
