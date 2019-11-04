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
                    <img src="<?= base_url('public/img/icons/manager.png') ?>" title="Usuário" class="img-responsive" alt="Usuário">
                </div>
                <div class="perfil-titulo">
                    <div id="perfil-nome" class="perfil-titulo-nome">
                        <?= $funcionario->nome ?>
                    </div>
                </div>
            </div>

            <div class="conteudo-perfil" id="conteudo-perfil">
                <div id="informacoes">
                    <div class="form-group row">
                        <label for="nome" class="col-md-4 col-form-label"><b>Nome</b></label>
                        <div class="col-md-8">
                            <span id="nome" name="nome"><?= $funcionario->nome ?></span>
                        </div>
                    </div>
                    <hr class="my-0 py-0">
                    <div class="form-group row">
                        <label for="telefone" class="col-md-4 col-form-label"><b>Telefone</b></label>
                        <div class="col-md-8">
                            <span id="telefone"><?= trim($funcionario->telefone) ? $funcionario->telefone : 'Não informado' ?></span>
                        </div>
                    </div>
                    <hr class="my-0 py-0">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label"><b>Email</b></label>
                        <div class="col-md-8">
                            <span id="email"><?= $funcionario->email ?></span>
                        </div>
                    </div>
                    <hr class="my-0 py-0">
                    <div class="form-group row">
                        <label for="cpf" class="col-md-4 col-form-label"><b>CPF</b></label>
                        <div class="col-md-8">
                            <span id="cpf"><?= $funcionario->cpf ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>