<div class="row">
	<span class="col-12">
		<h1>Área restrita</h1>
	</span>
</div>
<hr>
<div class="row">
	<div class="col-sm-6 mb-2">
		<div class="card h-100">
			<h5 class="card-header">Listagem</h5>
			<div class="card-body">
				<p class="card-text">Listar usuários, funcionários, bicicletas, etiquetas RFID, entre outros.</p>
				<a href="<?= base_url('admin/view/menuListagem') ?>" class="btn">Página de listagem</a>
			</div>
		</div>
	</div>
	<div class="col-sm-6 mb-2">
		<div class="card h-100">
			<h5 class="card-header">Relatórios</h5>
			<div class="card-body">
				<p class="card-text">Conferir relatórios de uso, cadastro etc.</p>
				<a href="<?= base_url('admin/view/relatorios') ?>" class="btn">Página de relatórios</a>
			</div>
		</div>
	</div>
	<div class="col-sm-6 mb-2">
		<div class="card card-danger h-100">
			<h5 class="card-header">Excluir</h5>
			<div class="card-body">
				<p class="card-text">Excluir dados salvos no sistema de forma irreversível</p>
				<a href="<?= base_url('admin/view/menuExclusao') ?>" class="btn">Página de exclusão</a>
			</div>
		</div>
	</div>
</div>
<br>