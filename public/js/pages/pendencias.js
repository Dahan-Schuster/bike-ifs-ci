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
            $('#loading').css('display', 'block')
        },
        success: async function(response) {
            console.log(response)
            if (response['status'] == 1) {
                await limparDeck()
                criarHtmlListaPendencias(response['data'])
            } else if (response['status'] == 0)
                avisarListaDePendenciasVazia()
        }

    })
}

const limparDeck = async function() {
    $('.card-pendencia').fadeOut(1000)    // esconde todos os cards com uma animação de 1s
    await sleep(1000)           // espera por 1s a animação terminar
    $('.card-pendencia').remove()         // após a animação, remove de fato os cards
}

const criarHtmlListaPendencias = pendencias => {
    pendencias.forEach(item => adicionarCardNoDeck(item))
    $('#loading').css('display', 'none')
}

const adicionarCardNoDeck = item => $('#deck').append(criarCard(item))

const criarCard = item => {
    const urgencia = calcularUrgenciaRequisicao(item.pendencias.data_hora)
    let card = $(`<div class="card card-pendencia card-${urgencia}">`)
    card.attr('id', `cardPendencia${item.pendencias.id}`)
    card.append(`
        <div class="d-flex justify-content-center">
            <div class="card-tempo">2 dias atrás</div>
            <img style=" max-height: 214px; max-width: 100%;" src="${item.bikes.foto_url}" alt="Foto da bicicleta">
        </div>`)
    card.append(
        `<div class="card-body">
            <h5 class="card-title">${item.users.nome}</h5>
            <p class="card-text">
                <div onclick="abrirPainelLateralBike(${item.bikes.id})" class="bike-color" style="background: ${item.bikes.cores};">
                    <img src="${BASE_URL}public/img/icons/bike-${item.bikes.modelo.toLowerCase()}.png" title="Bike" alt="">
                </div>
            </p>
            <div class="card-footer">
                <div class="btn-verificar-bike">
                    <button onclick="verificarBicicleta('${item.bikes.id}')" title="Verificar bike" type="button" class="btn bg-accent bmd-btn-fab bmd-btn-fab-sm text-light">
                        <i class="material-icons">check</i>
                        <span class="span-verificar-bike">Verificar</span>
                    </button>
                </div>
                
            </div>
        </div>`
    )
    adicionarPopupsInfo(item, card)
    return card
}

const calcularUrgenciaRequisicao = data => 'recente'

const adicionarPopupsInfo = (item, card) => {
    let popover = $("#popperInfo")
    adicionarPopupInfoUsuario(item, card, popover)
    adicionarPopupInfoBicicleta(item, card, popover)
}

const adicionarPopupInfoUsuario = (item, card, popover) => {
    card.find('.card-title').hover(function() {
        popover.find('.popover-body').html(
            `<b>Matricula:</b> ${item.users.matricula}
        <br>
         <b>CPF:</b> ${item.users.cpf}`
        )
        popover.toggle()
        new Popper($(this), popover, {
            placement: 'left',
            modifiers: {
                flip: {
                    behavior: ['left', 'right', 'top', 'bottom']
                },
                arrow: {
                    enabled: true
                }
            }
        })
    });
}

const adicionarPopupInfoBicicleta = (item, card, popover) => {
    card.find('img').hover(function() {
        popover.find('.popover-body').html(
            `<b>Modelo</b>: ${item.bikes.modelo}
            <br>
            <b>Marca</b>: ${item.bikes.marca}
            <br>
            <b>Aro</b>: ${item.bikes.aro}`
        )
        popover.toggle()
        new Popper($(this), popover, {
            placement: 'left',
            modifiers: {
                flip: {
                    behavior: ['left', 'right', 'top', 'bottom']
                },
                arrow: {
                    enabled: true
                }
            }
        })
    });
}

const verificarBicicleta = bike => enviarAjaxVerificarBicicleta(bike, listarPendencias)


const avisarListaDePendenciasVazia = () => {
    const avisoNenhumaPendencia = criarHtmlNenhumaPendencia()
    $('#listaPendencias').html(avisoNenhumaPendencia)
}

const criarHtmlNenhumaPendencia = () => $('<div class="pendencia-item">').html('Nenhuma pendência encontrada. Fique tranquilo! Avisaremos quando uma nova requisição chegar 😉')