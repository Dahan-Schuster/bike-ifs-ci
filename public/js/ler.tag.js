const recuperarTagLida = () => requisitarUidDoIframe()

function requisitarUidDoIframe() {
    const iframeWindow = document.getElementById('iframeRFID').contentWindow;
    const iframeUrl = $('#iframeRFID').attr('src');

    iframeWindow.postMessage({
        acao: 'get',
        chave: 'uid',
    }, iframeUrl)

}

function escutarIframe() {
    window.addEventListener("message", function(e) {
        const { acao, chave, valor: uid } = e.data
        if (acao == 'returnData' && chave == 'uid') {
            preencherInputUID(uid);
            limparModalLerTag();
        }
    }, false);
}

function preencherInputUID(uid) {
    $('#inputUID').val(uid);                // Preenche o input de texto
    $('#inputUID').trigger('keyup')         // Dispara um evento de teclado para ativar máscara (jquery mask)
    $('#inputUID').change();                // Dispara um evento de mudança para alguns handlers fazerem seu trabalho
    $(document).trigger('UidDetectado', [uid]); // Dispara o evento que será escutado pelo input UID do modal de registros automáticos
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