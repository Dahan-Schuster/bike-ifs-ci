<!-- Modal confirmarCheckOut -->
<div id="modalConfirmarCheckOut" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <h3 class="modal-title">Confirmar <i>Check-Out</i></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="modal-header alert alert-warning">
                        <h4>Confirme as informações!</h4>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nomeUsuario">Usuário</label>
                    <input class="form-control" type="text" id="nomeUsuario" readonly>
                </div>
                <div class="form-group">
                    <label for="infoBicicleta">Bicicleta</label>
                    <div id="divBicicleta" class="bike-color text-light">
                        <img src="<?= base_url() ?>/public/img/icons/bycicle.png" title="Bike" alt="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="checkOut(this);" class="btn btn-success" id="check">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal confirmarCheckOut -->
<!--------------------------------->
<!-- Modal checkOut -->
<div id="modalCheckOut" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <h3 class="modal-title">Realizar <i>Check-Out</i></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formCheckOut">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputObs">Observações sobre a saída</label>
                        <textarea class="form-control" id="inputObs" name="obs" maxlength="255" autofocus></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="check">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim modal checkOut -->
<!--------------------------------->
<!-- Modal checkout bem sucedido -->
<div id="modalCheckOutSucesso" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-success">
                <h3 class="modal-title">Sucesso!</i></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>O registro foi salvo com sucesso!</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- fim modal checkout bem sucedido -->
<!-------------------------->
<!-- Modal acesso negado -->
<div id="modalAcessoNegado" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h3 class="modal-title">Acesso negado.</i></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>Administradores não possuem permissão para realizar checkouts.</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- fim modal acesso negado -->
<!----------------------------->
<!-- Modal registrar entrada -->
<div id="modalRegistroManual" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header raised pb-3">
                <h3 class="modal-title">Registrar entrada</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formRegistrarEntradaManual">
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
                    <div class="form-row">
                    <div id="divSelectBicicleta" class="form-group col-12 col-sm-6">
                        <label for="selectBicicleta" class="bmd-label-floating">
                            Selecione a bicicleta
                        </label>
                        <select class="form-control" id="selectBicicleta" name="id_bicicleta">
                            <option value="">Primeiramente, selecione um usuário.</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <label for="selectedBikeColor" class="bmd-label-floating">Cor da bicicleta selecionada</label>
                        <div id="selectedBikeColor" class="form-control bike-color">
                            <i class="material-icons">directions_bike</i>
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="inputObs">Observações sobre a entrada</label>
                        <textarea class="form-control" id="inputObs" name="obs" maxlength="255"></textarea>
                    </div>
                    <div id="divInputNumTrava" class="form-group">
                        <label for="inputNumTrava">Número do cadeado utilizado (0 para nenhum)</label>
                        <input type="number" class="form-control" id="inputNumTrava" name="num_trava" min="0" max="15"
                            value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                    <button id="btnCheckinManual" type="submit" class="btn btn-primary btn-raised"><i>Check-in</i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim modal registrar entrada -->
<!--------------------------------->
<!-- Modal registro automático -->
<div id="modalRegistroAutomatico" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <h3 class="modal-title">Confirme as informações</i></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputUID">UID</label>
                    <span id="inputUID" class="form-control mt-1"></span>
                </div>
                <div class="form-group">
                    <label for="divBicicleta">Bicicleta</label>
                    <div id="divBicicleta" class="form-control bike-color">
                        <img src="<?= base_url() ?>/public/img/icons/bycicle.png" title="Bike" alt="">
                    </div>
                    <input type="hidden" id="bikeId" />
                </div>
                <div class="form-group">
                    <label for="spanUsuario">Usuário - Matrícula</label>
                    <span id="spanUsuario" class="form-control mt-1"></span>
                </div>
                <hr>
                <div class="form-group">
                    <label for="inputObs">Observações sobre a entrada</label>
                    <textarea class="form-control" id="inputObs" name="obs" maxlength="255"></textarea>
                </div>
                <div class="form-group">
                    <label for="inputNumTrava">Número do cadeado utilizado (0 para nenhum)</label>
                    <input type="number" class="form-control" id="inputNumTrava" name="num_trava" min="0" max="15"
                        value="0">
                </div>
            </div>
            <input type="hidden" id="idUsuario">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="realizarRegistroAutomatico()"
                    class="btn btn-primary"><i>Check-in</i></button>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal registro automático -->
<!----------------------------------->
<!-- Modal inativa -->
<div id="modalBikeInativa" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h3 class="modal-title">Registro negado.</i></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>Esta bike se encontra inativa e está impossibilidata de realizar registros.</h4>
                <hr>
                <p class="lead">Bikes devem ser definidas como inativas quando seu uso se torna inviável.</p>
                <p class="lead">Se o dono desta bike deseja realizar um registro, verifique se a bicicleta possui
                    condições de voltar a estar ativa e atualize as informações no
                    <a id="linkPerfil" target="_blank" href="#">perfil do usuário</a>
                    menu "Bicicletas"
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- fim modal bike inativa -->
<!----------------------------->
<!-- Modal usuário inativo -->
<div id="modalUsuarioInativo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h3 class="modal-title">Acesso negado.</i></h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>Este usuário se encontra inativo e está impossibilidato de realizar registros.</h4>
                <hr>
                <p class="lead">Usuários inativos são aqueles que possuíram algum vínculo estudantil/trabalhista com o
                    IFS mas não o possuem mais.</p>
                <p class="lead">Se este usuário deseja realizar um registro, verifique se o mesmo possui
                    permissão para tornar-se ativo novamente e atualize as informações no
                    <a id="linkPerfil" target="_blank" href="#">perfil do usuário</a>, <strong style="font-weight: bold;">ou</strong>
                    <a target="_blank" href="?pagina=cadastrarUsuario">cadastre</a> um novo usuário como Visitante.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- fim modal usuário inativo -->
<!----------------------------->