<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/bootstrap-material-design.min.css">
     <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/palette.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/perfil.css">
</head>

<body style="font-size: 10pt;" id="body-perfil-sidepanel">
    <div id="conteudo-perfil-sidepanel" class="container-fluid">
        <div class="perfil">
            <div class="perfil-sidebar pb-3">
                <div class="perfil-foto">
                    <img src="<?= base_url('public/img/img-logo.png') ?>" title="Medalha" class="img-responsive" alt="Medalha">
                </div>
                <div class="perfil-titulo">
                    <div class="perfil-titulo-nome">
                        <?= $medalha->titulo ?>
                    </div>
                </div>
            </div>

            <div class="conteudo-perfil" id="conteudo-perfil">
                <div class="form-group row">
                    <label for="objetivo" class="col-md-4 col-form-label"><b>Você conseguiu esta medalha ao alcançar a marca de:</b></label>
                    <div class="col-md-8">
                        <span id="objetivo"> <?= $medalha->descricao_objetivo ?></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="data" class="col-md-4 col-form-label"><b>Medalha adquirida em:</b></label>
                    <div class="col-md-8">
                        <span id="data"> <?= $recompensa->data_hora ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>