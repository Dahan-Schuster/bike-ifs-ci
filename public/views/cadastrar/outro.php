<?php 
@session_start();
if (isset($_SESSION['login'])) {
	if(isset($_GET['obj'])) { ?>
		<div class="jumbotron bg-light">
		  <h1 class="display-4">Cadastro realizado!</h1>
		  <hr class="my-3">
		  <h3 class="mb-5">Deseja cadastrar outro?</h3>
		  <a class="btn btn-primary btn-lg" href="?pagina=cadastrar<?php echo $_GET['obj'] ?>" role="button">Cadastrar</a>
		  <a class="btn btn-primary btn-lg" href="?pagina=cadastros" role="button">Voltar</a>
		</div>
	<?php } else { ?>
		<h3>URL inválida. Por favor, retorne à página anterior.</h3>
	<?php } 
} else { ?> 
    <div class="alert alert-danger" role="alert">
        É necessário fazer login para acessar está página.
    </div>
<?php } ?>