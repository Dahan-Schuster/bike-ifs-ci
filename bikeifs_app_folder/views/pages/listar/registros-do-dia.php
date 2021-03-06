<div class="row">
    <span class="col-12 col-md-5">
        <h3>Registros do dia</h3>
    </span>
    <?php if ($pode_registrar) : ?>
        <div class="col-12 col-md-3">
            <button data-backdrop="static" class="btn btn-raised bg-accent text-light" type="button" data-toggle="modal" data-target="#modalRegistroManual">
                <span class="mr-3">Registrar entrada</span>
                <img src="<?= base_url() ?>public/img/icons/registrar.png" class="img-responsive ml-3" title="Registrar entrada" alt="Registrar entrada">
            </button>
        </div>
        <div class="col-12 offset-md-1 col-md-3">
            <button class="btn btn-raised py-1" style="background: lightgray;" type="button" data-toggle="modal" data-target="#modalLerTag">
                <span class="mr-3">Ler Tag Rfid</span>
                <img src="<?= base_url() ?>public/img/icons/rfid.png" class="img-responsive ml-3" title="Ler Tag RFID" alt="Ler Tag Rfid">
            </button>
        </div>
    <?php endif; ?>
</div>
<hr class="my-3">
<div class="table-responsive">
    <table class="table table-sm responsive table-striped table-hover table-datepicker" id="tableRegistros" style="width: 100%;">
        <caption style="caption-side: top;">
            <div class="div-datepicker"></div>
        </caption>
        <thead class="bg-default-primary">
            <tr>
                <th></th>
                <th class="all">Hora entrada</th>
                <th class="desktop">Obs entrada</th>
                <th class="all">Func. entrada</th>
                <th class="none">Nº trava:</th>
                <th class="all">Bicicleta</th>
                <th class="min-tablet">Usuário</th>
                <th class="none">Hora saída:</th>
                <th class="none">Obs saída:</th>
                <th class="none">Funcionário saída:</th>
                <th class="min-tablet"><i>Check Out</i></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
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
                        <div id="divSelectBicicleta" class="form-group col-12 ">
                            <label for="selectBicicleta" class="bmd-label-floating">
                                Selecione a bicicleta
                            </label>
                            <select class="form-control" id="selectBicicleta" name="id_bicicleta">
                                <option value="">Primeiramente, selecione um usuário.</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputObs">Observações sobre a entrada</label>
                        <textarea class="form-control" id="inputObs" name="obs" maxlength="255"></textarea>
                    </div>
                    <div id="divInputNumTrava" class="form-group">
                        <label for="inputNumTrava">Número do cadeado utilizado (0 para nenhum)</label>
                        <input type="number" class="form-control" id="inputNumTrava" name="num_trava" min="0" max="15" value="0">
                        <span class="invalid-feedback"></span>
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
<br>
<!-- Fim modal registrar entrada -->
<!--------------------------------->
<!-- Modal registro automático -->
<button id="openModalRegistroAutomatico" data-toggle="modal" data-target="#modalRegistroAutomatico" class="hidden"></button>
<div id="modalRegistroAutomatico" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header raised pb-3">
                <h3 class="modal-title">Confirme as informações</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formRegistroAutomatico">
                <div class="modal-body">
                    <h5>Passe o mouse para mais informações</h5>
                    <div class="form-row text-center">
                        <div id="bikeInfo" class="form-group col-12 col-md-6">
                            <input type="hidden" name="id_bicicleta" id="bikeId">
                            <img rel="popover" width="128px" id="fotoBicicleta" src="#" alt="Foto da bicicleta" class="img-thumbnail img-responsive">
                            <h6 id="spanBicicleta">Bicicleta</h6>
                        </div>
                        <div id="userInfo" class="form-group col-12 col-md-6">
                            <img rel="popover" width="128px" id="fotoUsuario" src="#" alt="Foto do usuário" class="img-thumbnail img-responsive">
                            <h6 id="spanUsuario">Usuário</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="inputObs">Observações sobre a entrada</label>
                        <textarea class="form-control" id="inputObs" name="obs" maxlength="255"></textarea>
                    </div>
                    <div id="divInputNumTrava" class="form-group">
                        <label for="inputNumTrava">Número do cadeado utilizado (0 para nenhum)</label>
                        <input type="number" class="form-control" id="inputNumTrava" name="num_trava" min="0" max="15" value="0">
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-raised btn-primary"><i>Check-in</i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim Modal registro automático -->

<?php
include_once('public/views/dialogs/modalPesquisarUsuario.html');
include_once('public/views/dialogs/modalLerTag.html');
include_once('public/views/dialogs/popperZoomImagem.html');
include_once('public/views/dialogs/popperInfo.html');
?>