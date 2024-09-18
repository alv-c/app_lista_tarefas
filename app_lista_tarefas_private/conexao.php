<?php
    class Conexao {
        private $host = 'localhost';
        private $dbname = 'lista_tarefas_db';
        private $user = 'root';
        private $senha = 'alvaro01021998';
        
        public function conectar() {
            try {
                $conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->senha);

                return $conexao;
            } catch (Exception $e) {
                echo '<p>' . $e->getMessage() . '</p>';
            }
        }
    }
?>