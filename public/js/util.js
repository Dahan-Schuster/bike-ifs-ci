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
    $('[data-toggle="modal"]').click(e => $(e.delegateTarget.dataset.target).trigger('show.bs.modal'))

    /**
     * Transforma os modais em draggable (framework Gijgo.js)
     */
    try {
        $('.modal').draggable({
            handle: $('.modal-header')
        })
    } catch (e) {}

    /**
     * Estiliza os modais draggable
     */
    $('[data-type="draggable"]')
        .find('.modal-header')
        .css('cursor', 'move')
    $('[data-type="draggable"]')
        .find('.modal-content')
        .on('selectstart', () => false)


});

const avisarRecompensa = medalha => {
    swal.fire({
        "type": 'success',
        "title": medalha['titulo'],
        "text": `Você conseguiu alcançar a marca de ${medalha['descricao_objetivo']} 
                e por isso foi recompensado! Acesse seu perfil para conferir as outras medalhas e recompensas.`
    })
}

const preencherListaMedalhas = medalhas => medalhas.forEach(medalha => adicionarMedalha(medalha))

const adicionarMedalha = medalha => $('#lista-medalhas').append(criarDivMedalha(medalha))

const criarDivMedalha = medalha => {
    const div = $(document.createElement('div'))
    div.addClass('alert medalha col-12 col-sm-4')
    div.html(medalha.titulo)
    if (medalha.recompensa) {
        div.addClass('recompensa')
        div.on('click', () => abrirPainelLateralRecompensa(medalha.recompensa.id))
    } else
        div.on('click', () => abrirPainelLateralMedalha(medalha.id))
    return div
}

/**
 * Define um listener global para requisições AJAX
 * 
 * @param {function} callback função a ser chamada quando requisições AJAX ocorrerem
 */
const onAjaxSend = callback => {
    $(document).ajaxSend((event, request, settings) => callback(event, request, settings))
}

/**
 * Fecha o modal enviado por parâmetro
 * 
 * @param {object} modal objeto retornado pelo JQuery ao referenciar o modal
 */
const fecharModal = modal => modal.find('.close').click()


/**
 * Mostra um snackbar estilizado como sucesso
 */
const snackBarSucesso = (mensagem = 'Operação realizada com sucesso') =>
    $.snackbar({
        content: `<i class='material-icons'>check_circle_outline</i> <span class='mb-5'>${mensagem}</span>`, // text of the snackbar
        style: "snackbar snackbar-sucesso",
        timeout: 5000
    })

/** 
 * Ativa o menu 'Listar' na navbar
 */
const ativarMenuListar = () => {
    $(".nav-link")
        .removeClass('active')
    $("#navLinkListagem")
        .addClass('active')
}

/**
 * Limpa os erros mostrados em um formulário
 */
const clearErrors = () => {
    $(".is-invalid")
        .removeClass('is-invalid')
    $(".invalid-feedback")
        .html("")
        .css('display', 'none')
}

/**
 * Mostra em um formulário mensagens de uma lista de erros
 * 
 * @param {array} error_list lista de erros no formato [{'#containerOndeMostrarOErro' = 'Mensagem do erro'}, ...]
 */
const showErrors = error_list => {
    clearErrors()

    $.each(error_list, (error_container, message) => {
        $(error_container)
            .find('.form-control')
            .addClass('is-invalid')
        $(error_container)
            .find('.invalid-feedback')
            .html(message)
            .css('display', 'block')
    })
}

/**
 * Retorna um bootstrap spinner + uma mensagem
 * @param {*} message 
 */
const loadingImg = message =>
    `<div class='spinner-border spinner-border-sm'></div>${message && message.trim() ? '&nbsp;&nbsp;&nbsp;' : ''}${message}`


