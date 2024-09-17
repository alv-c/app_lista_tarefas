<?php
class TarefaService
{
    private $tarefa = null;
    private $conexao = null;

    public function __construct(Tarefa $tarefa, Conexao $conexao)
    {
        $this->tarefa = $tarefa;
        $this->conexao = $conexao->conectar();
    }

    public function inserir()
    {
        $query = "INSERT INTO tb_tarefas (tarefa) VALUES (:tarefa)";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }

    public function recuperar()
    {
        $query = "SELECT TAREFAS.id, TAREFAS.tarefa, STATUS.status FROM tb_tarefas AS TAREFAS LEFT JOIN tb_status AS STATUS ON (STATUS.id = TAREFAS.id_status)";
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizar()
    {
        $query = "UPDATE tb_tarefas SET tarefa = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
        return $stmt->execute();
    }

    public function remover()
    {
        $query = "DELETE FROM tb_tarefas WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }

    public function marcar_realizado()
    {
        $query = "UPDATE tb_tarefas SET id_status = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('id_status'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        return $stmt->execute();
    }

    public function recuperar_pendetes()
    {
        $query = "SELECT TAREFAS.id, TAREFAS.tarefa, STATUS.status FROM tb_tarefas AS TAREFAS LEFT JOIN tb_status AS STATUS ON (STATUS.id = TAREFAS.id_status) WHERE TAREFAS.id = ?";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('id_status'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
