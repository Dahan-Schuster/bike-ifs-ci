<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Funcionário - Bike IFS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de controle e gerenciamento de entrada e saída de bicicletas do bicicletário do Instituto Federal de Sergipe.">
    <meta name="keywords" content="bicicletário, ifs, instituto federal de sergipe, bicicletas, controle de entrada, tecnologia, inovação">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/favicon.ico">
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/css/sidepanel.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <?php
    if (isset($styles)) :
        foreach ($styles as $style) :
            $href = base_url("public/css/$style") ?>
            <link href="<?= $href ?>" rel="stylesheet">
    <?php endforeach;
    endif;
    ?>
</head>

<body>
    <header>
        <nav class="navbar sticky-top navbar-expand-xl navbar-light bg-dark header-gradient">
            <div class="container">
                <a class="navbar-brand" href="?pagina=home">
                    <img class="icon-logo" src="<?= base_url() ?>/public/img/icon.svg" title="Logo" alt="Logo">
                    <img class='logo' src="<?= base_url() ?>/public/img/nome-logo.png" title="Bike IFS" alt="Bike IFS">
                </a>
                <button class="navbar-toggler bg-primary py-2" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <h3>
                                <a class="nav-link badge badge-light text-dark mr-3 px-2" href="?pagina=registrosDoDia">
                                    Registros
                                </a>
                            </h3>
                        </li>
                        <li class="nav-item active">
                            <h3>
                                <a class="nav-link badge badge-danger text-light mr-3 px-2" href="?pagina=restrita">
                                    Área restrita
                                </a>
                            </h3>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle text-light" id="dropdownMenu" style="cursor: pointer;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <strong>Opções</strong>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                <a class="dropdown-item" href="?pagina=perfil">
                                    <span class="py-2 my-2">
                                        <span>Perfil</span>
                                        <img class="ml-3" src="<?= base_url() ?>/public/img/icons/profile.png" title="Perfil" alt="Perfil">
                                    </span>
                                </a>
                                <a class="dropdown-item text-danger" style="font-size: 18px;" href="<?= base_url() ?>/app/src/controller/logout.php">
                                    <span>
                                        <span>Sair</span>
                                        <img style="width: 20px; margin-left: 1.35rem!important;" src="<?= base_url() ?>/public/img/icons/logout.png" title="Sair" alt="Sair">
                                    </span>
                                </a>
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

    <div id="sidenav-perfil" class="perfil-publico-lateral">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNavPerfil()">&times;</a>
        <iframe id="iframePerfilLateral" class="embed-responsive-item" frameborder="0"></iframe>
    </div>

    <div id="sidenav-bike" class="bike-painel-lateral">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNavBike()">&times;</a>
        <iframe id="iframePainelBike" class="embed-responsive-item" frameborder="0"></iframe>
    </div>

    <div class="container my-2">
        <div class="row">
            <noscript class="alert alert-danger col-12">
                <strong>É necessário estar com o JavaScript habilitado para aproveitar todos os recursos do site.
                    <br>Por favor, habilite o JavaScript em seu navegador.</strong>
            </noscript>
        </div>
    </div>
    <!-- div que será fechada no arquivo footer -->
    <div id="pagina">
        <div id="conteudo" class="container">