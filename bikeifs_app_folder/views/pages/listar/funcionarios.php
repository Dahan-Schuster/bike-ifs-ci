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
            <button data-toggle="modal" data-target="#modalCadastroFun" title="Cadastrar novo" type="button" class="btn btn-primary bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">person_add</i>
            </button>
            <button onclick="ativarFuncionariosSelecionados()" title="Ativar selecionados" type="button" class="btn btn-info bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">thumb_up</i>
            </button>
            <button onclick="desativarFuncionariosSelecionados()" title="Desativar selecionados" type="button" class="btn btn-danger bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">thumb_down</i>
            </button>
        </caption>
        <thead class="thead-dark">
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