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
            $('#card').html('')
        },
        success: function(response) {
            console.log(response)
            if (response['status'] == 1)
                criarHtmlListaPendencias(response['data'])
            else if (response['status'] == 0)
                avisarListaDePendenciasVazia()
        }

    })
}

const criarHtmlListaPendencias = pendencias => {
    pendencias.forEach(item => adicionarCardNoDeck(item))
}

const adicionarCardNoDeck = item => $('#deck').append(criarCard(item))

const criarCard = item => {
    let card = $('<div class="card col-12 col-sm-6 col-md-4 col-lg-3 px-0">')
    card.attr('id', `cardPendencia${item.pendencias.id}`)
    card.append(`<img class="card-img-top" src="${item.bikes.foto_url}" alt="Foto da bicicleta">`)
    card.append(
        `<div class="card-body">
            <h5 class="card-title">${item.users.nome}</h5>
            <p>Matrícula: ${item.users.matricula}</p>
            <p>CPF: ${item.users.cpf}</p>
            
            <p class="card-text">
                Bicicleta
                <ul>
                    <li><b>Modelo</b>: ${item.bikes.modelo}</li>
                    <li><b>Marca</b>: ${item.bikes.marca}</li>
                    <li><b>Aro</b>: ${item.bikes.aro}</li>
                </ul>
            </p>
            <div class="card-footer">
                <i class="material-icons">check</i>
            </div>
        </div>`
    )
    return card
}

const avisarListaDePendenciasVazia = () => {
    const avisoNenhumaPendencia = criarHtmlNenhumaPendencia()
    $('#listaPendencias').html(avisoNenhumaPendencia)
}

const criarHtmlNenhumaPendencia = () => $('<div class="pendencia-item">').html('Nenhuma pendência encontrada. Fique tranquilo! Avisaremos quando uma nova requisição chegar 😉')