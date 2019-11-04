$("#formEsqueciSenha").submit(function(form) {
    form.preventDefault();

    if (!$("#inputEmail").val()) {
        swal.fire('', 'Insira um endereço de email', 'warning')
        return false;
    }

    $.ajax({
        type: 'post',
        url: BASE_URL + 'mailer/ajaxEnviarNovaSenha',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function() {
            $("#btnEnviar").attr('disabled', 'true')
            $("#btnEnviar").css('cursor', 'not-allowed')
            $("#btnEnviar").html(loadingImg('Enviando...'))
        },
        success: function(response) {
            console.log(response)
            if (response['status'] == 1)
                swal.fire({
                    title: "Sucesso!",
                    text: "Senha alterada e enviada para o seu email com sucesso.",
                    type: "success",
                    confirmButtonText: "Ok",
                })
                .then(() => {
                    swal.fire({
                        type: 'info',
                        title: 'Login',
                        text: 'Voltar para a tela de login?',
                        showCancelButton: true,
                        focusConfirm: true,
                        confirmButtonText: 'Voltar',
                        cancelButtonText: 'Não'
                    }).then((voltar) => {
                        if (voltar)
                            window.location = BASE_URL + '/home/view/login'
                    })
                });
            else
                swal.fire({
                    type: "error",
                    title: "ERRO",
                    text: response['error_message'],
                })
        },
        error: function(response) {
            console.log(response)
        },
        complete: function() {
            $("#btnEnviar").removeAttr('disabled')
            $("#btnEnviar").css('cursor', 'pointer')
            $("#btnEnviar").html('Enviar')
        }
    })
})