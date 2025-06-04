<?php
class Locacao {
    private $conn;
    private $table = "locacao";

    public $id;
    public $data_entrada;
    public $data_saida;
    public $horario_entrada;
    public $horario_saida;
    public $valor_por_dia;
    public $valor_total;
    public $local_retirada_cidade;
    public $local_entrega;
    public $status;
    public $id_cliente_fk;
    public $id_veiculo_fk;
    public $id_local_retirada;
    public $id_local_devolucao;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function criar() {
        $query = "INSERT INTO " . $this->table . " 
            (data_entrada, data_saida, horario_entrada, horario_saida, valor_por_dia, valor_total, 
            local_retirada_cidade, local_entrega, status, id_cliente_fk, id_veiculo_fk, 
            id_local_retirada, id_local_devolucao) 
            VALUES 
            (:data_entrada, :data_saida, :horario_entrada, :horario_saida, :valor_por_dia, :valor_total, 
            :local_retirada_cidade, :local_entrega, :status, :id_cliente_fk, :id_veiculo_fk, 
            :id_local_retirada, :id_local_devolucao)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':data_entrada', $this->data_entrada);
        $stmt->bindParam(':data_saida', $this->data_saida);
        $stmt->bindParam(':horario_entrada', $this->horario_entrada);
        $stmt->bindParam(':horario_saida', $this->horario_saida);
        $stmt->bindParam(':valor_por_dia', $this->valor_por_dia);
        $stmt->bindParam(':valor_total', $this->valor_total);
        $stmt->bindParam(':local_retirada_cidade', $this->local_retirada_cidade);
        $stmt->bindParam(':local_entrega', $this->local_entrega);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id_cliente_fk', $this->id_cliente_fk);
        $stmt->bindParam(':id_veiculo_fk', $this->id_veiculo_fk);
        $stmt->bindParam(':id_local_retirada', $this->id_local_retirada);
        $stmt->bindParam(':id_local_devolucao', $this->id_local_devolucao);

        return $stmt->execute();
    }

    public function editar() {
        $query = "UPDATE " . $this->table . " SET 
            data_entrada = :data_entrada,
            data_saida = :data_saida,
            horario_entrada = :horario_entrada,
            horario_saida = :horario_saida,
            valor_por_dia = :valor_por_dia,
            valor_total = :valor_total,
            local_retirada_cidade = :local_retirada_cidade,
            local_entrega = :local_entrega,
            status = :status,
            id_cliente_fk = :id_cliente_fk,
            id_veiculo_fk = :id_veiculo_fk,
            id_local_retirada = :id_local_retirada,
            id_local_devolucao = :id_local_devolucao
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':data_entrada', $this->data_entrada);
        $stmt->bindParam(':data_saida', $this->data_saida);
        $stmt->bindParam(':horario_entrada', $this->horario_entrada);
        $stmt->bindParam(':horario_saida', $this->horario_saida);
        $stmt->bindParam(':valor_por_dia', $this->valor_por_dia);
        $stmt->bindParam(':valor_total', $this->valor_total);
        $stmt->bindParam(':local_retirada_cidade', $this->local_retirada_cidade);
        $stmt->bindParam(':local_entrega', $this->local_entrega);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id_cliente_fk', $this->id_cliente_fk);
        $stmt->bindParam(':id_veiculo_fk', $this->id_veiculo_fk);
        $stmt->bindParam(':id_local_retirada', $this->id_local_retirada);
        $stmt->bindParam(':id_local_devolucao', $this->id_local_devolucao);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function deletar() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function buscarPorId() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
