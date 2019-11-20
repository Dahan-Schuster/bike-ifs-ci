<?php
defined('BASEPATH') or exit('No direct script access allowed');
@session_destroy();
?>
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
    <style>
        body {
            background: linear-gradient(rgba(90, 90, 90, 0.5), rgba(90, 90, 90, 0.5)), url('<?= base_url('public/img/jumbotrom-login-bg.jpg') ?>') !important;
        }

        #scene {
            border-right: 1px solid white;
        }

        @media screen and (max-width: 767px) {
            #scene {
                border-right: none;
                border-bottom: 1px solid white;
            }
        }
    </style>
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
                <button style="background: #ffffff21" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="material-icons">menu</i>
                </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown mx-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navLinkListagem" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Entrar no sistema
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= base_url('login/usuario') ?>">Usuário</a>
                                <a class="dropdown-item" href="<?= base_url('login/funcionario') ?>">Funcionário</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('login/admin') ?>">Administrador</a>
                            </div>
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

            <div class="jumbotron jumbotron-login" id="jumbotron-home">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-7">
                            <div id="scene" class="h-100 w-100">
                                <div data-depth="0.1">
                                    <img src="<?= base_url('public/img/surfing-bike.png') ?>" alt="" class="img-fluid">
                                </div>
                                <div data-depth="1">
                                    <img src="<?= base_url('public/img/login-bike-urbana.png') ?>" alt="" class="img-fluid float-right mr-3">
                                </div>
                                <div data-depth="0.8">
                                    <img src="<?= base_url('public/img/login-bike-speed.png') ?>" alt="" class="img-fluid float-right mr-3">
                                </div>
                                <div data-depth="0.9">
                                    <img src="<?= base_url('public/img/login-bike-fold.png') ?>" alt="" class="img-fluid float-right mr-3">
                                </div>
                                <div data-depth="0.8">
                                    <img src="<?= base_url('public/img/login-bike-fix.png') ?>" alt="" class="img-fluid float-right mr-3">
                                </div>
                                <div data-depth="0.9">
                                    <img src="<?= base_url('public/img/login-bike-down.png') ?>" alt="" class="img-fluid float-right mr-3">
                                </div>
                                <div data-depth="1">
                                    <img src="<?= base_url('public/img/login-bike-bmx.png') ?>" alt="" class="img-fluid float-right mr-3">
                                </div>
                                <div data-depth="0.3">
                                    <img src="<?= base_url('public/img/surfing-ifs.png') ?>" alt="" class="img-fluid float-right mr-3">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 col-lg-5">
                            <div>