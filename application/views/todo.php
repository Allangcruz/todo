<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Allan</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>resource/bootstrap/css/bootstrap.css">
		<script type="text/javascript" src="<?php echo base_url(); ?>resource/js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>resource/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>resource/js/angular.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>resource/js/todo.js"></script>
	</head>
	<body ng-app="app">

	<div class="container" style="width: 650px;" ng-controller="todo">
			<br>
			<legend>Coisa a fazer.</legend>
			<div id="resposta"></div>
			<form>
				<div class="input-append">
				  <input type="hidden" ng-model="item.id" class="span1">
				  <input class="span5" type="text" ng-model="item.text">
				  <button class="btn" ng-click="save();">Salvar</button>
				 <span><img ng-show="load" style="margin-left: 8px;margin-top: 4px;" src="<?php echo base_url(); ?>resource/img/load.gif" /></span>
				</div>
			</form>

			<!--Lista de itens-->
			<table class="table	table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Descricao</th>
						<th>Acão</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="un in itens">
						<td>{{un.id}}</td>
						<td>{{un.text}}</td>
						<td>
							<a href="#" title="Atualizar" ng-click="update(un);"><i class="icon-refresh" ></i></a>
							<a href="#" title="Excluir item: {{un.id}}" ng-click="delete(un.id);"><i class="icon-trash"> </i></a>
						</td>
					</tr>
				</tbody>
			</table>
			<!--Fim lista de itens-->
	</div>
</body>
</html>