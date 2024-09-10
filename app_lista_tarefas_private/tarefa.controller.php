<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/app_lista_tarefas_private/tarefa.model.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/app_lista_tarefas_private/tarefa.service.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/app_lista_tarefas_private/conexao.php';

$conexao = new Conexao();
$tarefa = new Tarefa();
$tarefaService = new TarefaService($tarefa, $conexao);
$acao = (isset($_GET['acao'])) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $tarefa->__set('tarefa', $_POST['tarefa']);
    $tarefaService->inserir();
    header("Location: /app_lista_tarefas_public/nova_tarefa.php?inclusao=true");
} else if ($acao == 'recuperar') {
    echo 'AQUII';
}
