<?php @session_start(); ?>
<form id="alterarEmail">
    <div class="form-group row">
        <label for="email" class="col-lg-3 col-form-label">Email</label> 
        <div class="col-lg-4 mb-2">
            <input id="email" class="form-control" type="text" >
        </div>
        <div class="col-lg-5">
            <button type="button" onclick="enviarCodigoPorEmail(this)" id="btnEnviarCodigo" class="btn btn-outline-dark">Enviar código de confirmação</button>
        </div>
    </div>
    <div class="form-group row">
        <label for="codigo" class="col-lg-3 col-form-label">Código de confirmação</label> 
        <div class="col-lg-4">
            <input id="inputCodigo" class="form-control" type="text">
        </div>
        <div id="aviso-codigo" class="invalid-feedback col-lg-10 col-10">
            Código incorreto ou expirado. Se não recebeu seu código via email, verifique a grafia e tente novamente. <br>Se enviou mais de uma vez, digite o último código.
        </div>
    </div>
    <br>
    <button type="submit" id="submitEmail" class="btn btn-primary">Atualizar</button>
</form>
<hr class="my-4">
<div class="row">
    <label for="senha" class="col-md-3 col-form-label">Senha</label> 
    <div class="col">
    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalSenha">Alterar</button>
    </div>
</div>
<hr class="my-4">
<div class="row">
    <label for="senha" class="col-md-3 col-form-label">Privacidade</label> 
    <div class="col">
    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalPrivacidade">Alterar</button>
    </div>
</div>
<br>
<!-- Modal privacidade -->
<div id="modalPrivacidade" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-warning">
                <h3 class="modal-title">Alterar privacidade da conta</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4>Decida se funcionários, administradores e outros usuários podem ver suas informações pessoais.</h4>
                <hr>
                <p class="lead">Os dados escondidos são:</p>
                <ul>
                    <li>CPF</li>
                    <li>Telefone</li>
                </ul>
                <p class="lead">Com a opção de privacidade ativa, seus dados serão apresentados como 'Privado'.</p>
                <hr>
                <div class="alert alert-danger">
                    <p class="lead"> IMPORTANTE<hr> 
                        Mesmo que opte por não privar sua conta, seus dados não serão utilizados para nenhum fim 
                        além da segurança dos usuários e do próprio bicicletário, podendo ser requisitados em casos de infração.<br> 
                        Emails, senhas, documentos e nomes não são compartilhados pelo sistema com nenhuma outra aplicação.<br>
                        <u>Se seus dados foram compartilhados de alguma forma, contate algum setor responsável no IFS.</u>
                        </p>

                </div>
                <hr>
                <p>Atualmente seu perfil se econtra <b><span id="perfil-privado"></span></b></p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="alterarPrivacidade('privado')" class="btn btn-info">Privar minha conta</button>
                <button type="button" onclick="alterarPrivacidade('publico')" class="btn btn-primary">Não privar minha conta</button>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal privacidade -->
<?php 
    include_once('../modals/modalUsuarioJaCadastrado.html');
    include_once('../modals/modalSenha.html');
