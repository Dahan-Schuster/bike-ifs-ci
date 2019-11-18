<?php @session_destroy(); ?>

<head>
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
                    <div class="dropdown-menu dropdown-menu-center show py-0">
                        <div class="alert raised bg-default-primary text-light">
                            <h4>Login</h4>
                        </div>
                        <form id="formLogin" autocomplete="off" class="px-4 pb-5">
                            <div class="form-group">
                                <label for="inputLogin">Usuário</label>
                                <input tabindex="1" id="inputLogin" class="form-control" type="text" name="login" placeholder="Email, CPF ou matrícula" autofocus>
                            </div>
                            <div class="form-group">
                                <label class="mb-0" for="inputSenha">Senha</label>
                                <div class="input-group">
                                    <input id="inputSenha" class="pt-0 form-control" type="password" name="senha" tabindex="2">
                                    <div class="input-group-append">
                                        <button id="botaoVisibilidade" type="button" class="btn">
                                            <i class="material-icons">visibility</i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-12 col-sm-4">
                                    <div class="custom-control custom-radio form-check-inline ">
                                        <input tabindex="3" class="custom-control-input" type="radio" name="tipoAcesso" id="radioFuncionario" value="funcionario" checked>
                                        <label class="custom-control-label" for="radioFuncionario">
                                            Funcionário
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="custom-control custom-radio form-check-inline ">
                                        <input tabindex="4" class="custom-control-input" type="radio" name="tipoAcesso" id="radioUsuario" value="usuario">
                                        <label class="custom-control-label" for="radioUsuario">
                                            Usuário
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="custom-control custom-radio form-check-inline ">
                                        <input tabindex="5" class="custom-control-input" type="radio" name="tipoAcesso" id="radioAdmin" value="admin">
                                        <label class="custom-control-label" for="radioAdmin">
                                            Administrador
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button style="display: flex; float: right;" id="btnEntrar" type="submit" class="btn btn-raised accent-color text-light">Entrar</button>
                        </form>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-muted pl-2" href="<?= base_url('home/view/esqueciSenha') ?>">Esqueci a senha</a>
                        <div id="aviso-login" style="display: none" class="alert bg-success text-light mb-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>