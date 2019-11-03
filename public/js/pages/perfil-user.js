$(document).ready(function() {

    $("#btn-info").click(function() {
        $("#btn-info").parent().addClass('active')
        $("#informacoes").removeClass('hidden')
        $("#btn-medalhas").parent().removeClass('active')
        $("#medalhas").addClass('hidden')
    })
    $("#btn-medalhas").click(function() {
        $("#btn-medalhas").parent().addClass('active')
        $("#medalhas").removeClass('hidden')
        $("#btn-info").parent().removeClass('active')
        $("#informacoes").addClass('hidden')
    })
})

function atualizarNome(id, nome_antigo) {
    swal.fire({
        text: 'Informe seu nome:',
        input: 'text',
        inputValue: nome_antigo
    }).then((result) => {
        if (result.value)
            enviarAjaxEditarNome(id, result.value)
    })
}

function atualizarTelefone(id, telefone_antigo) {
    swal.fire({
        text: 'Informe seu telefone:',
        input: 'text',
        inputValue: telefone_antigo,
        inputAttributes: {
            id: 'editTelefone'
        },
        onOpen: function(el) {
            var container = $(el);
            container.find('#editTelefone').mask('(00) 00000-0000');
        }
    }).then((result) => {
        if (result.value)
            enviarAjaxEditarTelefone(id, result.value)
    })
}

function atualizarEmail(email_antigo) {
    swal.fire({
        allowOutsideClick: false,
        showCloseButton: true,
        confirmButtonText: 'Verificar código',
        title: 'Alterar email',
        html: `<div class="form-group">
                    <label for="editEmail" class="bmd-label-placeholder">Novo email</label>
                    <div class="input-group">
                        <input value="${email_antigo}" id="editEmail" type="email" class="form-control">
                        <div class="input-group-append">
                            <button id="btnEnviarCodigo" onclick="ajaxEnviarCodigoEmail(this)" title="Enviar código de confirmação" type="button" class="btn">
                                <i class="material-icons">send</i>
                            </button>
                        </div>
                    </div>
                    <span id="aviso" class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                <label for="inputCodigo" class="bmd-label-placeholder">Código de confirmação</label>
                    <input id="inputCodigo" type="text" class="form-control">
                </div>
                <hr>`,
        inputValue: email_antigo,
        onOpen: function(el) {
            var container = $(el);
            var originalConfirmButton = container.find('.swal2-confirm');
            var clonedConfirmButton = originalConfirmButton.clone();

            originalConfirmButton.hide();
            clonedConfirmButton.insertAfter(originalConfirmButton);

            clonedConfirmButton.on('click', function() {
                enviarAjaxEditarEmail($("#inputCodigo").val())
            });
        }
    })
}

function alterarSenha() {
    swal.fire({
        allowOutsideClick: false,
        showCloseButton: true,
        confirmButtonText: 'Alterar',
        title: 'Alterar senha',
        html: `<div id="divInputSenhaAtual" class="form-group">
                    <label for="inputSenhaAtual" class="bmd-label-placeholder">Senha atual</label>
                    <input id="inputSenhaAtual" type="password" class="form-control">
                    <span id="aviso" class="invalid-feedback"></span>
                </div>
                <hr>
                <div class="form-row">
                    <div id="divInputNovaSenha" class="form-group col-6">
                        <label for="inputNovaSenha" class="bmd-label-placeholder">Nova senha</label>
                        <input id="inputNovaSenha" type="password" class="form-control">
                        <span id="aviso" class="invalid-feedback"></span>
                    </div>
                    <div id="divInputConfirmarNovaSenha" class="form-group col-6">
                        <label for="inputConfirmarNovaSenha" class="bmd-label-placeholder">Confirme a nova senha</label>
                        <input id="inputConfirmarNovaSenha" type="password" class="form-control">
                        <span id="aviso" class="invalid-feedback"></span>
                    </div>
                </div>
                <hr>`,
        onOpen: function(el) {
            var container = $(el);
            var originalConfirmButton = container.find('.swal2-confirm');
            var clonedConfirmButton = originalConfirmButton.clone();

            originalConfirmButton.hide();
            clonedConfirmButton.insertAfter(originalConfirmButton);

            clonedConfirmButton.on('click', function() {
                enviarAjaxEditarSenha($("#inputSenhaAtual").val(), $("#inputNovaSenha").val(), $("#inputConfirmarNovaSenha").val())
            });
        }
    })
}

