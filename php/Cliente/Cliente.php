<?php
class Cliente {
    private $conn;
    private $table = "cliente";

    public $id_cli;
    public $nome;
    public $cpf;
    public $email;
    public $telefone;
    public $rua;
    public $bairro;
    public $cep;
    public $cidade;
    public $estado;
    public $data_nascimento;
    public $cnh;
    public $senha;
    

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
        (nome, cpf, telefone, email, rua, bairro, cep, cidade, estado, data_nascimento, cnh, senha)
        VALUES 
        (:nome, :cpf, :telefone, :email, :rua, :bairro, :cep, :cidade, :estado, :data_nascimento, :cnh, :senha)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':rua', $this->rua);
        $stmt->bindParam(':bairro', $this->bairro);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':cnh', $this->cnh);
        $stmt->bindParam(':senha', $this->senha);

        return $stmt->execute();
    }

    public function editar() {
        $query = "UPDATE " . $this->table . "
                  SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email, rua = :rua, bairro = :bairro, cep = :cep, cidade = :cidade, estado = :estado, data_nascimento = :data_nascimento, cnh = :cnh 
                  WHERE id_cli = :id_cli";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':rua', $this->rua);
        $stmt->bindParam(':bairro', $this->bairro);
        $stmt->bindParam(':cep', $this->cep);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':data_nascimento', $this->data_nascimento);
        $stmt->bindParam(':cnh', $this->cnh);
        $stmt->bindParam(':id_cli', $this->id_cli);
        return $stmt->execute();
    }

    public function deletar() {
        $query = "DELETE FROM " . $this->table . " WHERE id_cli = :id_cli";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cli', $this->id_cli);
        return $stmt->execute();
    }

    public function buscarPorId() {
        $query = "SELECT * FROM " . $this->table . " WHERE id_cli = :id_cli LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cli', $this->id_cli);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
