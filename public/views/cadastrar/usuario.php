<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario') { ?>
        <a class="col-sm-12 col-md-6 col-lg-4 btn btn-success mu-0 mb-3" href="?pagina=cadastros" role="button">
            Voltar para o menu de cadastros
        </a>
        <div class="jumbotron jumbotron-cadastro">
            <div class="col-md-12 col-md-offset-2">
                <h1>Cadastrar usuário</h1>
                <div class="alert alert-info" role="alert">
                    Campos marcados com <span class="text-danger"><b>*</b></span> são obrigatórios
                </div>
                <hr class="my-3">
                <div class="form-row">
                    <label for="inputMatricula" class="col-form-label py-0 my-1">
                        <h4>
                            <span class="badge badge-secondary">
                                Pesquisar por matrícula
                            </span>
                        </h4>
                    </label>
                    <div class="form-group col-md-6 col-lg-6">
                        <div class="input-group">
                            <div class="autocomplete" style="width:100%;">
                                <input autocomplete="off" id="inputMatricula" class="form-control" type="text" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <form id="formCadastroUsuario" autocomplete="off" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="inputCor">Nome <span class="text-danger"><b>*</b></span></label>
                            <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Informe seu nome" required>
                            <div class="invalid-feedback">
                                Por favor, informe seu nome.
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="inputTel">Telefone</label>
                            <input type="text" name="telefone" class="form-control" id="inputTel" placeholder="Informe seu número de telefone">
                        </div>
                        <div class="form-group col-md-6 col-lg-4">
                            <label for="inputEmail">E-mail</label>
                            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Informe o email para contato">
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label for="selectTipo">Tipo de usuário <span class="text-danger"><b>*</b></span></label>
                            <select id="selectTipo" name='tipo' class="form-control" required>
                                <option value="" selected>Selecione um tipo de usuário</option>
                                <option value="0">Aluno</option>
                                <option value="1">Servidor</option>
                                <option value="2">Visitante</option>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, informe o tipo de usuário.
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-lg-6">
                            <label for="inputCpf" class="mr-5">
                                CPF <span class="text-danger"><b>*</b></span>
                            </label>
                            <input type="text" name="cpf" class="form-control" id="inputCpf" placeholder="Informe seu CPF" required>
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
include_once('../modals/modalUsuarioJaCadastrado.html');
include_once('../modals/modalErroCadastro.html');
?>
<script type="text/javascript">
    var sugestionsDiv;
    $(document).ready(function() {
        configurarInputMatricula();
        pesquisarAlunosViaAjax();
        configurarSelectTipo();
    })

    $('#formCadastroUsuario').submit(function(form) {
        form.preventDefault();

        if (!this.checkValidity())
            return;

        else if (!validarDados())
            return;

        var url = "http://bikeifs.com/app/src/controller/inserir/usuario.php";

        var nome = $("#inputNome").val();
        var telefone = $("#inputTel").val();
        var email = $("#inputEmail").val();
        var tipo = $("#selectTipo").val();
        var matricula = ($("#selectTipo").val() == 2 ? '' : $("#inputMatricula").val());
        var cpf = $("#inputCpf").val();
        var senha = $("#inputSenha").val();

        $.ajax({
            type: "POST",
            url,
            data: {
                nome,
                telefone,
                email,
                tipo,
                matricula,
                cpf,
                senha
            },
            success: function(resultado) {
                console.log(resultado)
                if (resultado === 'error_1') {
                    $("#modalUsuarioJaCadastrado").modal('show');
                } else if (resultado === 'error_2') {
                    $("#modalErroCadastro").modal('show');
                } else if (resultado === 'success') {
                    url = "<?php echo $uri . '/public/view/' . $_SESSION['tipoAcesso'] . '/?pagina=cadastrarOutro&obj=Usuario' ?>";
                    $(location).attr('href', url);
                }
            }
        })
    });

    function pesquisarAlunosViaAjax() {
        var url = "http://bikeifs.com/app/src/controller/carregar/alunos.php";
        $.ajax({
            type: "POST",
            url,
            success: function(resultado) {
                autocomplete(document.getElementById('inputMatricula'), JSON.parse(resultado));
            }
        })
    }

    function configurarInputMatricula() {
        $("#inputMatricula").on('input', function(e) {
            pesquisarMatriculaViaAjax();
        });
    }

    function pesquisarMatriculaViaAjax() {
        var matricula = $("#inputMatricula").val().trim();
        var url = location.origin + "/app/src/controller/carregar/alunos-por-matricula.php";
        $.ajax({
            type: "POST",
            url,
            data: {
                matricula
            },
            success: function(resultado) {
                tratarResultadoPesquisa(resultado);
            }
        })
    }

    function tratarResultadoPesquisa(resultado) {
        resultado = JSON.parse(resultado)
        var tamanhoObjeto = Object.keys(resultado).length;
        if (tamanhoObjeto > 0) {
            preencherFormularioComDadosDoUsuario(resultado);
            closeAllLists();
        } else {
            limparFormulario();
        }
    }


    function preencherFormularioComDadosDoUsuario(usuario) {
        var nome = $("#inputNome").val(usuario.Nome.trim());
        var telefone = $("#inputTel").val(usuario.Telefone.trim());
        var email = $("#inputEmail").val(usuario.Email.trim());
        var tipo = $("#selectTipo").val(usuario.Tipo.trim());
        var documento = $("#inputDoc").val(usuario.CPF.trim());
    }


    function limparFormulario() {
        $('#formCadastroUsuario').each(function() {
            this.reset();
        });
    }

    function configurarSelectTipo() {
        $("#selectTipo").change(function() {
            if ($("#selectTipo").val() == 2) {
                $("#inputMatricula").attr('disabled', true)
                $("#inputMatricula").val('')
            } else
                $("#inputMatricula").attr('disabled', false)

        })
    }
</script>