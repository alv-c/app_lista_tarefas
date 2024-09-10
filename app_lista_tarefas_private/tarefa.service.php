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
            
        }

        public function atualizar() {
            
        }
        
        public function remover() {
            
        }
    }
?>