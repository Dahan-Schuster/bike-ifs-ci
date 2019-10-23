const BASE_URL = "http://localhost/bike-ifs-ci/"

function clearErrors() {
    $(".has-error").removeClass('has-error')
    $(".help-block").html("")
}

function showErrors(error_list) {
    clearErrors()

    $.each(error_list, function(error_container, message) {
        $(error_container).addClass('has-error')
        $(error_container).find('.help-block').html(message)
    })
}

function loadingImg(message = "") {
    return "<div class='spinner-border spinner-border-sm'></div>&nbsp;&nbsp;&nbsp;" + message
}

function alterarMascaraDoc(tipo) {
    if (tipo == 'cpf') {
        $("#inputDoc")
            .mask("000.000.000-00");
    } else if (tipo == 'mat') {
        $("#inputDoc")
            .unmask();
    }
}

function formatarDataUSA_BR(data_usa) {
    var ano = data_usa.substring(0, 4);
    var mes = data_usa.substring(5, 7);
    var dia = data_usa.substring(8);

    var data_br = dia + '/' + mes + '/' + ano;
    return data_br;
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function alertSnackBar(snackbar, mensagem) {

    // Esconde outros snackbars que possam estar na tela
    $('.snackbar')
        .removeClass('show')

    // Adiciona a classe 'show' ao snackBar
    $(snackbar)
        .addClass("show");

    // Adiciona a mensagem desejada
    $(snackbar)
        .html(mensagem);

    // Remove a classe 'show' após 5 segundos
    setTimeout(function() { $(snackbar)
            .removeClass('show') }, 5000);
}

function getDataUri(url, callback) {
    var image = new Image();

    image.onload = function() {
        var canvas = document.createElement('canvas');
        canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
        canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

        canvas.getContext('2d')
            .drawImage(this, 0, 0);

        callback(canvas.toDataURL('image/png'));
    };

    image.src = url;
}