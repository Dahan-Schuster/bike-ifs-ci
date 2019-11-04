<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Administrador - Bike IFS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de controle e gerenciamento de entrada e saída de bicicletas do bicicletário do Instituto Federal de Sergipe.">
    <meta name="keywords" content="bicicletário, ifs, instituto federal de sergipe, bicicletas, controle de entrada, tecnologia, inovação">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/css/palette.css">
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
        <nav class="navbar sticky-top navbar-expand-xl navbar-dark bg-dark-primary">
            <div class="container">
                <a class="navbar-brand mr-5" href="<?= base_url('admin/view/home') ?>">
                    <img class="icon-logo" src="<?= base_url() ?>/public/img/icon.svg" title="Logo" alt="Logo">
                    <img class='logo' src="<?= base_url() ?>/public/img/nome-logo.png" title="Bike IFS" alt="Bike IFS">
                </a>
                <button class="navbar-toggler bg-default-primary" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="material-icons">menu</i>
                </button>
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a id="navLinkRelatorios" class="nav-link" href="<?= base_url('admin/view/relatorios') ?>">
                                Relatórios
                            </a>
                        </li>
                        <li class="nav-item dropdown mx-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navLinkListagem" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Listar
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= base_url('admin/listar/admins') ?>">Administradores</a>
                                <a class="dropdown-item" href="<?= base_url('admin/listar/funcionarios') ?>">Funcionários</a>
                                <a class="dropdown-item" href="<?= base_url('admin/listar/bicicletas') ?>">Bicicletas</a>
                                <a class="dropdown-item" href="<?= base_url('admin/listar/tags') ?>">Tags RFID</a>
                                <a class="dropdown-item" href="<?= base_url('admin/listar/usuarios') ?>">Usuários</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('admin/listar/registros-do-dia') ?>">Registros do dia</a>
                                <a class="dropdown-item" href="<?= base_url('admin/listar/emails') ?>">E-mails</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navLinkExclusao" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Excluir
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= base_url('admin/view/excluir-registros') ?>">Registros</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <span class="text-light">
                                Logado como <strong><?= preg_split("/\s/", $nome)[0] ?></strong>
                            </span>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="btn bmd-btn-icon dropdown-toggl text-light" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_horiz</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                                <a class="dropdown-item" href="<?= base_url('admin/me') ?>">
                                    Perfil&nbsp;
                                    <i class="material-icons">person</i>
                                </a>
                                <a class="dropdown-item text-danger" href="<?= base_url('admin/sair') ?>">
                                    Sair&nbsp;
                                    <i class="material-icons">exit_to_app</i>
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