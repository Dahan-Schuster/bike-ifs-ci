<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>404 - Bike IFS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Sistema de controle e gerenciamento de entrada e saída de bicicletas do bicicletário do Instituto Federal de Sergipe.">
	<meta name="keywords" content="bicicletário, ifs, instituto federal de sergipe, bicicletas, controle de entrada, tecnologia, inovação">
	<link rel="shortcut icon" type="image/x-icon" href="<?= config_item('base_url'); ?>favicon.ico">
	<link rel="icon" type="image/x-icon" href="<?= config_item('base_url'); ?>favicon.ico">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= config_item('base_url') ?>public/css/bootstrap-material-design.min.css">
	<link rel="stylesheet" type="text/css" href="<?= config_item('base_url') ?>public/css/palette.css">
	<link rel="stylesheet" type="text/css" href="<?= config_item('base_url'); ?>public/css/estilo.css">
</head>

<body style="background-color: #009fc2;">
	<header>
		<nav style="margin-bottom: 0" class="navbar sticky-top navbar-expand-xl navbar-dark header-gradient">
			<div class="container">
				<a class="navbar-brand" href="<?= config_item('base_url') ?>">
					<img class="icon-logo" src="<?= config_item('base_url') ?>public/img/icon.svg" title="Logo" alt="Logo">
					<img class='logo' src="<?= config_item('base_url') ?>public/img/nome-logo.png" title="Bike IFS" alt="Bike IFS">
				</a>
				<button style="background: #ffffff21" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="material-icons">menu</i>
				</button>
				<div class="collapse navbar-collapse" id="navbarMenu">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a id="navLinkLogin" class="nav-link" href="<?= config_item('base_url') ?>home/view/login">
								Entrar no sistema
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!-- divs que serão fechadas no arquivo footer -->
	<div id="pagina">
		<div class="row">
			<noscript class="alert alert-danger col-12">
				<strong>É necessário estar com o JavaScript habilitado para aproveitar todos os recursos do site.
					<br>Por favor, habilite o JavaScript em seu navegador.</strong>
			</noscript>
		</div>

		<div class="container-fluid">
			<div id="scene">
				<div data-depth="0.1">
					<img width="100%" src="<?= config_item('base_url') ?>public/img/404/fundo1.png">
				</div>
				<div data-depth="0.6">
					<img width="100%" src="<?= config_item('base_url') ?>public/img/404/sol.png">
				</div>
				<div data-depth="0.1">
					<img width="100%" src="<?= config_item('base_url') ?>public/img/404/fundo2.png">
				</div>
				<div data-depth="0.2">
					<img width="100%" src="<?= config_item('base_url') ?>public/img/404/placacomerro.png">
				</div>
				<div data-depth="0.3">
					<img width="100%" src="<?= config_item('base_url') ?>public/img/404/pedra.png">
				</div>
				<div data-depth="1">
					<img width="100%" src="<?= config_item('base_url') ?>public/img/404/bike.png">
				</div>
				<div data-depth="0.3">
					<img width="100%" src="<?= config_item('base_url') ?>public/img/404/eita.png">
				</div>
				<div data-depth="0.3">
					<img width="100%" src="<?= config_item('base_url') ?>public/img/404/frase.png">
				</div>
			</div>
		</div>

		<footer style="background: transparent;">
			<script language="javascript" src="<?= config_item('base_url') ?>public/js/jquery.min.js"></script>
			<script language="javascript" src="<?= config_item('base_url') ?>public/js/popper.min.js"></script>
			<script language="javascript" src="<?= config_item('base_url') ?>public/js/bootstrap-material-design.js"></script>
			<script language="javascript" src="<?= config_item('base_url') ?>public/js/parallax.min.js"></script>
			<script>
				var scene = document.getElementById('scene');
				var parallaxInstance = new Parallax(scene);
			</script>
		</footer>
	</div> <!-- fechamento da div pagina -->
</body>
</div> <!-- fechamento da div pagina -->

</html>