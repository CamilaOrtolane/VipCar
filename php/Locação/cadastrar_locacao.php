<?php
require_once 'conexao.php'; 
require_once 'Locacao.php'; 

require_once('../../php/config/Database.php');

$db = (new Database())->getConnection();


try {
    $locacao = new Locacao($conn);

    $locacao->data_entrada = $_POST['data_entrada'];
    $locacao->data_saida = $_POST['data_saida'];
    $locacao->horario_entrada = $_POST['horario_entrada'];
    $locacao->horario_saida = $_POST['horario_saida'];
    $locacao->valor_por_dia = floatval(str_replace(',', '.', str_replace('R$', '', $_POST['valor_por_dia'] ?? '0')));
    $locacao->status = $_POST['status'] ?? 'Ativa';
    $locacao->id_cliente_fk = $_POST['id_cliente_fk'] ?? null;
    $locacao->id_veiculo_fk = $_POST['id_veiculo_fk'];
    $locacao->id_local_retirada = $_POST['id_local_retirada'];
    $locacao->id_local_devolucao = $_POST['id_local_devolucao'];

    $valor_total_br = $_POST['valor_total'] ?? '0';
    $valor_total = floatval(str_replace(',', '.', str_replace('R$', '', $valor_total_br)));
    $locacao->valor_total = $valor_total;


    if($locacao->criar()) {
        echo "<script>alert('Locação cadastrada com sucesso!'); window.location.href='../../admin/html/Tabela_locacao.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar locação.'); window.history.back();</script>";
    }

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>

