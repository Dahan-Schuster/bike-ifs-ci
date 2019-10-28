/**
 * JavaScript responsável por selecionar as cores escolhidas no modalEscolherCor,
 * criar um linear-gradient e adicioná-lo ao modal de cadastro/edição de bicicletas
 */

// Array que armazena as cores escolhidas
// Preenchido por padrão com preto
var cores = ['#000000'];

/**
 * 
 * @param {element} button botão que representa a cor escolhida no modal
 * @param {string} idDiv id do container da cor escolhida
 */
function adicionarOuRemoverCor(button) {
    if ($(button).hasClass('selecionada')) {
        $(button).removeClass('selecionada')
    } else {
        /* Descomente as linhas abaixo para limitar a escolha de cores a apenas 3 (ou quantas desejar) */
        // let cores = $("#modalCorBody").find('.selecionada')
        // if (cores.length >= 3) {
        //     alert('Máximo de três cores!')
        //     return;
        // }
        $(button).addClass('selecionada')
    }
    
    selecionarCores();
}

/**
 * Função responsável por preencher o array cores com as cores
 * selecionadas e chamar a função que pinta a div que representa as cores
 */
function selecionarCores() {
    let divs = $("#popoverCoresBody").find('.selecionada')
    cores = new Array; // redefine o array de cores, removendo a cor padrão
    for (let i = 0; i < divs.length; i++) {
        // adiciona uma cor hexadecimal ao array de cores
        // o id de cada cor é seu próprio valor
        cores[i] = ('#' + $(divs[i]).attr('id')); 
    }

    pintarDivCores()
}

/**
 * Chama a função que cria o background CSS com as cores selecionadas
 */
function pintarDivCores() {
    background = criarCssBackground()
    $("#divCores").css('background', background) // atribui o backgroun à div que representa as cores
    $("#inputCores").val(background) // altera o valor do input que será enviado pelo formulário
}

/**
 * Cria um linear-gradient com as cores selecionadas no modal de escolha de cor
 * var cores: Array definido como global neste script
 */
function criarCssBackground() {

    if (cores.length == 0)
        return 'black'

    let background = 'repeating-linear-gradient(45deg, ';
    let quebraDeCor = (10 / cores.length * 10) // define o tamanho de cada cor no gradiente
    let comprimento = 0 // define o ponto onde cada cor irá terminar
    cores.forEach(cor => {
        background += cor + ' ' + comprimento + '% ' // #FFFFFF 0%
        comprimento += quebraDeCor; // 0% + 50% = 50% 
        background += comprimento + '%, ' // #FFFFFF 0% 50%, 
    });

    background = background.substring(0, background.length - 2) + ')'; // substitui a última vírgula pelo fechamento do gradiente
    return background
}