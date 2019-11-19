<div class="dropdown-menu dropdown-menu-center show py-0">
    <div class="alert raised bg-default-primary text-light">
        <h5>Entrar como Usuário</h5>
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
        <button style="display: flex; float: right;" id="btnEntrar" type="submit" class="btn btn-raised accent-color text-light">Entrar</button>
    </form>

    <div class="dropdown-divider"></div>
    <a class="dropdown-item text-muted pl-2" href="<?= base_url('home/view/esqueciSenha') ?>">Esqueci a senha</a>
    <div id="aviso-login" style="display: none" class="alert bg-success text-light mb-0">
    </div>
</div>