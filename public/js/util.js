const BASE_URL = "http://localhost/bike-ifs-ci/"

function clearErrors() {
    $(".is-invalid")
        .removeClass('is-invalid')
    $(".invalid-feedback")
        .html("")
}

function showErrors(error_list) {
    clearErrors()

    $.each(error_list, function(error_container, message) {
        $(error_container)
            .find('.form-control')
            .addClass('is-invalid')
        $(error_container)
            .find('.invalid-feedback')
            .html(message)
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
    setTimeout(function() {
        $(snackbar)
            .removeClass('show')
    }, 5000);
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

$('[data-toggle="modal"]')
    .click(function(e) {
        $(e.delegateTarget.dataset.target)
            .trigger('show.bs.modal')
    })


// #####################################################
// Métodos usados em conjunto com o framework DataTables


/**
 *  
 * Recupera os dados da linha em que está o botão enviado por parâmetro
 *  
 */
function recuperarInformacoesDaLinha(button) {
    var linha = $(button)
        .parents('tr');
    if (linha.hasClass('child')) { // Verifica se o botão está dentro de uma div expansível (para telas pequenas)
        linha = linha.prev(); // Caso esteja, aponta para a linha anterior (a linha mãe)
    }
    var data = tabela.row(linha)
        .data();
    return data;
}

function selecionarTodos(button, tabela) {
    $(button)
        .find('i')
        .html('check_box');
        $(button)
            .attr('title', 'Selecionar todos')
    $(button)
        .off('click')
    $(button)
        .on('click', function() { desselecionarTodos(button, tabela) })
    tabela.rows()
        .select()
}

function desselecionarTodos(button, tabela) {
    $(button)
        .find('i')
        .html('check_box_outline_blank');
    $(button)
        .attr('title', 'Desselecionar todos')
    $(button)
        .off('click')
    $(button)
        .on('click', function() { selecionarTodos(button, tabela) })
    tabela.rows()
        .deselect()
}