<?php
class Veiculo {
    private $conn;
    private $table = "veiculo";

    public $id_vei;
    public $nome;
    public $disponibilidade_status;
    public $preco_dia;
    public $capacidade;
    public $bagageiro;
    public $cambio;
    public $imagem;
    public $placa;
    public $ano_fabricacao;
    public $modelo;
    public $chassi;
    public $renavam;
    public $marca;
    public $km_rodados;
    public $ultima_revisao;

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
            (nome, disponibilidade_status, preco_dia, capacidade, bagageiro, cambio, imagem, placa, ano_fabricacao, modelo, chassi, renavam, marca, km_rodados, ultima_revisao)
            VALUES 
            (:nome, :disponibilidade_status, :preco_dia, :capacidade, :bagageiro, :cambio, :imagem, :placa, :ano_fabricacao, :modelo, :chassi, :renavam, :marca, :km_rodados, :ultima_revisao)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':disponibilidade_status', $this->disponibilidade_status);
        $stmt->bindParam(':preco_dia', $this->preco_dia);
        $stmt->bindParam(':capacidade', $this->capacidade);
        $stmt->bindParam(':bagageiro', $this->bagageiro);
        $stmt->bindParam(':cambio', $this->cambio);
        $stmt->bindParam(':imagem', $this->imagem);
        $stmt->bindParam(':placa', $this->placa);
        $stmt->bindParam(':ano_fabricacao', $this->ano_fabricacao);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':chassi', $this->chassi);
        $stmt->bindParam(':renavam', $this->renavam);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':km_rodados', $this->km_rodados);
        $stmt->bindParam(':ultima_revisao', $this->ultima_revisao);
        
        return $stmt->execute();
    }

    public function editar() {
        $query = "UPDATE " . $this->table . "
                  SET nome = :nome, disponibilidade_status = :disponibilidade_status, preco_dia = :preco_dia, capacidade = :capacidade, 
                      bagageiro = :bagageiro, cambio = :cambio, imagem = :imagem, placa = :placa, 
                      ano_fabricacao = :ano_fabricacao, modelo = :modelo, chassi = :chassi, 
                      renavam = :renavam, marca = :marca, km_rodados = :km_rodados, ultima_revisao = :ultima_revisao
                  WHERE id_vei = :id_vei";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':disponibilidade_status', $this->disponibilidade_status);
        $stmt->bindParam(':preco_dia', $this->preco_dia);
        $stmt->bindParam(':capacidade', $this->capacidade);
        $stmt->bindParam(':bagageiro', $this->bagageiro);
        $stmt->bindParam(':cambio', $this->cambio);
        $stmt->bindParam(':imagem', $this->imagem);
        $stmt->bindParam(':placa', $this->placa);
        $stmt->bindParam(':ano_fabricacao', $this->ano_fabricacao);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':chassi', $this->chassi);
        $stmt->bindParam(':renavam', $this->renavam);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':km_rodados', $this->km_rodados);
        $stmt->bindParam(':ultima_revisao', $this->ultima_revisao);
        $stmt->bindParam(':id_vei', $this->id_vei);
        
        return $stmt->execute();
    }

    public function deletar() {
        $query = "DELETE FROM " . $this->table . " WHERE id_vei = :id_vei";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_vei', $this->id_vei);
        return $stmt->execute();
    }

    public function buscarPorId() {
        $query = "SELECT * FROM " . $this->table . " WHERE id_vei = :id_vei LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_vei', $this->id_vei);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