const configurarZoomImagens = popover => {
    $('img[rel=popover]').hover(function() {
        popover.find("#imagem-zoom").attr('src', $(this).attr('src'))
        popover.toggle()
        var popper = new Popper($(this), popover, {
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

/**
 * Envia um AJAX com uma imagem para o servidor salvar temporariamente
 * 
 * @param {HTMLInputElement} input_file o campo input responsável por receber a imagem
 * @param {HTMLImageElement} img imagem escolhida pelo usuário
 * @param {HTMLInputElement} input_path campo input do tipo hidden responsável por armazenar a url da imagem após upload
 * @param {boolean} dispararSwal define se deve mostrar erros em um sweetAlert ao invés de preencher um .invalid-feedback
 */
function uploadImg(input_file, input_path, img, dispararSwal = false) {
    let src_before = img.attr('src')

    img_file = input_file[0].files[0]

    form_data = new FormData()
    form_data.append('image_file', img_file)

    $.ajax({
        type: 'POST',
        url: BASE_URL + 'image/upload',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function(response) {
            clearErrors()
            if (response['status'] == 1) {
                img.attr('src', response['img_path'])
                input_path.val(response['img_path'])
                input_path.change()
            } else {
                img.attr('src', src_before)
                if (dispararSwal)
                    swal.fire('Imagem inválida', response['error_message'], 'warning')
                else
                    input_path.siblings('.invalid-feedback').html(response['error_message'])
            }
        },
        error: function() {
            img.attr('src', src_before)
        }
    })

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
 * Retorna o timestamp atual ou da data enviada por parâmetro
 */
function getTimeStampAtual(data = null) {
    if (data) {
        var date = new Date(data)
        date.setTime(date.getTime() + 1 * 86400000)
    } else var date = new Date()
    var horaUTC = date.getTime()
    var fusoHorarioLocal = (-1) * date.getTimezoneOffset() * 60000
    return Math.round(new Date(horaUTC + fusoHorarioLocal).getTime() / 1000)
}

/**
 * Retorna a data atual
 */
function getDataHoraAtual(separator = ' ') {
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    return date + separator + time;
}


// #####################################################
// Métodos AJAX utilizados em mais de uma página

// Verificar bicicletas

function enviarAjaxVerificarBicicleta(id_bicicleta, callback) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'bicicleta/verificar',
        dataType: 'json',
        data: { id_bicicleta },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso('Bicicleta verificada com sucesso.')
                if (null != callback) callback()
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            try {
                atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
            } catch (e) {}
        },
        error: function(response) {
            console.log(response)
        }
    })
}

function enviarAjaxAtivarBicicletas(ids_bicicletas) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'bicicleta/ativar',
        dataType: 'json',
        data: { ids_bicicletas },
        beforeSend: function() {
            $("#btnAtivarSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso('Bicicleta(s) ativada(s) com sucesso.')
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            try {
                atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
            } catch (e) {}
        },
        error: function(response) {
            console.log(response)
        },
        complete: function() {
            $("#btnAtivarSelecionados")
                .html('<i class="material-icons">thumb_up</i>')
        }
    })
}

function enviarAjaxDesativarBicicletas(ids_bicicletas) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'bicicleta/desativar',
        dataType: 'json',
        data: { ids_bicicletas },
        beforeSend: function() {
            $("#btnDestivarSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso('Bicicleta(s) desativada(s) com sucesso.')
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            try {
                atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
            } catch (e) {}
        },
        error: function(response) {
            console.log(response)
        },
        complete: function() {
            $("#btnDestivarSelecionados")
                .html(' <i class="material-icons">thumb_down</i>')
        }
    })
}

function enviarAjaxAtivarUsuarios(ids_usuarios) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'usuario/activate',
        dataType: 'json',
        data: { ids_usuarios },
        beforeSend: function() {
            $("#btnAtivarSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso('Usuário(s) ativado(s) com sucesso.')
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            try {
                atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
            } catch (e) {}
        },
        error: function(response) {
            console.log(response)
        },
        complete: function() {
            $("#btnAtivarSelecionados")
                .html('<i class="material-icons">thumb_up</i>')
        }
    })
}

function enviarAjaxDesativarUsuarios(ids_usuarios) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'usuario/disable',
        dataType: 'json',
        data: { ids_usuarios },
        beforeSend: function() {
            $("#btnDestivarSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso('Usuário(s) desativado(s) com sucesso.')
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            try {
                atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
            } catch (e) {}
        },
        error: function(response) {
            console.log(response)
        },
        complete: function() {
            $("#btnDestivarSelecionados")
                .html(' <i class="material-icons">thumb_down</i>')
        }
    })
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
    var callback = (botao) ? desselecionarTodos(botao, datatable) : () => {};
    datatable.ajax.reload(callback, false)
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