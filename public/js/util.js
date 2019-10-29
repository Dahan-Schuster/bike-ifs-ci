const BASE_URL = "http://localhost/bike-ifs-ci/"
const IP_IFRAME_RFID = "http://192.168.15.151"

/**
 * Chama algumas funções de configuração padrão
 * 
 */
$(function() {

    /**
     *   Dispara o evento 'show.bs.modal' ao abrir modais
     *   Existe nativamente no bootstrap, mas não no material bootstrap
     * */
    $('[data-toggle="modal"]')
        .click(function(e) {
            $(e.delegateTarget.dataset.target)
                .trigger('show.bs.modal')
        })

    $('.modal').draggable({
        handle: $('.modal-header')
    })
    $('[data-type="draggable"]')
        .find('.modal-header')
        .css('cursor', 'move')
    $('[data-type="draggable"]')
        .find('.modal-content')
        .on('selectstart', function() {
            return false
        })
});

/** 
 * Ativa o menu 'Listar' na navbar
 */
function ativarMenuListar() {
    $(".nav-link")
        .removeClass('active')
    $("#navLinkListagem")
        .addClass('active')
}

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
 * Retorna a data atual
 */
function getTimeStampAtual() {
    return new Date().getTime()
}



// #####################################################
// Métodos usados em conjunto com o framework DataTables


/**
 * Recarrega o AJAX de uma DataTable com uma cofiguração padrão:
 * Chama o método responsável por desselecionar todas as linhas da tabela;
 * Mantém a paginação no estado em que se encontrava antes de atualizar
 * 
 * @param {element} botao o botão responsável por selecionar/desselecionar todas as linhas
 * @param {object} datatable o objeto retornado após usar o método .DataTable()
 */
function atualizarDataTable(botao, datatable) {
    datatable.ajax.reload(desselecionarTodos(botao, datatable), false)
}

/**
 * Recupera os dados da linha em que está o botão enviado por parâmetro
 * 
 * @param {element} botao 
 */
function recuperarInformacoesDaLinhaDatatable(botao, datatable) {
    var linha = $(botao)
        .parents('tr');
    if (linha.hasClass('child')) { // Verifica se o botão está dentro de uma div expansível (para telas pequenas)
        linha = linha.prev(); // Caso esteja, aponta para a linha anterior (a linha mãe)
    }
    var data = datatable.row(linha)
        .data();
    return data;
}

/**
 * Configura o comportamento do botão Selecionar/Desselecionar todos
 * 
 * @param {element} botao o botão responsável por selecionar/desselecionar todas as linhas
 * @param {string} idTabela o id da tabela com um # no incio (#tabela)
 * @param {object} datatable o objeto retornado após usar o método .DataTable()
 */
function configurarBotaoSelecionarLinhas(botao, idTabela, datatable) {
    $(botao)
        .on('click', () => { selecionarTodos(botao, datatable) })

    $(idTabela + ' tbody').on('click', 'tr', function() {
        // Verifica se o usuário selecionou ou desselecionou uma linha
        let selecionou = !$($(this).find('.selected').prevObject[0]).hasClass('selected')

        // Configura o somador
        // Indica se deve adicionar ou reduzir em 1 a quantidade de linhas selecionadas
        let somador = (selecionou) ? 1 : -1


        // Conta a quantidade de linhas selecionadas
        // Irá retornar a quantidade ANTES do usuário clicar em uma linha
        // Por isso é necessário adicionar o somador
        let linhasSelecionadas = datatable.rows({ selected: true }).count() + somador

        // A depender da quantidade de linhas selecionadas, altera o ícone e o comportamento do botão
        if (linhasSelecionadas == 0) {
            alterarBotaoParaBlank(botao, datatable)
        } else if (linhasSelecionadas == datatable.rows().count()) {
            alterarBotaoParaChecked(botao, datatable)
        } else {
            alterarBotaoParaIndeterminate(botao, datatable)
        }
    })
}

/**
 * Seleciona todas a linhas da datatable e altera o evento onclick do botão
 * 
 * @param {element} botao 
 * @param {object} datatable 
 */
function selecionarTodos(botao, datatable) {
    datatable.rows()
        .select()
    alterarBotaoParaChecked(botao, datatable)
}

/**
 * Desseleciona todas a linhas da datatable e altera o evento onclick do botão
 * 
 * @param {element} botao 
 * @param {object} datatable 
 */
function desselecionarTodos(botao, datatable) {
    datatable.rows()
        .deselect()
    alterarBotaoParaBlank(botao, datatable)
}

/**
 * Altera o ícone o comportamento do botão para quando todas as linhas estiverem selecionadas
 * 
 * @param {element} botao o botão responsável por selecionar/desselecionar todas as linhas
 * @param {object} datatable o objeto retornado após usar o método .DataTable()
 */
function alterarBotaoParaChecked(botao, datatable) {
    $(botao)
        .find('i')
        .html('check_box');
    $(botao)
        .attr('title', 'Desselecionar todos')
    $(botao)
        .off('click')
    $(botao)
        .on('click', function() { desselecionarTodos(botao, datatable) })
}

/**
 * Altera o ícone o comportamento do botão para quando todas as linhas estiverem desselecionadas
 * 
 * @param {element} botao o botão responsável por selecionar/desselecionar todas as linhas
 * @param {object} datatable o objeto retornado após usar o método .DataTable()
 */
function alterarBotaoParaBlank(botao, datatable) {
    $(botao)
        .find('i')
        .html('check_box_outline_blank');
    $(botao)
        .attr('title', 'Selecionar todos')
    $(botao)
        .off('click')
    $(botao)
        .on('click', function() { selecionarTodos(botao, datatable) })
}

/**
 * Altera o ícone o comportamento do botão para quando 
 * uma quantidade de linhas entre 0 e todas estiverem selecionadas
 * 
 * @param {element} botao o botão responsável por selecionar/desselecionar todas as linhas
 * @param {object} datatable o objeto retornado após usar o método .DataTable()
 */
function alterarBotaoParaIndeterminate(botao) {
    $(botao)
        .find('i')
        .html('indeterminate_check_box');
}

/**
 * Cria um input, instancia-o com o método datepicker() (Framework Gijgo.js),
 * e configura para destruir e repopopular a datatable com o método popularTabela,
 * ambos enviados por parâmetro
 * 
 * Utilizado nas tabelas com listagem por dia (registros, registros-do-dia, emails)
 * 
 * @param {object} datatable o objeto retornado apóis usar o método .DataTable()
 * @param {function} callback função responsável por popular a datatable
 */
function criarEConfigurarSelectData(datatable, popularTabela) {
    var selectData = document.createElement('input')
    selectData.id = "selectData"
    selectData.width = "312"
    selectData.autocomplete = "off"
    $(selectData).addClass('form-control')

    var labelSelectData = document.createElement('label')
    labelSelectData.for = "selectData"
    labelSelectData.innerHTML = "Pesquisar por data:"

    $(".div-datepicker").append(labelSelectData).append(selectData)
    $(selectData).datepicker({
        modal: true,
        header: true,
        footer: true,
        format: 'dd/mm/yyyy',
        uiLibrary: 'materialdesign',
        iconsLibrary: 'materialicons',
        change: function(e) {
            datatable.destroy()
            popularTabela(e.timeStamp)
        }
    })
}