<div class="row">
    <span class="col-6">
        <h3>Registros do dia</h3>
    </span>
    <?php if ($pode_registrar) : ?>
        <button data-backdrop="static" class="btn btn-danger col-3" type="button" data-toggle="modal" data-target="#modalRegistroManual">
            <img src="<?= base_url() ?>/public/img/icons/rfid.png" class="img-responsive" title="Ler Tag RFID" alt="Ler Tag Rfid">
        </button>
        <button class="btn btn-danger col-3" type="button" data-toggle="modal" data-target="#modalLerTag">
            <img src="<?= base_url() ?>/public/img/icons/rfid.png" class="img-responsive" title="Ler Tag RFID" alt="Ler Tag Rfid">
        </button>
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

<?php
include_once('public/views/modals/modalsRegistro.php');
include_once('public/views/modals/modalPesquisarUsuario.html');
include_once('public/views/modals/modalLerTag.html');
?>