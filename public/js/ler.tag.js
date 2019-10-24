function recuperarTagLida() {
   requisitarUidDoIframe();
}

function requisitarUidDoIframe() {
    const iframeWindow = document.getElementById('iframeRFID').contentWindow;
    const iframeUrl = $('#iframeRFID').attr('src');

    iframeWindow.postMessage({
        acao : 'get',
        chave : 'uid',
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
    $('#inputUID').html(uid);
    $('#inputUID').change();
    $('#inputUID').trigger('UidDetectado');
}

function limparModalLerTag() {
    $('#iframeRFID').attr("src", function(index, pagina){ 
        return pagina;
    });
    $('#modalLerTag').modal('hide');
}

function configurarModalLerTag() {
    $('#modalLerTag').on('shown.bs.modal', async function() { 
        $('#iframeRFID').attr("src", "http://192.168.25.12/");
    })
}

function pesquisarBikePorUID(uid) {
    $.ajax({
        type:'POST',
        url: '<?= base_url() ?>/app/src/controller/carregar/bike-por-uid.php',
        data: {uid},
        success:function(data){
            if (data == 'error_1')
                $("#modalTagNaoEncontrada").modal('show')
            else {
                preencherModalRegistroAutomatico(data);
                $("#modalRegistroAutomatico").modal('show');
            }
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


function criarArrayCores(novasCores) {
    let novasCoresArray = novasCores.split(";")

    // Remove a última posição caso seja vazia
    // (Ocorre quando a string novasCores termina com ';')
    if (novasCoresArray[novasCoresArray.length-1].length === 0 )
        novasCoresArray.splice(novasCoresArray.length-1, 1)
    return novasCoresArray;
}
/**
 * Cria um linear-gradient com as cores selecionadas no modal de escolha de cor
 * var cores: Array definido como global neste script
 */
function criarCssBackgroundTagRfid(cores) {
    let background = 'repeating-linear-gradient(45deg, '
    let quebraDeCor = 10 / cores.length * 10
    let comprimento = 0
    cores.forEach(cor => {
        background += cor +' ' + comprimento +'% '  // #FFFFFF 0%
        comprimento += quebraDeCor;                 // 0% += 50% = 50% 
        background += comprimento +'%, '            // #FFFFFF 0% 50%, 
    });
    
    background = background.substring(0, background.length - 2) + ')'
    return background
}