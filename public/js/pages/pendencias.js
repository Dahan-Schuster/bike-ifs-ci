$(document)
    .ready(function() {
        listarPendencias()
            /*setInterval(function() {
                    listarPendencias()
                }, 30000) // atualiza a tabela a cada 30 segundos
            */
        $(".nav-link")
            .removeClass('active')
        $("#navLinkPendencias")
            .addClass('active')
    })

const listarPendencias = () => {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: BASE_URL + 'pendencias',
        beforeSend: function() {
            // limpa a lista antes de (re)preencher
            $('#listaPendencias').html('')
        },
        success: function(response) {
            if (response['status'] == 1)
                criarHtmlListaPendencias(response['data'])
            else if (respnse['status'] == 0)
                avisarListaDePendenciasVazia()
        }

    })
}

const criarHtmlListaPendencias = pendencias => {
    console.log(pendencias)
}

const avisarListaDePendenciasVazia = () => {
    const avisoNenhumaPendencia = criarHtmlNenhumaPendencia()
    $('#listaPendencias').html(avisoNenhumaPendencia)
}

const criarHtmlNenhumaPendencia = () => $('<div class="pendencia-item">').html('Nenuma pendência encontrada. Fique tranquilo! Avisaremos quando uma nova requisição chegar &#1F609;')
