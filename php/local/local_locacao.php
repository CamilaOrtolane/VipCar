<?php
class LocalLocadora {
    private $conn;
    private $table = "local_locadora";

    public $id_loc;
    public $cidade;
    public $estado;
    public $cep;
    public $rua;
    public $bairro;
    public $numero;
    public $horario_abertura;
    public $horario_fechamento;

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
                  (cidade, estado, cep, rua, bairro, numero, horario_abertura, horario_fechamento) 
                  VALUES 
                  (:cidade, :estado, :cep, :rua, :bairro, :numero, :horario_abertura, :horario_fechamento)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':rua', $this->rua);
        $stmt->bindParam(':bairro', $this->bairro);
        $stmt->bindParam(':numero', $this->numero);
        $stmt->bindParam(':horario_abertura', $this->horario_abertura);
        $stmt->bindParam(':horario_fechamento', $this->horario_fechamento);
        return $stmt->execute();
    }

    public function editar() {
        $query = "UPDATE " . $this->table . " 
                  SET cidade = :cidade, estado = :estado, cep = :cep, rua = :rua, bairro = :bairro, 
                      numero = :numero, horario_abertura = :horario_abertura, horario_fechamento = :horario_fechamento 
                  WHERE id_loc = :id_loc";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':rua', $this->rua);
        $stmt->bindParam(':bairro', $this->bairro);
        $stmt->bindParam(':numero', $this->numero);
        $stmt->bindParam(':horario_abertura', $this->horario_abertura);
        $stmt->bindParam(':horario_fechamento', $this->horario_fechamento);
        $stmt->bindParam(':id_loc', $this->id_loc);
        return $stmt->execute();
    }

    public function deletar() {
        $query = "DELETE FROM " . $this->table . " WHERE id_loc = :id_loc";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_loc', $this->id_loc);
        return $stmt->execute();
    }

    public function buscarPorId() {
        $query = "SELECT * FROM " . $this->table . " WHERE id_loc = :id_loc LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_loc', $this->id_loc);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
