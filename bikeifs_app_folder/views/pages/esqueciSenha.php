<div class="dropdown-menu dropdown-menu-center show pt-0">
    <div class="alert raised bg-default-primary text-light">
        <h4>Recuperar senha</h4>
    </div>
    <form class="px-4 pb-5" autocomplete="off" id="formEsqueciSenha">
        <div class="form-group">
            <label for="inputEmail">Endereço de e-mail</label>
            <input tabindex="1" id="inputEmail" class="form-control" type="email" name="email" placeholder="Informe seu e-mail" autofocus>
        </div>
        <div class="form-row mb-3">
            <div class="col-12 col-sm-4">
                <div class="custom-control custom-radio form-check-inline ">
                    <input class="custom-control-input" type="radio" name="tipoAcesso" id="radioFuncionario" value="funcionario" checked>
                    <label class="custom-control-label" for="radioFuncionario">
                        Funcionário
                    </label>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="custom-control custom-radio form-check-inline ">
                    <input class="custom-control-input" type="radio" name="tipoAcesso" id="radioUsuario" value="usuario">
                    <label class="custom-control-label" for="radioUsuario">
                        Usuário
                    </label>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="custom-control custom-radio form-check-inline ">
                    <input class="custom-control-input" type="radio" name="tipoAcesso" id="radioAdmin" value="admin">
                    <label class="custom-control-label" for="radioAdmin">
                        Administrador
                    </label>
                </div>
            </div>
        </div>
        <button id="btnEnviar" type="submit" class="btn btn-raised accent-color text-light" style="display: flex; float: right;">Enviar</button>
    </form>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item text-muted pl-2" href="<?= base_url('home/view/login') ?>">Voltar para a página de Login</a>
</div>