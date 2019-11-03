$(document).ready(function() {
    popularTabelaPesquisarUsuario();

    // Configura o botão selecionar todos (o resto da configuração encontra-se no util.js de forma genérica)
    configurarBotaoSelecionarLinhas(
        document.getElementById('btnSelecionarLinhas'),
        '#tableUsuarios',
        datatable)

    $("#inputAssunto").on('change', function() {
        if (!$(this).val().includes("Sistema Bike IFS"))
            $(this).val($(this).val() + " - Sistema Bike IFS")
    })

    $("#inputNome").focus()
    
    // Inicializa o editor de texto do Gijgo
    $("#inputCorpo").editor()

    // Funções necessárias para limpar totalmente o formulário
    $("#formEnvioEmail").on('reset', function() {
        clearErrors()
        $(".alert-destinatario").remove()
        $("#destinatarios").css('border-color', '#ced4da');
        $('div [contenteditable="true"]').html('')
        $("#inputNome").focus()
    })
});


$("#formEnvioEmail").submit(function(form) {
    form.preventDefault();

    var destinatarios = recuperarEmailsSelecionados();

    let remetente = $("#inputNome").val().trim().toUpperCase() + ' ' + $("#inputSobrenome").val().trim().toUpperCase()
    let assunto = $("#inputAssunto").val().trim()
    let corpo = $('div [contenteditable="true"]').html().trim()


    $.ajax({
        type: "POST",
        url: BASE_URL + 'email/ajaxContatarUsuarios',
        dataType: 'json',
        data: {
            remetente,
            destinatarios,
            assunto,
            corpo
        },
        beforeSend: function() {
            $("#btnEnviar").attr('disabled', 'true')
            $("#btnEnviar").html(loadingImg('Enviando...'))
            $("#btnEnviar").css('cursor', 'not-allowed')
        },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso('Enviado com sucesso!')
                limparFormulario();
            } else if (response['status'] == 0){
                showErrors(response['error_list'])
            } else if (response['status'] == -1) {
                limparFormulario();
                $.snackbar({
                    content: response['error_message'],
                    style: 'snackbar',
                    timeout: '3000'
                })
            }
        },
        complete: function() {
            $("#btnEnviar").removeAttr('disabled')
            $("#btnEnviar").html('Enviar')
            $("#btnEnviar").css('cursor', 'pointer')
        }

    })

    return false;

})

function limparFormulario() {
    $("#formEnvioEmail").trigger('reset')
}

function recuperarEmailsSelecionados() {
    var destinatarios = Array()
    let spansDestinatario = $('span.span-destinatario').toArray()
    spansDestinatario.forEach(destinatario => {
        destinatarios.push($(destinatario).data('email'))
    })

    return destinatarios
}