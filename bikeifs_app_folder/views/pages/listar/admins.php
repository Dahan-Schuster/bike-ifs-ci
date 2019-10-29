<div class="row">
    <span class="col-12">
        <h3>Lista de administradores</h3>
    </span>
</div>
<hr class="my-3">
<div class="table-responsive">
    <table class="table table-sm table-striped responsive table-hover" id="tableAdmins" style="width: 100%;">
        <caption>
            &nbsp;
            <button
             data-toggle="modal" data-target="#modalCadastroAdmin" data-backdrop="static" data-keyboard="false"
             title="Cadastrar novo" type="button" class="btn btn-primary bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">person_add</i>
            </button>
            <button id="btnExcluirSelecionados" onclick="excluirAdminsSelecionados()" title="Excluir selecionados" type="button" class="btn btn-danger bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">delete</i>
            </button>
            <button id="btnSelecionarLinhas" title="Selecionar todos" type="button" class="btn accent-color bmd-btn-fab bmd-btn-fab-sm text-light">
                <i class="material-icons">check_box_outline_blank</i>
            </button>
        </caption>
        <thead class="bg-default-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">CPF</th>
                <th scope="col">Excluir</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<br>
<!-- Modal Cadastrar Admin-->
<div id="modalCadastroAdmin" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header raised pb-3">
                <h3 class="modal-title">Cadastrar novo administrador</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formCadastroAdmin" autocomplete="off">
                <div class="modal-body">
                    <div id="divInputNome" class="form-group">
                        <label for="inputNome" class="bmd-label-floating">Nome</label>
                        <input name="nome" type="text" placeholder="Nome Completo" class="form-control" id="inputNome">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div id="divInputEmail" class="form-group">
                        <label for="inputEmail" class="bmd-label-floating">Endereço de e-mail</label>
                        <input name="email" type="email" placeholder="exemplo@email.com" class="form-control" id="inputEmail">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div id="divInputCpf" class="form-group">
                        <label for="inputCpf" class="bmd-label-floating">CPF</label>
                        <input name="cpf" type="text" placeholder="000.000.000-00" class="form-control" id="inputCpf">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div id="divInputSenha" class="form-group">
                        <label for="inputSenha" class="bmd-label-floating">Senha</label>
                        <input name="senha" type="password" class="form-control" id="inputSenha">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div id="divInputConfirmarSenha" class="form-group">
                        <label for="inputConfirmSenha" class="bmd-label-floating">Repita a senha</label>
                        <input name="confirmar_senha" type="password" class="form-control" id="inputConfirmSenha">
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                    <button id="btnEnviarCadastro" type="submit" class="btn btn-primary btn-raised">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim Modal Cadastrar Admin -->