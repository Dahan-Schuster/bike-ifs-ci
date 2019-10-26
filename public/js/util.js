const BASE_URL = "http://localhost/bike-ifs-ci/"

/**
 * Limpa os erros mostrados em um formulário
 */
function clearErrors() {
    $(".is-invalid")
        .removeClass('is-invalid')
    $(".invalid-feedback")
        .html("")
}

/**
 * Mostra em um formulário mensagens de uma lista de erros
 * 
 * @param {array} error_list lista de erros no formato [{'#containerOndeMostrarOErro' = 'Mensagem do erro'}, ...]
 */
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

/**
 * Retorna um bootstrap spinner + uma mensagem
 * @param {*} message 
 */
function loadingImg(message = '') {
    if (message.trim()) message = '&nbsp;&nbsp;&nbsp;' + message
    return "<div class='spinner-border spinner-border-sm'></div>" + message
}


 

/**
 * Formata uma enviada no formato USA (YYYY-MM-DD) para o formato padrão BR (DD/MM/AAAA)
 * @param {string} data_usa 
 */
function formatarDataUSA_BR(data_usa) {
    var ano = data_usa.substring(0, 4);
    var mes = data_usa.substring(5, 7);
    var dia = data_usa.substring(8);

    var data_br = dia + '/' + mes + '/' + ano;
    return data_br;
}

// Faz o javascrip esperar por uma certa quantidade de milisegundos
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

/**
 * Retorna uma imagem em seu formato string
 * @param {string} url caminho para a imagem
 * @param {function} callback função de manipulação da string retornada
 */
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

/**
 *   Dispara o evento 'show.bs.modal' ao abrir modais
 *   Existe nativamente no bootstrap, mas não no material bootstrap
 * */
$('[data-toggle="modal"]')
    .click(function(e) {
        $(e.delegateTarget.dataset.target)
            .trigger('show.bs.modal')
    })


// #####################################################
// Métodos usados em conjunto com o framework DataTables


/**
 * Recupera os dados da linha em que está o botão enviado por parâmetro
 * 
 * @param {element} button 
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

/**
 * Seleciona todas a linhas da tabela e altera o evento onclick do botão
 * 
 * @param {element} button 
 * @param {object} tabela 
 */
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

/**
 * Desseleciona todas a linhas da tabela e altera o evento onclick do botão
 * 
 * @param {element} button 
 * @param {object} tabela 
 */
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