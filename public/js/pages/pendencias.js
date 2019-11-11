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
    pendencias.forEach(item => adicionarItemNaLista(item))
}

const adicionarItemNaLista = item => $('#listaPendencias').append(criarItemLista(item))


const criarItemLista = item => {
    let div = $('<div class="pendencia-item">')
    div.attr('id', `itemPendencia${item.pendencias.id}`)
    div.html(item.users.nome)
    return div
}

const avisarListaDePendenciasVazia = () => {
    const avisoNenhumaPendencia = criarHtmlNenhumaPendencia()
    $('#listaPendencias').html(avisoNenhumaPendencia)
}

const criarHtmlNenhumaPendencia = () => $('<div class="pendencia-item nenhuma-pendencia">').html('Nenuma pendência encontrada. Fique tranquilo! Avisaremos quando uma nova requisição chegar 😉')