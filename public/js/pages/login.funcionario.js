$("#formLogin").submit(function(form) {
    form.preventDefault()

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: BASE_URL + 'home/ajaxLoginFuncionario',
        data: $(this).serialize(),
        beforeSend: function() {
            $("#btnEntrar").html(loadingImg("Verificando dados..."))
        },
        success: function(response) {
            console.log(response)
            if (response['status'] == 1) {
                $("#aviso-login").css('display', 'none')
                $("#btnEntrar").html(loadingImg("Realizando login..."))
                location = response['location']
            } else {
                $("#btnEntrar").html('Entrar')
                $("#aviso-login").html(response['error_message'])
                $("#aviso-login").css('display', 'block')
            }
        },
        error: function(response) {
            console.log(response)
        }
    })
})