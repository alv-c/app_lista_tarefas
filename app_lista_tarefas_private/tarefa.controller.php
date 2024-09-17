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
} else if ($acao == 'atualizar') {
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);
    if($tarefaService->atualizar()) 
        header("Location: /app_lista_tarefas_public/todas_tarefas.php?atualizacao=true");
} else if ($acao == 'remover') {
    $tarefa->__set('id', $_GET['id']);
    if($tarefaService->remover())
        header("Location: /app_lista_tarefas_public/todas_tarefas.php?remocao=true");
} else if ($acao == 'marcar_realizado') {
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', 2);
    if($tarefaService->marcar_realizado())
        header("Location: /app_lista_tarefas_public/todas_tarefas.php?marcar_realizado=true");
} else if ($acao == 'recuperar') $tarefas = $tarefaService->recuperar();
