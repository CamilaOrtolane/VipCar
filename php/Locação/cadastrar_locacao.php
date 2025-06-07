<?php
require_once 'conexao.php'; // Conexão com o banco
require_once 'Locacao.php'; // Classe Locacao

require_once('../../php/config/Database.php');

$db = (new Database())->getConnection();


try {
    // Instanciar a classe Locacao
    $locacao = new Locacao($conn);

    // Capturar dados do formulário
    $locacao->data_entrada = $_POST['data_entrada'];
    $locacao->data_saida = $_POST['data_saida'];
    $locacao->horario_entrada = $_POST['horario_entrada'];
    $locacao->horario_saida = $_POST['horario_saida'];
    $locacao->valor_por_dia = $_POST['valor_por_dia'];
    $locacao->valor_total = $_POST['valor_total'];
    $locacao->status = $_POST['status'];
    $locacao->id_cliente_fk = $_POST['id_cliente_fk'];
    $locacao->id_veiculo_fk = $_POST['id_veiculo_fk'];
    $locacao->id_local_retirada = $_POST['id_local_retirada'];
    $locacao->id_local_devolucao = $_POST['id_local_devolucao'];

    // Tentar cadastrar
    if($locacao->criar()) {
        echo "<script>alert('Locação cadastrada com sucesso!'); window.location.href='../../admin/html/Tabela_locacao.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar locação.'); window.history.back();</script>";
    }

} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>

