$("#botaoVisibilidade").on("mousedown mouseup", function() {
    alterarVisibilidadeSenha()
})

function alterarVisibilidadeSenha() {
    var inputSenha = document.getElementById("inputSenha")
    inputSenha.type = (inputSenha.type == "text" ? "password" : "text")
    var visibilidade = (inputSenha.type == "text" ? "visibility_off" : "visibility")
    $("#botaoVisibilidade i").html(visibilidade);
}

$("#formLogin").submit(function(form) {
    form.preventDefault()

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: BASE_URL + 'home/ajaxLogin',
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