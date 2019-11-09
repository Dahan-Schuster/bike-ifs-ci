<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Bike IFS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de controle e gerenciamento de entrada e saída de bicicletas do bicicletário do Instituto Federal de Sergipe.">
    <meta name="keywords" content="bicicletário, ifs, instituto federal de sergipe, bicicletas, controle de entrada, tecnologia, inovação">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('favicon.ico'); ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico'); ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/palette.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/estilo.css'); ?>">
</head>


<?php
if (isset($styles)) :
    foreach ($styles as $style) :
        $href = base_url("public/css/$style") ?>
        <link href="<?= $href ?>" rel="stylesheet">
<?php endforeach;
endif;
?>

<body>
    <header>
        <nav class="navbar sticky-top navbar-expand-xl navbar-dark header-gradient">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url() ?>">
                    <img class="icon-logo" src="<?= base_url() ?>public/img/icon.svg" title="Logo" alt="Logo">
                    <img class='logo' src="<?= base_url() ?>public/img/nome-logo.png" title="Bike IFS" alt="Bike IFS">
                </a>
                <button class="navbar-toggler bg-default-primary" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="material-icons">menu</i>
                </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a id="navLinkLogin" class="nav-link" href="<?= base_url('home/view/login') ?>">
                                Entrar no sistema
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="topo">
        <button id="voltar_ao_topo" class="btn bmd-btn-fab accent-color" onclick="voltarAoTopo()" title="Voltar ao topo">
            <i class="material-icons material-icons" style="font-size: 36px">keyboard_arrow_up</i>
        </button>
    </div>


    <!-- divs que serão fechadas no arquivo footer -->
    <div id="pagina">
        <div id="conteudo" class="container-fluid">
            <div class="row">
                <noscript class="alert alert-danger col-12">
                    <strong>É necessário estar com o JavaScript habilitado para aproveitar todos os recursos do site.
                        <br>Por favor, habilite o JavaScript em seu navegador.</strong>
                </noscript>
            </div>