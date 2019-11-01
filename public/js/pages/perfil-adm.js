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

function atualizarEmail(id, email_antigo) {
    swal.fire({
        allowOutsideClick: false,
        title: 'Alterar email',
        html: `<div class="form-group">
                    <label for="editEmail" class="bmd-label-placeholder">Novo email</label>
                    <div class="input-group">
                        <input value="${email_antigo}" id="editEmail" type="email" class="form-control">
                        <div class="input-group-append">
                            <button onclick="enviarCodigoEmail(this)" title="Enviar código de confirmação" type="button" class="btn">
                                <i class="material-icons">send</i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                <label for="inputCodigo" class="bmd-label-placeholder">Código de confirmação</label>
                    <input id="inputCodigo" type="text" class="form-control">
                </div>
                <hr>`,
        inputValue: email_antigo
    }).then((result) => {
        //if (result.value)
           
    })
}

function enviarAjaxEditarNome(id, nome) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'crudAjax/ajaxSalvarAdmin',
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

function enviarCodigoEmail(botao) {
    var email = $(botao).parent().siblings()[0].value
    $.snackbar({
        content: `<i class='material-icons'>check_circle_outline</i> <span class='mb-5'>Código de confirmação enviado para <b><u>${email}</u></b></span>`,
        style: "snackbar",
        timeout: 5000
    })
}