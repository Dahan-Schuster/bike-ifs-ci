var tableBikes;

function alterarSituacao(bike, situacao) {
    if (situacao == 'Ativa')
        desativar(bike)
    else if (situacao == 'Inativa')
        ativar(bike)
}

function ativar(bike) {
    $.ajax({
        type: "POST",
        url: '<?= base_url() ?>/app/src/controller/ativar/bicicleta.php',
        data: {
            bike
        },
        success: function() {
            tabela.ajax.reload();
        }
    });

}

function desativar(bike) {
    $.ajax({
        type: "POST",
        url: '<?= base_url() ?>/app/src/controller/desativar/bicicleta.php',
        data: {
            bike
        },
        success: function() {
            tabela.ajax.reload();
        }
    });

}

function popularTabelaBicicletasUsuario(user) {
    tableBikes = $('#tableBikes').DataTable({
        "columnDefs": [{
                // Centraliza o conteúdo das colunas referentes aos botões
                "className": "dt-center",
                "targets": [-1, -2]
            },
            {
                // Remove a opção 'ordenar' das colunas referentes aos botões
                "orderable": false,
                "targets": [-1]
            },
            {
                // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                "render": function(cores) {
                    atualizarArrayCores(cores);
                    cssBackground = criarCssBackground();
                    return '<div class="bike-color" style="background: ' + cssBackground + ';"><img src="<?= base_url() ?>/public/img/icons/bycicle.png" title="Bike" alt=""></div>';
                },
                "targets": 1 // Coluna referente à cor.
            },
            {
                // Define um switch para a situação da bike
                "render": function(situacao, type, row) {
                    var checked = ''

                    if (situacao == 'Ativa')
                        checked = 'checked'

                    return `<div class="custom-control custom-switch">
                                <input onchange="alterarSituacao('` + row.id + `', '` + situacao + `')" 
                                    type="checkbox" class="custom-control-input" id="switchSituacao` + row.id + `" ` + checked + `>
                                
                                <label class="custom-control-label" for="switchSituacao` + row.id + `">` + situacao + `</label>
                            </div>`;
                },
                "targets": -1 // Coluna referente à situação.
            },
            // Define a ordem de prioridade de visibilidade de cada coluna
            { responsivePriority: 10001, targets: 3 },
            { responsivePriority: 10002, targets: -2 },
            { responsivePriority: 10003, targets: -1 },
            { "width": "15%", "targets": 1 }, // Garante que a coluna da cor terá um tamanho adequado
        ],
        "language": {
            "url": "<?= base_url() ?>/public/js/Portuguese.json"
        },
        ajax: {
            type: "POST",
            url: "<?= base_url() ?>/app/src/controller/carregar/bicicletas-usuario.php",
            data: { id: user }
        },
        "columns": [
            { data: "id" },
            { data: "cores" },
            { data: "modelo" },
            { data: "marca" },
            { data: "obs" },
            { data: "aro" },
            { data: "situacao" }

        ]
    });
}

function configurarModalBicicletasUsuarios() {
    $('#modalBicicletasUsuario').on('show.bs.modal', async function() {
        await tableBikes.ajax.reload(); // atualiza a tabelaBicicletas ao abrir o modal
        tableBikes.search('').columns().search('').draw(); // limpa o filtro de pesquisa
    })
}


function recuperarInformacoesDaLinha(button) {
    var linha = $(button).parents('tr'); // Recupera a linha do botão na tabela
    if (linha.hasClass('child')) // Verifica se o botão está dentro de uma div expansível (para telas pequenas)
        linha = linha.prev(); // Caso esteja, aponta para a linha anterior (a linha mãe)

    var data = tableBikes.row(linha).data(); // Recupera os dados da linha
    return data;
}