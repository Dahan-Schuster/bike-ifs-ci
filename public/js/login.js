var inpSenha = document.getElementById("inpsenha")

$("#botaoVisibilidade").on("mousedown mouseup", function() {
    alterarVisibilidadeSenha()
})

function alterarVisibilidadeSenha() {
    let src = BASE_URL + "/public/img/icons/";
    inpSenha.type = (inpSenha.type == "text" ? "password" : "text")
    src += (inpSenha.type == "text" ? "hide.png" : "view.png")
    $("#botaoVisibilidade img").attr("src", src);
}

$("#botaoEsqueciSenha").click(function() {
    location = BASE_URL + "home/view/esqueciSenha/"
})

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