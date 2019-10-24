<?php
@session_start();
if (isset($_SESSION['login']) and ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario' || $_SESSION['tipoAcesso'] == 'usuario')) { ?>

    <head>
        <link rel="stylesheet" type="text/css" href="./../../css/perfil.css">
    </head>
    <h2>Perfil de usuário</h2>
    <hr>
    <div class="jumbotron jumbotron-cadastro pt-3 pl-2">
        <div class="col-md-12 col-md-offset-2">
            <div class="row perfil">
                <div class="col-lg-3 col-md-5">
                    <div class="perfil-sidebar pb-3">
                        <div class="perfil-foto">
                            <img src="<?= base_url() ?>/public/img/icons/cyclist.png" title="Usuário" class="img-responsive" alt="Usuário">
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
                                    <button type="button" data-toggle="modal" data-target="#modalBicicletasUsuario">
                                        <img src="<?= base_url() ?>/public/img/icons/bikes.png" title="Bicicletas do usuário" alt="Bicicletas">
                                        <span>Bicicletas</span>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" data-toggle="modal" data-target="#modalHistoricoUsuario">
                                        <img src="<?= base_url() ?>/public/img/icons/history.png" title="Histórico do usuário" alt="Histórico">
                                        <span>Histórico do usuário</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-7 conteudo-perfil" id="conteudo-perfil">
                    <div class="form-group row">
                        <label for="nome" class="col-md-4 col-form-label">Nome</label>
                        <div class="col-md-8">
                            <span id="nome" name="nome" class="form-control"></span>
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
                    <hr class="my-4">
                    <div class="form-group row">
                        <label for="tipo" class="col-md-4 col-form-label">Tipo de usuário</label>
                        <div class="col-md-8">
                            <span id="tipo" class="form-control"></span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="situacao" class="col-md-4 col-form-label">Situação</label>
                        <div class="col-md-8">
                            <span id="situacao" class="form-control"></span>
                        </div>
                    </div>
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
<?php
include_once('../modals/modalBicicletasUsuario.html');
include_once('../modals/modalHistoricoUsuario.html');
?>
<script language="javascript" src="<?= base_url() ?>/public/js/bicicletas.usuario.js"></script>
<script language="javascript" src="<?= base_url() ?>/public/js/historico.usuario.js"></script>
<script language="JavaScript" src="<?= base_url() ?>/public/js/escolher.cores.slim.js"></script>
<script>
    var tabelaHistorico;
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/carregar/usuario-por-id.php',
            data: {
                user: "<?php echo $_GET['user'] ?>"
            },
            success: function(user) {
                $("#perfil-nome").html(user.nome.split(" ")[0]);
                $("#perfil-tipo").html(user.tipo);
                $("#nome").html(user.nome);
                $("#telefone").html(user.telefone);
                $("#email").html(user.email);
                $("#tipo").html(user.tipo);
                $("#situacao").html(user.situacao);

                popularTabelaBicicletasUsuario(user.id);
                configurarModalBicicletasUsuarios();

                tabelaHistorico = popularTabelaHistoricoUsuario(user.id);
                configurarModalHistoricoUsuarios(tabelaHistorico);
            }
        });
    });

</script>