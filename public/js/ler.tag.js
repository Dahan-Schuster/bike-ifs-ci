function recuperarTagLida() {
    requisitarUidDoIframe();
}

function requisitarUidDoIframe() {
    const iframeWindow = document.getElementById('iframeRFID').contentWindow;
    const iframeUrl = $('#iframeRFID').attr('src');

    iframeWindow.postMessage({
        acao: 'get',
        chave: 'uid',
    }, iframeUrl)

    esperarResposta();
}

function esperarResposta() {
    window.addEventListener("message", function(e) {
        const { acao, chave, valor: uid } = e.data
        if (acao == 'returnData' && chave == 'uid') {
            preencherInputUID(uid);
            limparModalLerTag();
        }
    }, false);
}

function preencherInputUID(uid) {
    $('#inputUid').val(uid);                // Preenche o input de texto
    $('#inputUid').trigger('keyup')         // Dispara um evento de teclado para ativar máscara (jquery mask)
    $('#inputUid').change();                // Dispara um evento de mudança para alguns handlers fazerem seu trabalho
    $('#inputUid').trigger('UidDetectado'); // Dispara o evento que será escutado pelo input UID do modal de registros automáticos
}

function limparModalLerTag() {
    $('#iframeRFID').attr("src", function(index, pagina) {
        return pagina;
    });
    $('#modalLerTag').find('#btnClose').click();
}

function configurarModalLerTag() {
    $('#modalLerTag').on('show.bs.modal', async function() {
        $('#iframeRFID').attr("src", IP_IFRAME_RFID);
    })
}

function pesquisarBikePorUID(uid) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'crudAjax/ajaxBuscarBicicletaPorUID',
        data: { uid },
        success: function(response) {
            console.log(response)
            // TODO: registro automático
        }
    });
}

function preencherModalRegistroAutomatico(data) {

    let userId = data.user.id
    let user = data.user.nome;
    let userDoc = data.user.matricula;
    let bikeId = data.bike.id;
    let nome = data.bike.nome;
    let coresBike = data.bike.cores;
    let modelo = data.bike.modelo;
    let marca = data.bike.marca;
    let aro = data.bike.aro;

    $('#modalRegistroAutomatico').find("#idUsuario").val(userId);
    $('#modalRegistroAutomatico').find('.modal-body').find("#spanUsuario").html(user + ' - ' + userDoc);

    let coresBackground = criarArrayCores(coresBike)
    background = criarCssBackgroundTagRfid(coresBackground)
    $('#modalRegistroAutomatico').find('.modal-body').find("#divBicicleta").css('background', background);
    $('#modalRegistroAutomatico').find('.modal-body').find("#divBicicleta").prev().html(
        'Bicicleta: <ul><li><b>Nome:</b> ' + nome + '</li><li><b>Modelo:</b> ' + modelo + '</li><li><b>Marca:</b> ' + marca + '</li><li><b>Aro:</b> ' + aro + '</li>');

    $('#modalRegistroAutomatico').find('.modal-body').find("#bikeId").val(bikeId);
}