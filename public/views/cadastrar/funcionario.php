<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin') { ?>
        <a class="col-sm-12 col-md-6 col-lg-4 btn btn-success mu-0 mb-3" href="?pagina=cadastros" role="button">
            Voltar para o menu de cadastros
        </a>
        <div class="jumbotron jumbotron-cadastro">
            <div class="col-md-12 col-md-offset-2">
                <h1>Cadastrar funcionário</h1>
                <div class="alert alert-info" role="alert">
                    Campos marcados com <span class="text-danger"><b>*</b></span> são obrigatórios
                </div>
                <hr class="my-3">
                <form id="formCadastroFuncionario" autocomplete="off" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="inputCor">Nome <span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="nome" class="form-control" id="inputNome" required>
                            <div class="invalid-feedback">
                                Por favor, informe seu nome.
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="inputTel">Telefone</label>
                            <input type="text" name="telefone" class="form-control" id="inputTel">
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="inputEmail">E-mail</label>
                            <input type="email" name="email" class="form-control" id="inputEmail">
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="inputCpf" class="mr-5">
                                CPF <span class="text-danger"><b>*</b></span>
                            </label>
                            <input type="hidden" id="radioCPF" checked>
                            <input type="text" name="cpf" class="form-control" id="inputCpf" placeholder="CPF" required>
                            <div class="invalid-feedback">
                                Por favor, informe seu CPF.
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="inputSenha">Senha <span class="text-danger"><b>*</b></span></label>
                            <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="Informe uma senha" required>
                            <div class="invalid-feedback">
                                Por favor, insira uma senha.
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="inputReSenha">Confirmação de senha <span class="text-danger"><b>*</b></span></label>
                            <input type="password" class="form-control" id="inputReSenha" placeholder="Repita a senha" required>
                            <div class="invalid-feedback">
                                Por favor, repita a senha.
                            </div>
                        </div>
                    </div>
                    <hr class="my-3">
                    <input type="submit" value="Cadastrar" class="btn btn-success">
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
include_once('../modals/modalFuncionarioJaCadastrado.html');
include_once('../modals/modalErroCadastro.html');
?>
<script type="text/javascript">
    $('#formCadastroFuncionario').submit(function(form) {
        form.preventDefault();

        if (!this.checkValidity())
            return;

        else if (!validarDados())
            return;

        var url = "<?= base_url() ?>/app/src/controller/inserir/funcionario.php";

        var nome = $("#inputNome").val();
        var telefone = $("#inputTel").val();
        var email = $("#inputEmail").val();
        var cpf = $("#inputCpf").val();
        var senha = $("#inputSenha").val();

        $.ajax({
            type: "POST",
            url,
            data: {
                nome,
                telefone,
                email,
                cpf,
                senha
            },
            success: function(resultado) {
                console.log(resultado)
                if (resultado === 'error_1') {
                    $("#modalFuncionarioJaCadastrado").modal('show');
                } else if (resultado === 'error_2') {
                    $("#modalErroCadastro").modal('show');
                } else if (resultado === 'success') {
                    url = "<?php echo $uri . '/public/view/' . $_SESSION['tipoAcesso'] . '/?pagina=cadastrarOutro&obj=Funcionario' ?>";
                    $(location).attr('href', url);
                }
            }
        })
    });
</script>