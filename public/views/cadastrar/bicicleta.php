<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario') { ?>
        <a class="col-sm-12 col-md-6 col-lg-4 btn btn-success mu-0 mb-3" href="?pagina=cadastros" role="button">
            Voltar para o menu de cadastros
        </a>
        <div class="jumbotron jumbotron-cadastro">
            <div class="col-md-12 col-md-offset-2">
                <h1>Cadastrar bicicleta</h1>
                <div class="alert alert-info" role="alert">
                    Campos marcados com <span class="text-danger"><b>*</b></span> são obrigatórios
                </div>
                <hr class="my-3">
                <form id="formCadastroBicicleta" autocomplete="off" class="needs-validation" novalidate>

                    <div class="form-row">
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="inputCor">Cor <span class="text-danger"><b>*</b></span></label>
                            <div class="input-group">
                                <div class="form-control bike-color" id="inputCor" style="background: repeating-linear-gradient(45deg, rgb(0, 0, 0) 0%, rgb(0, 0, 0) 100%);">
                                    <img src="http://bikeifs.com/public/img/icons/bycicle.png" alt="" title="Escolher cor da bike">
                                </div>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEscolherCor" style="outline: none; box-shadow: none; padding: 0 .75rem;">
                                        <img src="http://bikeifs.com/public/img/icons/color.png" title="Escolher cor" alt="Escolher cor">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="selectModelo">Modelo <span class="text-danger"><b>*</b></span></label>
                            <select id="selectModelo" name='modelo' class="form-control" required>
                                <option value="">Selecione um modelo</option>
                                <option value="0">Urbana</option>
                                <option value="1">Dobrável</option>
                                <option value="2">Fixa</option>
                                <option value="3">Mountain</option>
                                <option value="4">Speed</option>
                                <option value="5">BMX</option>
                                <option value="6">Downhill</option>
                                <option value="7">Elétrica</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, selecione o modelo da bicicleta.
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="inputMarca">Marca</label>
                            <input type="text" name="marca" class="form-control" id="inputMarca" placeholder="Selecione uma marca">
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="inputAro">Aro <span class="text-danger"><b>*</b></span></label>
                            <input type="number" name="aro" class="form-control" id="inputAro" placeholder="Tamanho do aro" required>
                            <div class="invalid-feedback">
                                Por favor, informe o tamanho do aro da bicicleta.
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="selectUsuario" class="col-form-label">Usuário <span class="text-danger"><b>*</b></span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPesquisarUsuario" style="outline: none; box-shadow: none; padding: 0 .75rem;">
                                        <img src="http://bikeifs.com/public/img/icons/search.png" title="Pesquisar usuário" alt="Pesquisar">
                                    </button>
                                </div>
                                <select id="selectUsuario" class="form-control" required>
                                    <option value="">Selecione um usuário</option>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, selecione o usuário dono da bicicleta.
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="textareaObs">Observações sobre a bicicleta</label>
                            <textarea class="form-control" id="textareaObs" name="obs" maxlength="255"></textarea>
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
include_once('../modals/modalBikeJaCadastrada.html');
include_once('../modals/modalEscolherCor.html');
include_once('../modals/modalErroCadastro.html');
?>
<script language="javascript" src="http://bikeifs.com/public/lib/scripts/pesquisar.usuario.js"></script>
<script language="JavaScript" src="http://bikeifs.com/public/lib/scripts/escolher.cores.js"></script>
<script type="text/javascript">
    var tabelaUsuarios;

    $(document).ready(function() {
        preencherSelectUsuario();
        tabelaUsuarios = popularTabelaPesquisarUsuario();
        configurarModalPesquisarUsuarios(tabelaUsuarios);
    });

    $('#formCadastroBicicleta').submit(function(form) {
        form.preventDefault();

        if (!this.checkValidity())
            return;

        var url = "http://bikeifs.com/app/src/controller/inserir/bicicleta.php";

        var cores = stringArrayCores();
        var modelo = $("#selectModelo").val();
        var marca = $("#inputMarca").val();
        var aro = $("#inputAro").val();
        var id_usuario = $("#selectUsuario").val();
        var obs = $("#textareaObs").val();

        $.ajax({
            type: "POST",
            url: url,
            data: {
                cores,
                modelo,
                marca,
                aro,
                id_usuario,
                obs,
            },
            success: function(resultado) {
                if (resultado === 'error_1')
                    $("#modalBikeJaCadastrada").modal('show');
                else if (resultado === 'error_2')
                    $("#modalErroCadastro").modal('show');
                else if (resultado === 'success') {
                    url = "<?php echo $uri . '/public/view/' . $_SESSION['tipoAcesso'] . '/?pagina=cadastrarOutro&obj=Bicicleta' ?>";
                    $(location).attr('href', url);
                }
            }
        })

    });
</script>