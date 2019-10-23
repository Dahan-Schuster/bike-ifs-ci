<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin') { ?>
        <a class="col-sm-12 col-md-6 col-lg-4 btn btn-success mu-0 mb-3" href="?pagina=cadastros" role="button">
            Voltar para o menu de cadastros
        </a>
        <div class="jumbotron jumbotron-cadastro">
            <div class="col-md-12 col-md-offset-2">
                <h1>Cadastrar administrador</h1>
                <div class="alert alert-info" role="alert">
                    Campos marcados com <span class="text-danger"><b>*</b></span> são obrigatórios
                </div>
                <hr class="my-3">
                <form id="formCadastroAdmin" autocomplete="off" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-lg-12">
                            <label for="inputCor">Nome <span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="nome" class="form-control" id="inputNome" required>
                            <div class="invalid-feedback">
                                Por favor, informe seu nome.
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="inputEmail">E-mail <span class="text-danger"><b>*</b></span></label>
                            <input type="email" name="email" class="form-control" id="inputEmail" required>
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="inputCpf" class="mr-5">
                                CPF <span class="text-danger"><b>*</b></span>
                            </label>
                            <input type="hidden" id="radioCPF" checked>
                            <input type="text" name="documento" class="form-control" id="inputCpf" placeholder="CPF" required>
                            <div class="invalid-feedback">
                                Por favor, informe seu CPF.
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="inputSenha">Senha <span class="text-danger"><b>*</b></span></label>
                            <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="Informe uma senha" required>
                            <div class="invalid-feedback">
                                Por favor, insira uma senha.
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="inputReSenha">Confirmação de senha <span class="text-danger"><b>*</b></span></label>
                            <input type="password" class="form-control" id="inputReSenha" placeholder="Repita a senha" required>
                            <div class="invalid-feedback">
                                Por favor, repita a senha.
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
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
include_once('../modals/modalAdminJaCadastrado.html');
include_once('../modals/modalErroCadastro.html');
?>
<script type="text/javascript">
    $('#formCadastroAdmin').submit(function(form) {

        form.preventDefault();

        if (!this.checkValidity())
            return;

        else if (!validarDados())
            return;

        var url = "http://bikeifs.com/app/src/controller/inserir/admin.php";

        var nome = $("#inputNome").val();
        var email = $("#inputEmail").val();
        var documento = $("#inputCpf").val();
        var senha = $("#inputSenha").val();

        $.ajax({
            type: "POST",
            url: url,
            data: {
                nome,
                email,
                documento,
                senha
            },
            success: function(resultado) {
                console.log(resultado)
                if (resultado === 'error_1') {
                    $("#modalAdminJaCadastrado").modal('show');
                } else if (resultado === 'error_2') {
                    $("#modalErroCadastro").modal('show');
                } else if (resultado === 'success') {
                    url = "<?php echo $uri . '/public/view/' . $_SESSION['tipoAcesso'] . '/?pagina=cadastrarOutro&obj=Admin' ?>";
                    $(location).attr('href', url);
                }
            }
        })

    });
</script>