<?php @session_destroy(); ?>
<div id="aviso-login" class="alert alert-danger" style="display: none" role="alert">
</div>
<div class="jumbotron jumbotron-fluid jumbotron-main" id="jumbotron-home">
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-light">Bem vindo ao Bike IFS</h1>
        </div>
        <hr class="my-4 bg-light">
        <div class="row">
            <div class="col">
                <div>
                    <div class="dropdown-menu dropdown-menu-center text-light">
                        <div class="row mb-2 mx-1">
                            <h4 class="mb-0 text-light col-12 col-sm-5">
                                Log-in
                                <img src="<?=base_url()?>/public/img/icons/login.png" title="Login" alt="Login">
                            </h4>
                            <button class="col-12 col-sm-7 mt-0 pr-2" type="button" id="botaoEsqueciSenha">Esqueci a senha</button>
                        </div>
                        <hr class="my-0 text-light bg-light">
                        <form autocomplete="off" class="px-4 py-3" id="formLogin">
                            <div class="form-row">
                                <div class="input-group col mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text px-2">
                                            <img src="<?=base_url()?>/public/img/icons/user.png" title="Usuário" alt="Usuário">
                                        </div>
                                    </div>
                                    <input tabindex="1" id="inpuser" class="form-control" type="text" name="login" placeholder="Email, CPF ou matrícula" autofocus>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-group col mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text px-2">
                                            <img src="<?=base_url()?>/public/img/icons/key-pass.png" title="Senha" alt="Senha">
                                        </div>
                                    </div>
                                    <input id="inpsenha" class="form-control" type="password" name="senha" placeholder="Senha" tabindex="2">
                                    <div class="input-group-append">
                                        <button id="botaoVisibilidade" type="button" class="btn" data-toggle="modal" data-target="#modalEscolherCor" style="outline: none; box-shadow: none; padding: 0 .75rem;">
                                            <img src="<?=base_url()?>/public/img/icons/view.png" title="Mostrar/Esconder senha" alt="Mostrar/Esconder Senha">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <div class="custom-control custom-radio form-check-inline ">
                                        <input tabindex="3" class="custom-control-input" type="radio" name="tipoAcesso" id="radioFuncionario" value="funcionario" checked>
                                        <label class="custom-control-label" for="radioFuncionario">
                                            Funcionário
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-radio form-check-inline ">
                                        <input tabindex="4" class="custom-control-input" type="radio" name="tipoAcesso" id="radioUsuario" value="usuario">
                                        <label class="custom-control-label" for="radioUsuario">
                                            Usuário
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-radio form-check-inline ">
                                        <input tabindex="5" class="custom-control-input" type="radio" name="tipoAcesso" id="radioAdmin" value="admin">
                                        <label class="custom-control-label" for="radioAdmin">
                                            Administrador
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button id="btnEntrar" type="submit" class="btn btn-success" style="width: 100%;">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>