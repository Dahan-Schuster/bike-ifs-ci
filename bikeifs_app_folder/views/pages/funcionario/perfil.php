<?php
@session_start();
if (isset($_SESSION['login']) and $_SESSION['tipoAcesso'] == 'funcionario') { ?>

    <head>
        <link rel="stylesheet" type="text/css" href="./../../css/perfil.css">
    </head>
    <h2>Perfil de funcionário</h2>
    <hr>
    <div class="jumbotron jumbotron-cadastro pt-3 pl-2">
        <div class="col-md-12 col-md-offset-2">
            <div class="row perfil">
                <div class="col-lg-3 col-md-5">
                    <div class="perfil-sidebar">
                        <div class="perfil-foto">
                            <img src="<?= base_url() ?>/public/img/icons/manager.png" title="Funcionário" class="img-responsive" alt="Funcionário">
                        </div>
                        <div class="perfil-titulo">
                            <div id="perfil-nome" class="perfil-titulo-nome">
                            </div>
                            <div id="perfil-tipo" class="perfil-titulo-tipo">
                            </div>
                        </div>
                        <div class="perfil-menu">
                            <ul class="nav">
                                <li>
                                    <button id="btn-info">
                                        <img src="<?= base_url() ?>/public/img/icons/info.png" title="Informações da Conta" alt="Informações">
                                        <span>Informações</span>
                                    </button>
                                </li>
                                <li>
                                    <button id="btn-config">
                                        <img src="<?= base_url() ?>/public/img/icons/management.png" title="Configurações da Conta" alt="Configurações">
                                        <span>Configurações da conta</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-7 conteudo-perfil" id="conteudo-perfil">
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger" role="alert">
        É necessário fazer login para acessar esta página.
    </div>
<?php } ?>
<br>
<script>
    $(document).ready(function() {

        $('#conteudo-perfil').load('funcionario-info.php');

        $("#btn-info").click(function() {
            $('#conteudo-perfil').load('funcionario-info.php');
        });

        $("#btn-config").click(function() {
            $('#conteudo-perfil').load('funcionario-config.php');
        });

        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/carregar/funcionario-por-id.php',
            data: {
                funcionario: "<?php echo $_SESSION['id'] ?>"
            },
            success: function(funcionario) {
                $("#perfil-nome").html(funcionario.nome.split(" ")[0]); // Retorna apenas o primeiro nome
                $("#perfil-tipo").html(funcionario.cpf);
            }
        });
    });
</script>