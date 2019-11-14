<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/snackbar.min.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/palette.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/perfil.css">
</head>

<body style="font-size: 10pt;" id="body-perfil-sidepanel">
    <div id="conteudo-perfil-sidepanel" class="container-fluid">
        <div class="perfil">
            <div class="perfil-sidebar pb-3">
                <div class="perfil-foto">
                    <img src="<?= $bicicleta->foto ?>" id="modelo-bike-colorido" title="Bicicleta" class="img-responsive" alt="Bicicleta">
                </div>
                <div class="perfil-titulo">
                    <div id="bike-modelo" class="perfil-titulo-nome">
                        <?= $bicicleta->nome_modelo ?>
                    </div>
                </div>
            </div>

            <div class="conteudo-perfil" id="conteudo-perfil">
                <div class="form-group row">
                    <label for="cor" class="col-12 col-form-label"><b>Cor</b></label>
                    <div class="col-12 pt-2">
                        <div id="cor" class="bike-color" style="background: <?= $bicicleta->cores ?>;">
                            <img src="<?= base_url() ?>public/img/icons/bike-<?= mb_strtolower($bicicleta->nome_modelo) ?>.png" id="modelo-icone" title="Cor" alt="cor">
                        </div>
                    </div>
                </div>
                <hr class="py-0 my-0">
                <div class="form-group row">
                    <label for="aro" class="col-md-4 col-form-label"><b>Aro</b></label>
                    <div class="col-md-8">
                        <span id="aro"> <?= $bicicleta->aro ?></span>
                    </div>
                </div>
                <hr class="py-0 my-0">
                <div class="form-group row">
                    <label for="marca" class="col-md-4 col-form-label"><b>Marca</b></label>
                    <div class="col-md-8">
                        <span id="marca"> <?= trim($bicicleta->marca) ? $bicicleta->marca : 'Não informada' ?></span>
                    </div>
                </div>
                <hr class="py-0 my-0">
                <div class="form-group row">
                    <label for="situacao" class="col-4 col-form-label"><b>Situação</b></label>
                    <div class="col-4 pt-2">
                        <input onchange="alterarSituacaoBicicleta(id_bicicleta)" type="checkbox" class="custom-switch hidden" id="switchSituacao" <?= $bicicleta->situacao == 0 ? 'checked' : '' ?>>
                        <label class="custom-switch-label" for="switchSituacao"></label>
                    </div>
                </div>
                <hr class="py-0 my-3 bg-dark">
                <div class="form-group row">
                    <label for="dono" class="col-md-4 col-form-label"><b>Dono(a)</b></label>
                    <div class="col-md-8">
                        <span id="dono"><?= $bicicleta->dono ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="<?= base_url() ?>public/js/snackbar.min.js"></script>
<script src="<?= base_url() ?>public/js/util.js"></script>
<script>
    const id_bicicleta = <?= $bicicleta->id ?>;
    const id_usuario = <?= $bicicleta->id_usuario ?>;

    $(document).ready(function() {
        parent.abrirPerfilLateralUsuario(id_usuario)
    })
    
    function alterarSituacaoBicicleta(bike) {
        var ids_bicicletas = [bike];
        if (!$("#switchSituacao").is(':checked'))
            enviarAjaxDesativarBicicletas(ids_bicicletas)
        else 
            enviarAjaxAtivarBicicletas(ids_bicicletas)
    }

</script>

</html>