<?php @session_destroy(); ?>
<div id="aviso-login" class="alert alert-danger raised" style="display: none" role="alert">
</div>
<div class="dropdown-menu dropdown-menu-center show pt-0">
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
                    <button id="botaoVisibilidade" type="button" class="btn" style="outline: none; box-shadow: none; padding: 0 .75rem">
                        <i class="material-icons">visibility</i>
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
        <button style="display: flex; float: right;" id="btnEntrar" type="submit" class="btn btn-raised accent-color">Entrar</button>
    </form>

    <div class="dropdown-divider"></div>
    <a class="dropdown-item text-muted pl-2" href="<?= base_url('home/view/esqueciSenha') ?>">Esqueci a senha</a>
</div>