<?php
$acao = 'recuperar_pendentes';
require_once "{$_SERVER["DOCUMENT_ROOT"]} . /app_lista_tarefas_public/tarefa.controller.php";
?>

<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App Lista Tarefas</title>

	<link rel="stylesheet" href="/app_lista_tarefas_public/css/estilo.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<script>
		function editar(id, valor) {
			let form = document.createElement('form');
			form.action = '/app_lista_tarefas_public/index.php?pag=index&acao=atualizar';
			form.method = 'post';
			form.className = 'row';

			let inputTarefa = document.createElement('input');
			inputTarefa.type = 'text';
			inputTarefa.name = 'tarefa';
			inputTarefa.className = 'col-9 form-control';
			inputTarefa.value = valor;

			let inputHidden = document.createElement('input');
			inputHidden.type = 'hidden';
			inputHidden.name = 'id';
			inputHidden.value = id;

			let button = document.createElement('button');
			button.type = 'submit';
			button.className = 'col-3 btn btn-success';
			button.innerHTML = 'Atualizar';

			form.appendChild(inputTarefa);
			form.appendChild(inputHidden);
			form.appendChild(button);
			let tarefa = document.getElementById('tarefa_' + id);
			tarefa.innerHTML = '';
			tarefa.insertBefore(form, tarefa[0]);
		}

		function remover(id) {
			location.href = `/app_lista_tarefas_public/index.php?pag=index&acao=remover&id=${id}`;
		}

		function marcarRealizado(id) {
			location.href = `/app_lista_tarefas_public/index.php?pag=index&acao=marcar_realizado&id=${id}`;
		}
	</script>
</head>

<body>
	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">
				<img src="/app_lista_tarefas_public/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
				App Lista Tarefas
			</a>
		</div>
	</nav>
	<div class="container app">
		<div class="row">
			<div class="col-md-3 menu">
				<ul class="list-group">
					<li class="list-group-item active"><a href="/app_lista_tarefas_public/index.php">Tarefas pendentes</a></li>
					<li class="list-group-item"><a href="/app_lista_tarefas_public/nova_tarefa.php">Nova tarefa</a></li>
					<li class="list-group-item"><a href="/app_lista_tarefas_public/todas_tarefas.php">Todas tarefas</a></li>
				</ul>
			</div>

			<div class="col-md-9">
				<div class="container pagina">
					<div class="row">
						<div class="col">
							<h4>Tarefas pendentes</h4>
							<hr />
							<?php foreach ($tarefas as $index => $value) : ?>
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9" id="tarefa_<?= $value['id'] ?>">
										<?= $value['tarefa'] ?>
									</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $value['id'] ?>)" style="cursor: pointer;"></i>
										<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $value['id'] ?>, '<?= $value['tarefa'] ?>')" style="cursor: pointer;"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizado(<?= $value['id'] ?>)" style="cursor: pointer;"></i>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>