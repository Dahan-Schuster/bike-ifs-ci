<?php
@session_start();
if (isset($_SESSION['login']) and ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario')) { ?>

    <head>
        <link rel="stylesheet" type="text/css" href="http://bikeifs.com/public/lib/css/perfil.css">
    </head>
    <h2>Perfil de funcionário</h2>
    <hr>
    <div class="jumbotron jumbotron-cadastro pt-3 pl-2">
        <div class="col-md-12 col-md-offset-2">
            <div class="row perfil">
                <div class="col-lg-3 col-md-5">
                    <div class="perfil-sidebar pb-3">
                        <div class="perfil-foto">
                            <img src="http://bikeifs.com/public/img/icons/manager.png" title="Funcionário" class="img-responsive" alt="Funcionário">
                        </div>
                        <div class="perfil-titulo">
                            <div id="perfil-nome" class="perfil-titulo-nome">
                            </div>
                            <div id="perfil-tipo" class="perfil-titulo-tipo">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-7 conteudo-perfil" id="conteudo-perfil">
                    <div class="form-group row">
                        <label for="nome" class="col-md-4 col-form-label">Nome</label>
                        <div class="col-md-8">
                            <span id="nome" class="form-control"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefone" class="col-md-4 col-form-label">Telefone</label>
                        <div class="col-md-8">
                            <span id="telefone" class="form-control"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Email</label>
                        <div class="col-md-8">
                            <span id="email" class="form-control"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cpf" class="col-md-4 col-form-label">CPF</label>
                        <div class="col-md-8">
                            <span id="cpf" class="form-control"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger" role="alert">
        É necessário fazer login como funcionário ou administrador para acessar esta página.
    </div>
<?php } ?>
<br>
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/carregar/funcionario-por-id.php',
            data: {
                funcionario: "<?php echo $_GET['fun'] ?>"
            },
            success: function(funcionario) {
                $("#perfil-nome").html(funcionario.nome.split(" ")[0]);
                $("#perfil-tipo").html(funcionario.documento);
                $("#nome").html(funcionario.nome);
                $("#telefone").html(funcionario.telefone);
                $("#email").html(funcionario.email);
                $("#cpf").html(funcionario.documento);
            }
        });
    });
</script>