<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario') { ?>
        <a class="col-sm-12 col-md-6 col-lg-4 btn btn-success mu-0 mb-3" href="?pagina=cadastros" role="button">
            Voltar para o menu de cadastros
        </a>
        <div class="jumbotron jumbotron-cadastro">
            <div class="col-md-12 col-md-offset-2">
                <h1>Cadastrar etiqueta RFID</h1>
                <div class="alert alert-info" role="alert">
                    Campos marcados com <span class="text-danger"><b>*</b></span> são obrigatórios
                </div>
                <hr class="my-3">
                <form id="formCadastroEtiqueta" autocomplete="off" class="needs-validation" novalidate>

                    <div class="form-group row">
                        <label for="inputUID" class="col-md-4 col-form-label">
                            Código (<i>UID</i>) <span class="text-danger"><b>*</b></span></label>
                        <span class="form-control col-12 col-md-6 mb-1" id="inputUID">UID da bicicleta</span>
                        <div class="col-12 col-md-2">
                            <button type="button" class="btn btn-warning py-0" data-toggle="modal" data-target="#modalLerTag" style="width: 100%;">
                                <img src="http://bikeifs.com/public/img/icons/rfid.png" class="img-responsive" title="Ler Tag RFID" alt="Ler Tag Rfid">
                            </button>
                        </div>
                        <div class="invalid-feedback">
                            Por favor, informe o código hexadecimal da etiqueta RFID.
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selectUsuario" class="col-md-4 col-form-label">Usuário <span class="text-danger"><b>*</b></span></label>
                        <select id="selectUsuario" class="form-control col-9 col-md-6" required>
                            <option value="">Selecione um usuário</option>
                        </select>
                        <div class="col-3 col-md-2">
                            <button type="button" class="btn btn-info py-1" data-toggle="modal" data-target="#modalPesquisarUsuario" style="width: 100%;">
                                <img src="http://bikeifs.com/public/img/icons/search.png" title="Pesquisar usuário" alt="Pesquisar">
                            </button>
                        </div>
                        <div class="invalid-feedback">
                            Por favor, selecione o usuário dono da bicicleta.
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selectBike" class="col-md-4 col-form-label">Bicicleta <span class="text-danger"><b>*</b></span></label>
                        <select id="selectBike" name='bicicleta' class="form-control col-md-8" required>
                            <option value="">Primeiramente, selecione um usuário.</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, selecione a bicicleta.
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selectedBikeColor" class="col-md-4 col-form-label">Cor da bicicleta selecionada</label>
                        <div id="selectedBikeColor" class="form-control bike-color col-md-8">
                            <img src="http://bikeifs.com/public/img/icons/bycicle.png" title="Bike" alt="">
                        </div>
                    </div>

                    <hr class="my-3">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Você não tem permissão para acessar esta página.
        </div>
    <?php }
    } else { ?>
    <div class="alert alert-danger" role="alert">
        É necessário fazer login para acessar esta página.
    </div>
<?php } ?>
<br>
<?php
include_once('../modals/modalPesquisarUsuario.html');
include_once('../modals/modalTagJaCadastrada.html');
include_once('../modals/modalCodigoJaCadastrado.html');
include_once('../modals/modalLerTag.html');
include_once('../modals/modalErroCadastro.html');
?>
<script language="javascript" src="http://bikeifs.com/public/lib/scripts/pesquisar.usuario.js"></script>
<script language="JavaScript" src="http://bikeifs.com/public/lib/scripts/escolher.cores.slim.js"></script>
<script type="text/javascript">
    var tabelaUsuarios;
    $(document).ready(function() {
        preencherSelectUsuario();
        tabelaUsuarios = popularTabelaPesquisarUsuario();
        configurarModalPesquisarUsuarios(tabelaUsuarios);
        configurarModalLerTag();
        configurarSelectBicicleta();
    });

    function configurarSelectBicicleta() {

        // Atualizar select bicicleta ao escolher um usuário
        $('#selectUsuario').on('change', function() {
            var usuarioID = $(this).val();
            if (usuarioID) {
                $.ajax({
                    type: 'POST',
                    url: '../../../app/src/controller/gerar-opcoes-select-de-bikes-por-usuario.php',
                    data: 'id_usuario=' + usuarioID,
                    success: function(html) {
                        $('#selectBike').html(html);
                    }
                });
            } else {
                $('#selectBike').html('<option value="">Primeiramente, selecione um usuário.</option>');
            }
        });

        // Altera a cor do select de acordo com a bicicleta selecionada
        $('#selectBike').on('change', function() {
            var cores = $('#selectBike option:selected').data('color');
            atualizarArrayCores(cores);
            cssBackground = criarCssBackground();
            $('#selectedBikeColor').css('background', cssBackground)
        });

    }

    $('#formCadastroEtiqueta').submit(function(form) {
        form.preventDefault();

        if (!this.checkValidity())
            return;

        var url = "http://bikeifs.com/app/src/controller/inserir/etiqueta.php";

        var uid = $("#inputUID").html();
        var id_bicicleta = $("#selectBike").val();

        $.ajax({
            type: "POST",
            url: url,
            data: {
                "uid": uid,
                "bicicleta": id_bicicleta
            },
            success: function(resultado) {
                if (resultado === 'error_1') {
                    alert('Código inválido');
                } else if (resultado === 'error_2') {
                    $("#modalTagJaCadastrada").modal('show');
                } else if (resultado === 'error_3') {
                    $("#modalCodigoJaCadastrado").modal('show');
                } else if (resultado === 'error_4') {
                    $("#modalErroCadastro").modal('show');
                } else if (resultado === 'success') {
                    url = "<?php echo $uri . '/public/view/' . $_SESSION['tipoAcesso'] . '/?pagina=cadastrarOutro&obj=Tag' ?>";
                    $(location).attr('href', url);
                }
            }
        })
    });
</script>