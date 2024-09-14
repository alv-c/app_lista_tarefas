<?php
    class TarefaService {
        private $tarefa = null;
        private $conexao = null;

        public function __construct (Tarefa $tarefa, Conexao $conexao) {
            $this->tarefa = $tarefa;
            $this->conexao = $conexao->conectar();
        }
        
        public function inserir() {
            $query = "INSERT INTO tb_tarefas (tarefa) VALUES (:tarefa)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $stmt->execute();
        }

        public function recuperar() {
            $query = "SELECT TAREFAS.id, TAREFAS.tarefa, STATUS.status FROM tb_tarefas AS TAREFAS LEFT JOIN tb_status AS STATUS ON (STATUS.id = TAREFAS.id_status)";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function atualizar() {
            $query = "UPDATE tb_tarefas SET tarefa = :tarefa WHERE id = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $this->tarefa->__get('id'));
            $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            return $stmt->execute();
        }
        
        public function remover() {
            
        }
    }
?>