<?php
@session_start();
if (isset($_SESSION['login'])) { ?>
	<div class="jumbotron bg-light">
		<h1 class="display-4">Enviado com sucesso!</h1>
		<hr class="my-3">
		<h3 class="mb-5">Deseja continuar enviando emails?</h3>
		<a class="btn btn-primary btn-lg" href="?pagina=contato" role="button">Sim</a>
		<a class="btn btn-primary btn-lg" href="?pagina=restrita" role="button">Voltar</a>
	</div>
<?php } else { ?>
	<div class="alert alert-danger" role="alert">
		É necessário fazer login para acessar está página.
	</div>
<?php } ?>