<?php require_once(APPPATH.'models/ModeloBike.php'); ?>
<div class="row">
     <span class="col-12 col-md-6">
         <h3>Lista de bicicletas</h3>
     </span>
 </div>
 <hr class="my-3">
 <div class="table-responsive">
     <table class="table table-sm responsive table-striped table-hover" id="tableBikes" style="width: 100%;">
         <caption>
             &nbsp;
             <button data-toggle="modal" data-target="#modalSalvarBike" title="Cadastrar novo" type="button" class="btn btn-primary bmd-btn-fab bmd-btn-fab-sm">
                 <i class="material-icons">add</i>
             </button>
             <button id="btnAtivarSelecionados" onclick="ativarBikesSelecionadas()" title="Ativar selecionadas" type="button" class="btn btn-info bmd-btn-fab bmd-btn-fab-sm">
                 <i class="material-icons">thumb_up</i>
             </button>
             <button id="btnDestivarSelecionados" onclick="desativarBikesSelecionadas()" title="Desativar selecionadas" type="button" class="btn btn-danger bmd-btn-fab bmd-btn-fab-sm">
                 <i class="material-icons">thumb_down</i>
             </button>
             <button id="btnSelecionarLinhas" title="Selecionar todos" type="button" class="btn accent-color bmd-btn-fab bmd-btn-fab-sm text-light">
                 <i class="material-icons">check_box_outline_blank</i>
             </button>
         </caption>
         <thead class="bg-default-primary">
             <tr>
                 <th>&#9432;</th>
                 <th>Cor</th>
                 <th>Modelo</th>
                 <th>Marca</th>
                 <th class="none">Obs</th>
                 <th>Aro</th>
                 <th>Dono</th>
                 <th>Situacao</th>
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
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <form id="formCadastroAdmin" autocomplete="off">
                 <input type="hidden" id="id_bicicleta" name="id">
                 <div class="modal-body">
                     <div id="divInputCores" class="form-group">
                         <label for="inputCores" class="bmd-label-floating">Cor</label>
                         <input name="nome" type="hidden" id="inputCores">
                         <div class="input-group">
                             <div class="form-control bike-color"></div>
                             <div class="input-group-append">
                                 <button type="button" class="btn" data-toggle="modal" data-target="#modalEscolherCor">
                                     <i class="material-icons">palette</i>
                                 </button>
                             </div>
                         </div>
                         <span class="invalid-feedback"></span>
                     </div>
                     <div id="divInputMarca" class="form-group">
                         <label for="inputMarca" class="bmd-label-floating">Marca</label>
                         <input name="marca" type="text" placeholder="Caloi, Shimano, Scott etc" class="form-control" id="inputMarca">
                         <span class="invalid-feedback"></span>
                     </div>
                     <div id="divInputAro" class="form-group">
                         <label for="inputAro" class="bmd-label-floating">Aro</label>
                         <input name="aro" type="number" placeholder="20, 24, 26 etc" class="form-control" id="inputAro">
                         <span class="invalid-feedback"></span>
                     </div>
                     <div id="divSelectModelo" class="form-group">
                         <label for="selectModelo" class="bmd-label-floating">Modelo</label>
                         <select name="modelo" class="form-control" id="selectModelo">
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
                     <div id="divSelectUsuario" class="form-group">
                         <label for="selectUsuario" class="bmd-label-floating">Repita a senha</label>
                         <select name="id_usuario" class="form-control" id="selectUsuario">
                         </select>
                         <span class="invalid-feedback"></span>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                     <button id="btnEnviar" type="submit" class="btn btn-primary">Cadastrar</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- Fim modal salvar bicicleta -->
 <!---------------------->

 <?php include_once('public/views/modals/modalEscolherCor.html'); ?>
 <script language="JavaScript" src="<?= base_url() ?>/public/js/escolher.cores.js"></script>