function alterarPrivacidade() {
    swal.fire({
        title: 'Alterar privacidade',
        html: `<h5>Decida se funcionários, administradores e outros usuários podem ver suas informações pessoais.</h5>
                <hr>
                <p class="lead">Os dados escondidos são <strong><u>CPF</u></strong> e <strong><u>Telefone</u></strong>
                <p>Com a opção de privacidade ativa, seus dados serão apresentados como 'Privado'.</p>
                <hr>
                <div class="alert alert-danger">
                    <h6>IMPORTANTE<h6>
                    <hr>
                    <p style="text-align: justify;">
                        Mesmo que opte por não privar sua conta, seus dados não serão utilizados para nenhum fim 
                        além da segurança dos usuários e do próprio bicicletário, podendo ser requisitados em casos de infração.<br> 
                        Emails, senhas, documentos e nomes não são compartilhados pelo sistema com nenhuma outra aplicação.<br>
                        <u>Se seus dados foram compartilhados de alguma forma, contate algum setor responsável no IFS.</u>
                    </p>

                </div>`,
        allowOutsideClick: false,
        showCloseButton: true,
        showCancelButton: true,
        cancelButtonText: 'Quero meus dados privados!',
        confirmButtonText: 'Tudo bem, confio no sistema'
    }).then((result) => {
        if (result.value)
            enviarAjaxAlterarPrivacidade()
    })
}

function enviarAjaxEditarSenha(senhaAtual, novaSenha, confirmarNovaSenha) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'crudAjax/ajaxEditarSenha',
        data: {
            senhaAtual,
            novaSenha,
            confirmarNovaSenha
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.close()
                snackBarSucesso()
            } else {
                showErrors(response['error_list'])
            }
        }
    })
}

function enviarAjaxEditarEmail(codigo) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'crudAjax/ajaxVerificarCodigoEditarEmail',
        data: {
            codigo
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.close()
                snackBarSucesso()
                $("#spanEmail").html(response['novo_email'])
            } else {
                $.snackbar({
                    content: response['error_message'],
                    style: 'snackbar',
                    timeout: 3000
                })
            }
        }
    })
}

function enviarAjaxEditarNome(id, nome) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'crudAjax/ajaxSalvarUsuario',
        data: {
            id,
            nome
        },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso()
                $("#spanNome, #perfil-nome").html(nome)
            } else {
                swal.fire('Erro', 'Ocorreu um erro ao atualizar as informações. Tente novamente.', 'error')
            }
        }
    })
}

function enviarAjaxEditarTelefone(id, telefone) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'crudAjax/ajaxSalvarUsuario',
        data: {
            id,
            telefone
        },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso()
                $("#spanTelefone").html(telefone)
            } else {
                swal.fire('Erro', 'Ocorreu um erro ao atualizar as informações. Tente novamente.', 'error')
            }
        }
    })
}

function ajaxEnviarCodigoEmail(botao) {
    var email = $(botao).parent().siblings()[0].value
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: BASE_URL + 'email/ajaxEnviarCodigo',
        data: { email },
        beforeSend: function() {
            $("#aviso").html("")
            $("#aviso").css("display", 'none')
            $("#btnEnviarCodigo").html(loadingImg())
            $("#btnEnviarCodigo").attr('disabled', 'disabled')
            $("#btnEnviarCodigo").css('cursor', 'not-allowed')
        },
        success: function(response) {
            if (response['status'] == 1) {
                $("#aviso").html("O código enviado irá expirar em 30 minutos. Verifique seu email.")
                $("#aviso").css("display", 'block')
                $.snackbar({
                    content: `<i class='material-icons'>check_circle_outline</i> <span class='mb-5'>Código de confirmação enviado para <b><u>${email}</u></b></span>`,
                    style: "snackbar",
                    timeout: 5000
                })
            } else {
                swal.fire('Erro', response['error_message'], 'error')
            }
        },
        complete: function() {
            $("#btnEnviarCodigo").html('<i class="material-icons">send</i>')
            $("#btnEnviarCodigo").removeAttr('disabled')
            $("#btnEnviarCodigo").css('cursor', 'pointer')
        }
    })
}

function enviarAjaxAlterarPrivacidade() {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'crudAjax/ajaxAlterarPrivacidadeUsuario',
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso()
            } else {
                swal.fire('Erro', 'Ocorreu um erro ao atualizar as informações. Tente novamente.', 'error')
            }
        }
    })
}