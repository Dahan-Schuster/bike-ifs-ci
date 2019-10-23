
    var cores = new Array ;

    function pintarDivCores(divCores) {
        background = criarCssBackground()
        $(divCores).css('background', background)
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
