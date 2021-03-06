<div class="row">
    <span class="col-12 col-md-6">
        <h3>Lista de tags RFID</h3>
    </span>
</div>
<hr class="my-3">
<div class="table-responsive">
    <table class="table table-sm responsive table-striped table-hover" id="tableTags" style="width: 100%;">
        <caption>
            &nbsp;
            <button data-toggle="modal" data-target="#modalCadastroTag" data-backdrop="static" data-keyboard="false" title="Cadastrar novo" type="button" class="btn btn-primary bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">add</i>
            </button>
            <button id="btnExcluirSelecionados" onclick="excluirTagsSelecionadas()" title="Excluir selecionados" type="button" class="btn btn-danger bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">delete</i>
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
                <th>&#9432;</th>
                <th>Codigo</th>
                <th class="none">Cor da bike</th>
                <th class="min-desktop">Foto</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Aro</th>
                <th>Situação Bicicleta</th>
                <th>Dono</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<br>
<!-- Modal Cadastrar Tag-->
<div id="modalCadastroTag" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header raised pb-3">
                <h3 class="modal-title">Cadastrar nova Tag RFID</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form autocomplete="off" id="formCadastroTag">
                <div class="modal-body">
                    <div id="divSelectUsuario" class="form-group">
                        <label for="selectUsuario" class="bmd-label-floating">
                            Pesquise um usuário clicando no botão ao lado
                        </label>
                        <div class="input-group">
                            <select class="form-control" id="selectUsuario">
                                <option value="">Selecione o dono da bicicleta</option>
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn" data-toggle="modal" data-target="#modalPesquisarUsuario">
                                    <i class="material-icons">search</i>
                                </button>
                            </div>
                        </div>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div id="divSelectBicicleta" class="form-group">
                        <label for="selectBicicleta" class="bmd-label-floating">
                            Selecione a bicicleta
                        </label>
                        <select class="form-control" id="selectBicicleta" name="id_bicicleta">
                            <option value="">Primeiramente, selecione um usuário.</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div id="divInputUid" class="form-group">
                        <label for="inputUID" class="bmd-label-floating">
                            Clique no botão ao lado para ler uma Tag RFID
                        </label>
                        <div class="input-group">
                            <input name="codigo" type="text" placeholder="Código UID" class="form-control" id="inputUID">
                            <div class="input-group-append">
                                <button type="button" class="btn" data-toggle="modal" data-target="#modalLerTag">
                                    <img src="<?= base_url('public/img/icons/rfid.png') ?>" class="img-responsive" title="Ler Tag RFID" alt="Ler Tag Rfid">
                                </button>
                            </div>
                        </div>
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
<!-- Fim Modal Cadastrar Tag -->
<?php include_once('public/views/dialogs/modalPesquisarUsuario.html'); ?>
<?php include_once('public/views/dialogs/modalLerTag.html'); ?>
<?php include_once('public/views/dialogs/popperZoomImagem.html'); ?>