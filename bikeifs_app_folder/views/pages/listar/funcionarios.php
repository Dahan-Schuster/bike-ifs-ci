<div class="row">
    <span class="col-12 col-md-6">
        <h3>Lista de funcionários</h3>
    </span>
</div>
<hr class="my-3">
<div class="table-responsive">
    <table class="table table-sm responsive table-striped table-hover" id="tableFuncionarios" style="width: 100%;">
        <caption>
            &nbsp;
            <button data-toggle="modal" data-target="#modalCadastroFuncionario" data-backdrop="static" data-keyboard="false" title="Cadastrar novo" type="button" class="btn btn-primary bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">person_add</i>
            </button>
            <button id="btnAtivarSelecionados" onclick="ativarFuncionariosSelecionados()" title="Ativar selecionados" type="button" class="btn btn-info bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">thumb_up</i>
            </button>
            <button id="btnDestivarSelecionados" onclick="desativarFuncionariosSelecionados()" title="Desativar selecionados" type="button" class="btn btn-danger bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">thumb_down</i>
            </button>
            <button id="btnSelecionarLinhas" title="Selecionar todos" type="button" class="btn accent-color bmd-btn-fab bmd-btn-fab-sm text-light">
                <i class="material-icons">check_box_outline_blank</i>
            </button>
            <button onclick="atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)" title="Atualizar tabela" type="button" class="btn btn-secondary bmd-btn-fab bmd-btn-fab-sm text-light">
                <i class="material-icons">refresh</i>
            </button>
        </caption>
        <thead class="bg-default-primary">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Situacao</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<br>
<!-- Modal Cadastrar Funcionario-->
<div id="modalCadastroFuncionario" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header raised pb-3">
                <h3 class="modal-title">Cadastrar novo funcionário</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formCadastroFuncionario" autocomplete="off">
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
                    <div class="form-row">
                        <div id="divinputTelefone" class="form-group col-12 col-sm-6">
                            <label for="inputTelefone" class="bmd-label-floating">Telefone para contato</label>
                            <input name="telefone" type="text" placeholder="(00) 00000-0000" class="form-control" id="inputTelefone">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div id="divInputCpf" class="form-group col-12 col-sm-6">
                            <label for="inputCpf" class="bmd-label-floating">CPF</label>
                            <input name="cpf" type="text" placeholder="000.000.000-00" class="form-control" id="inputCpf">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div id="divInputSenha" class="form-group col-12 col-sm-6">
                            <label for="inputSenha" class="bmd-label-floating">Senha</label>
                            <input name="senha" type="password" class="form-control" id="inputSenha">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div id="divInputConfirmarSenha" class="form-group col-12 col-sm-6">
                            <label for="inputConfirmSenha" class="bmd-label-floating">Repita a senha</label>
                            <input name="confirmar_senha" type="password" class="form-control" id="inputConfirmSenha">
                            <span class="invalid-feedback"></span>
                        </div>
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
<!-- Fim Modal Cadastrar Funcionario -->