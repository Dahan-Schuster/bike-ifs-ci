
    var cores = ['#000000'] ;

    function adicionarOuRemoverCor(button, idDiv) {
        let div = '#' + idDiv
        if ($(div).hasClass('selecionada')) {
            $(div).removeClass('selecionada')
            $(button).html('Adicionar')
        } else {
            // let cores = $("#modalCorBody").find('.selecionada')
            // if (cores.length >= 3) {
            //     alert('Máximo de três cores!')
            //     return;
            // }
            $(div).attr('class', $(div).attr('class') + ' selecionada')
            $(button).html('Remover')
        }
    }

    function selecionarCores() {

        let divs = $("#modalCorBody").find('.selecionada')
        cores = new Array ;
        for (let i = 0; i < divs.length; i++) {
            cores[i] = ('#'+$(divs[i]).attr('id'));
            $(divs[i]).removeClass('selecionada')
        }
        pintarDivCores()

        $('#modalEscolherCor').modal('hide');
    }

    function pintarDivCores() {
        background = criarCssBackground()
        $("#inputCor").css('background', background)
    }

    function atualizarArrayCores(novasCores) {
        let novasCoresArray = novasCores.split(";")

        // Remove a última posição caso seja vazia
        // (Ocorre quando a string novasCores termina com ';')
        if (novasCoresArray[novasCoresArray.length-1].length === 0 )
            novasCoresArray.splice(novasCoresArray.length-1, 1)
        cores = novasCoresArray;
    }
    
    /**
     * Cria um linear-gradient com as cores selecionadas no modal de escolha de cor
     * var cores: Array definido como global neste script
     */
    function criarCssBackground() {
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

    function stringArrayCores() {
        let stringCores = ""
        cores.forEach(cor => {
            stringCores += cor + ';'
        })

        return stringCores
    }