?>
<script type="text/javascript">

    $(document).ready(function() {
        

        atualizarCampos();
    })

    /* CARREGAMENTO DE DADOS INICIAIS */
    function atualizarCampos() {
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/carregar/usuario-por-id.php',
            data: {user : "<?php echo $_SESSION['id'] ?>"},
            success: function(user) 
            {
                $("#email").val(user.email);

                var perfilPrivado = (user.perfil_privado ? 'privado' : 'público');
                $("#modalPrivacidade").find("#perfil-privado").html(perfilPrivado);
            }
        });
    }


    /* FIM CARREGAMENTO DE DADOS INICIAIS */

    /************************************/

    /* ALTERAÇÃO DE EMAIL */

    $("#alterarEmail").submit(function(form) {

        form.preventDefault();

        if (!this.checkValidity())
            return; // impede que o formulário utilize o botão submit para enviar informações

        var inputCodigo = $("#inputCodigo").val();
        var email = $("#submitEmail").val();
        
        // Altera o valor do campo Email para o verdadeiro email enviado, caso
        // o usuário tenha alterado o endereço após enviar o código de confirmação
        // e antes de clicar no botão 'Atualizar'
        $("#email").val(email); 

        if (inputCodigo === codigo) {
            var url = '<?= base_url() ?>/app/src/controller/editar/usuario.php';

            $.ajax({
                type: "POST",
                url: url,
                data: {"user": "<?php echo $_SESSION['id'] ?>", "email":email},
                success: function(resultado) { 
                    if (resultado === 'error_1')
                        $("#modalUsuarioJaCadastrado").modal('show');
                    else if (resultado === 'success') 
                    alertSnackBar($("#alertaSucesso"), 'Operação realizada com sucesso!')
                    

                    $("#inputCodigo").css('border', '1px solid #ced4da');
                    $("#aviso-codigo").css('display', 'none');
                }
            });
        } else {
            informarCodigoIncorreto();
        }
    });

    /* FIM ALTERAÇÃO DE EMAIL */

    /*******************************/

    /* ALTERAÇÃO DE SENHA */

    $("#alterarSenha").submit(function(form) {

        form.preventDefault();

        if (!this.checkValidity())
            return; // impede que o formulário utilize o botão submit para enviar informações
        
        // Dá início às validações, cuja primeira função (validarSenhaAtual) é assíncrona e, 
        // por isso, deve ser responsável por chamar as demais funções após seu término
        validarSenhas(); 
    });

    function validarSenhas() {
        // Função assincrona que dará continuidade às validações após o término
        validarSenhaAtual();
    }

    function validarSenhaAtual() {
        var senhaInserida = $("#modalSenha").find('#oldSenha').val();
        $.ajax({
                type: "POST",
                url: '<?= base_url() ?>/app/src/controller/verificar/senha-usuario.php',
                data: {"user": "<?php echo $_SESSION['id'] ?>", "senha": senhaInserida},
                
                // Após o término da função assíncrona, as funções necessárias são chamadas
                success: function(resultado) 
                {
                    if (resultado === true) {
                        validarIgualdadeSenhas();
                        resetModal();
                    } else if (resultado === false) {
                        alert('Senha incorreta!');
                        $("#aviso-senha-atual").css('display', 'inline-block');
                        $("#oldSenha").focus();
                    }
                }
        });
    }

    function validarIgualdadeSenhas(){

        var senha = $("#modalSenha").find("#newSenha").val();
        var resenha = $("#modalSenha").find("#reNewSenha").val();

        if (senha !== resenha) {
            alert('As senhas não coincidem!');
            $("#aviso-senhas").css('display', 'inline-block');
            $("#reNewSenha").focus();
        } else if (!senha) {
            alert('A senha deve conter caracteres!');
            $("#newSenha").focus();
        } else {
            enviarFormulario(senha);
            resetModal();
        }
    }

    function enviarFormulario(senha){

        var url = '<?= base_url() ?>/app/src/controller/editar/usuario.php';

        $.ajax({
            type: "POST",
            url: url,
            data: {"user": "<?php echo $_SESSION['id'] ?>", "senha":senha},
            success: function() { 
                $("#modalSenha").modal('hide');
                    alertSnackBar($("#alertaSucesso"), 'Operação realizada com sucesso!')
            }
        });
    }

    $('#modalSenha').on('show.bs.modal', function (event) {
        resetModal();
    })

    function resetModal() {
        var modal = $("#modalSenha");
        modal.find("#aviso-senha-atual").css('display', 'none');
        modal.find('#aviso-senhas').css('display', 'none');
        modal.find("#oldSenha").val('');
        modal.find("#newSenha").val('');
        modal.find("#reNewSenha").val('');

    }

    /* FIM ALTERAR SENHA */

    /* ALTERAR PRIVACIDADE */
    function alterarPrivacidade(privacidade) {

        var privado = (privacidade === 'privado' ? 'y' : 'n'); // 'y' e 'n' são caracteres aceitos pelo PostgreSQL para representar true e false

        var url = '<?= base_url() ?>/app/src/controller/editar/usuario.php';

        $.ajax({
            type: "POST",
            url: url,
            data: {"user": "<?php echo $_SESSION['id'] ?>", "perfil_privado":privado},
            success: function(resultado) {
                if (resultado == 'success') {
                    atualizarCampos();
                    $("#modalPrivacidade").modal('hide');
                    alertSnackBar($("#alertaSucesso"), 'Operação realizada com sucesso!')
                } else {
                    alertSnackBar($("#alertaInvalido"), 'Ocorreu um erro durante a edição.<br>Tente novamente ou contate um administrador para obter ajuda.')
                }
            }
        });
    }
</script>
