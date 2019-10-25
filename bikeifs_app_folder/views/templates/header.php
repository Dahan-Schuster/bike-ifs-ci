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
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/css/estilo.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        <nav class="navbar sticky-top navbar-expand-xl navbar-light bg-dark header-gradient">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url() ?>">
                    <img class='logo' src="<?= base_url('public/img/img-logo.svg'); ?>" title="Logo" alt="Logo">
                    <img class='logo' src="<?= base_url('public/img/nome-logo.svg'); ?>" title="Bike IFS" alt="Bike IFS">
                </a>
                <button class="navbar-toggler bg-primary py-2" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <h3>
                                <a class="nav-link badge badge-success text-light mr-3 px-2" href="<?= base_url('home/view/login') ?>">
                                    Fazer login
                                </a>
                            </h3>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="topo">
        <button id="voltar_ao_topo" class="header-gradient" onclick="voltarAoTopo()" title="Voltar ao topo">
            <img src="<?= base_url('public/img/icons/topo.png') ?>" alt="topo" class="invert">
        </button>
    </div>


    <div class="container my-2">
        <div class="row">
            <noscript class="alert alert-danger col-12">
                <strong>É necessário estar com o JavaScript habilitado para aproveitar todos os recursos do site.
                    <br>Por favor, habilite o JavaScript em seu navegador.</strong>
            </noscript>
        </div>
    </div>



    <!-- divs que serão fechadas no arquivo footer -->
    <div id="pagina">
        <div id="conteudo" class="container">