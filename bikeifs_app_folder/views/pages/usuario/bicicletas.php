<?php require_once APPPATH . 'models/ModeloBike.php'; ?>
<div class="row">
    <span class="col-12">
        <h3>Minhas bikes</h3>
    </span>
</div>
<hr class="my-3">
<div class="table-responsive">
    <table class="table table-sm responsive table-striped table-hover" id="tableBikes" style="width: 100%;">
        <caption>
            &nbsp;
            <button data-toggle="modal" data-target="#modalSalvarBike" data-backdrop="static" data-keyboard="false" title="Cadastrar novo" type="button" class="btn btn-primary bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">add</i>
            </button>
            <button id="btnAtivarSelecionados" onclick="ativarBicicletasSelecionadas()" title="Ativar selecionadas" type="button" class="btn btn-info bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">thumb_up</i>
            </button>
            <button id="btnDestivarSelecionados" onclick="desativarBicicletasSelecionadas()" title="Desativar selecionadas" type="button" class="btn btn-danger bmd-btn-fab bmd-btn-fab-sm">
                <i class="material-icons">thumb_down</i>
            </button>
            <button id="btnSelecionarLinhas" title="Selecionar todos" type="button" class="btn accent-color bmd-btn-fab bmd-btn-fab-sm text-light">
                <i class="material-icons">check_box_outline_blank</i>
            </button>
        </caption>
        <thead class="bg-default-primary">
            <tr>
                <th>&#9432;</th>
                <th class="min-tablet">Cores</th>
                <th class="min-desktop">Foto</th>
                <th class="none">Modelo</th>
                <th>Marca</th>
                <th class="none">Obs</th>
                <th class="min-tablet">Aro</th>
                <th>Situacao</th>
                <th>Verificada</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<br>
<!-- Modal salvar bicicleta -->
<div id="modalSalvarBike" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header raised pb-3">
                <h3 class="modal-title">Salvar bicicleta</h3>
                <button type="button" class="close closePopover" data-dismiss="modal">&times;</button>
            </div>
            <form id="formSalvarBike" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="idBicicleta" name="id">
                    <div id="divInputCores" class="form-group">
                        <label for="inputCores" class="bmd-label-floating mb-0 pb-0">Cor</label>
                        <input name="cores" type="hidden" id="inputCores">
                        <div class="input-group">
                            <div id="divCores" class="form-control bike-color">
                                <i class="material-icons">directions_bike</i>
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="btn" id="btnPalette">
                                    <i class="material-icons">palette</i>
                                </button>
                            </div>
                        </div>
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label for="bike_img" class="bmd-label-floating mb-0 pb-0">Foto</label>
                        <div class="col-lg-12">
                            <img rel="popover" class="img-fluid img-thumbnail img-zoom" src="" id="bike_img">
                            <label class="btn btn-info">
                                <i class="material-icons"></i>&nbsp;&nbsp;Importar imagem
                                <input type="file" id="btn_upload_bike_img" accept="image/*" style="display: none">
                            </label>
                            <input type="hidden" id="bike_img_path" name="foto_url">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div id="divInputMarca" class="form-group col-12 col-sm-4">
                            <label for="inputMarca" class="bmd-label-floating mb-3">Marca</label>
                            <input name="marca" type="text" placeholder="Caloi, Shimano etc" class="form-control" id="inputMarca">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div id="divInputAro" class="form-group col-12 col-sm-4">
                            <label for="inputAro" class="bmd-label-floating mb-3">Aro</label>
                            <input name="aro" type="number" placeholder="20, 24, 26 etc" class="form-control" id="inputAro">
                            <span class="invalid-feedback"></span>
                        </div>
                        <div id="divSelectModelo" class="form-group col-12 col-sm-4">
                            <label for="selectModelo" class="bmd-label-floating">Modelo</label>
                            <select name="modelo" class="form-control" id="selectModelo">
                                <option value="">Selecione</option>
                                <option value="<?= ModeloBike::URBANA ?>">Urbana</option>
                                <option value="<?= ModeloBike::DOBRAVEL ?>">Dobrável</option>
                                <option value="<?= ModeloBike::FIXA ?>">Fixa</option>
                                <option value="<?= ModeloBike::MOUNTAIN ?>">Mountain</option>
                                <option value="<?= ModeloBike::SPEED ?>">Speed</option>
                                <option value="<?= ModeloBike::BMX ?>">BMX</option>
                                <option value="<?= ModeloBike::DOWNHILL ?>">Downhill</option>
                                <option value="<?= ModeloBike::ELETRICA ?>">Elétrica</option>
                            </select>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div id="divInputObs" class="form-group">
                        <label for="inputObs" class="bmd-label-floating">Observações sobre a bicicleta</label>
                        <textarea name="obs" class="form-control" id="inputObs"></textarea>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto closePopover" data-dismiss="modal">Cancelar</button>
                    <button id="btnEnviar" type="submit" class="btn btn-primary closePopover">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim modal salvar bicicleta -->
<!---------------------->

<?php include_once('public/views/dialogs/popperEscolherCores.html'); ?>
<?php include_once('public/views/dialogs/popperZoomImagem.html'); ?>
<script>
    const id_usuario = <?= $id_usuario ?>
</script>