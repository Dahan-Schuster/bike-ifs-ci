<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/public/css/perfil.css">
</head>

<body id="body-perfil-sidepanel">
    <div id="conteudo-perfil-sidepanel" class="container-fluid">
        <div class="perfil">
            <div class="perfil-sidebar pb-3">
                <div class="perfil-foto">
                    <img src="<?= base_url() ?>/public/img/icons/manager.png" title="Funcionário" class="img-responsive" alt="Funcionário">
                </div>
                <div class="perfil-titulo">
                    <div id="perfil-nome" class="perfil-titulo-nome">
                    </div>
                    <div id="perfil-tipo" class="perfil-titulo-tipo">
                    </div>
                </div>
            </div>

            <div class="conteudo-perfil" id="conteudo-perfil">
                <div class="form-group row">
                    <label for="nome" class="col-md-4 col-form-label"><b>Nome</b></label>
                    <div class="col-md-8">
                        <span id="nome"></span>
                    </div>
                </div>
                <hr class="my-0 py-0">
                <div class="form-group row">
                    <label for="telefone" class="col-md-4 col-form-label"><b>Telefone</b></label>
                    <div class="col-md-8">
                        <span id="telefone"></span>
                    </div>
                </div>
                <hr class="my-0 py-0">
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label"><b>Email</b></label>
                    <div class="col-md-8">
                        <span id="email"></span>
                    </div>
                </div>
                <hr class="my-0 py-0">
                <div class="form-group row">
                    <label for="cpf" class="col-md-4 col-form-label"><b>CPF</b></label>
                    <div class="col-md-8">
                        <span id="cpf"></span>
                    </div>
                </div>
                <hr class="my-4 bg-dark">
                <div class="form-group row">
                    <label for="situacao" class="col-4 col-form-label"><b>Situação</b></label>
                    <div class="col-4 pt-2">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="switchSituacao">
                            <label id="situacao" class="custom-control-label" for="switchSituacao"></label>
                        </div>
                    </div>
                </div>
                <hr class="my-4 bg-dark">
                <a href="javascript:void(0)" onclick="abrirPaginaPerfil()">Abrir perfil em uma nova guia &nearhk;</a>
            </div>
        </div>
    </div>
    <!-- SnackBars -->
    <div class="snackbar snackbar-invalido" id="alertaInvalido"></div>
    <div class="snackbar snackbar-sucesso" id="alertaSucesso"></div>
    <!-- Fim SnackBars -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script language="javascript" src="<?= base_url() ?>/public/js/ferramentas.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/carregar/funcionario-por-id.php',
            data: {
                funcionario: "<?php echo $_GET['fun'] ?>"
            },
            success: function(funcionario) {
                atualizarCamposComDadosDoFuncionario(funcionario)
            }
        });
    });

    $("#switchSituacao").on('change', function() {
        alterarSituacaoFuncionario()
    })

    function alterarSituacaoFuncionario() {
        if ($("#situacao").html() == 'Ativo')
            desativar()
        else if ($("#situacao").html() == 'Inativo')
            ativar()
    }

    function ativar() {
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/ativar/funcionario.php',
            data: {
                "fun": "<?php echo $_GET['fun'] ?>"
            },
            success: function(fun) {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                atualizarCamposComDadosDoFuncionario(fun)
            }
        });
    }

    function desativar() {
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/desativar/funcionario.php',
            data: {
                "fun": "<?php echo $_GET['fun'] ?>"
            },
            success: function(fun) {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                atualizarCamposComDadosDoFuncionario(fun)
            }
        });
    }

    function atualizarCamposComDadosDoFuncionario(funcionario) {
        $("#perfil-nome").html(funcionario.nome.split(" ")[0]);
        $("#perfil-tipo").html(funcionario.cpf);
        $("#nome").html(funcionario.nome);
        $("#telefone").html(funcionario.telefone);
        $("#email").html(funcionario.email);
        $("#cpf").html(funcionario.cpf);
        $("#situacao").html(funcionario.situacao)
        if (funcionario.situacao == 'Ativo')
            $("#switchSituacao").attr('checked', 'true')
    }

    function abrirPaginaPerfil() {
        let url = parent.location.origin + parent.location.pathname + '?pagina=perfil_funcionario&fun=<?php echo $_GET['fun'] ?>'
        open(url)
    }
</script>

</html>