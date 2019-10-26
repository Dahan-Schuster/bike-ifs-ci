var datatable;
var botaoEditar = `<button type="button" onclick="excluirAdmin(this)" class="btn btn-primary bmd-btn-icon">
                        <i class="material-icons">edit</i>
                    </button>`;


$(document).ready(function() {
    popularTabela();
    setInterval(function() {
        datatable.ajax.reload();
    }, 120000); // atualiza a tabela a cada 2 minutos


});

// Métodos de controle (edição, ativar/desativar, carregamento da tabela)

function editar(button) {
    var data = recuperarInformacoesDaBike(button);
    atualizarCamposDoModalEditar(data);
    $('#modalEditar').modal('show');
}

function alterarSituacao(bike, situacao) {
    if (situacao == 'Ativa')
        desativar(bike)
    else if (situacao == 'Inativa')
        ativar(bike)
}

function popularTabela() {
    datatable = $('#tableBikes').DataTable({
        "fixedHeader": {
            footer: true
        },
        "order": [
            [6, "asc"]
        ],
        "columnDefs": [{
                // Centraliza o conteúdo das colunas referentes aos botões
                "className": "dt-center",
                "targets": '_all'
            },
            {
                // Remove a opção 'ordenar' das colunas referentes aos botões
                "orderable": false,
                "targets": [1, -1, -2]
            },
            {
                // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                "render": function(cores, type, row) {
                    let modelo = row.bikes.modelo.toLowerCase()
                    let output = `<div onclick="abrirPainelLateralBike(${row.bikes.id})" 
                                class="bike-color" style="background: ${cores};">`
                    output += `<img src="${BASE_URL}public/img/icons/bike-${modelo}.png" title="Bike" alt=""></div>`
                    return output
                },
                "targets": 1 // Coluna referente à cor.
            },
            {
                // Adiciona um link para o perfil de cada usuário
                "render": function(nome, type, row) {
                    let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                    output += `<span onclick="abrirPerfilLateralUsuario(${row.users.id})">${nome.split(" ")[0]}</span>`
                    output += '<span class="tooltiptext-w3">'
                    output += 'Clique para ver mais'
                    output += '</span>'
                    return output
                },
                "targets": 6 // Coluna referente ao nome.
            },
            {
                // Define um switch para a situação da bike
                "render": function(situacao, type, row) {
                    var checked = ''

                    if (situacao == 'Ativa')
                        checked = 'checked'

                    return `<input onchange="alterarSituacao('${row.bikes.id}',${situacao})" 
                                type="checkbox" class="custom-switch hidden" id="switchSituacao${row.bikes.id}" ${checked}>
                            <label class="custom-switch-label" for="switchSituacao${row.bikes.id}"></label>`;
                },
                "targets": -2 // Coluna referente à situação.
            },
            {
                "width": "10%",
                "targets": 1
            }, // Garante que a coluna da cor terá um tamanho adequado

            // Define a ordem de prioridade de visibilidade de cada coluna
            {
                responsivePriority: 10001,
                targets: 7
            },
            {
                responsivePriority: 10002,
                targets: 8
            },
            {
                responsivePriority: 10003,
                targets: 3
            },
            {
                responsivePriority: 10004,
                targets: 5
            },
            {
                responsivePriority: 10005,
                targets: 4
            },
        ],
        "language": {
            "url": BASE_URL + "public/js/Portuguese.json"
        },
        ajax: {
            type: "POST",
            url: BASE_URL + "crudAjax/ajaxListarBicicletas"
        },
        "processing": true,
        "columns": [{
                data: "bikes.id"
            },
            {
                data: "bikes.cores"
            },
            {
                data: "bikes.modelo"
            },
            {
                data: "bikes.marca"
            },
            {
                data: "bikes.obs"
            },
            {
                data: "bikes.aro"
            },
            {
                data: "users.nome"
            },
            {
                data: "bikes.situacao"
            },
            {
                "render": function() {
                    return botaoEditar;
                }
            }
        ]
    });
}

// Fim Métodos de controle

// Métodos chamados por outros métodos

function recuperarInformacoesDoModalEditar() {
    var id = $('#modalEditar').find('.modal-footer').find('#bike').val();
    var cores = stringArrayCores();
    var marca = $('#modalEditar').find('.modal-body').find('#inputMarca').val();
    var obs = $('#modalEditar').find('.modal-body').find('#inputObs').val();
    var aro = $('#modalEditar').find('.modal-body').find('#inputAro').val();
    var id_usuario = $('#modalEditar').find('.modal-body').find('#idUsuario').val();

    var dados = '{ "id" : "' + id + '", "cores" : "' + cores + '", "marca" : "' + marca + '", "obs" : "' + obs + '", "aro" : "' + aro + '", "id_usuario" : "' + id_usuario + '"}';
    return JSON.parse(dados);
}

function atualizarCamposDoModalEditar(data) {
    let id = data.id;
    let coresBike = data.cores;
    let marca = data.marca;
    let obs = data.obs;
    let aro = data.aro;
    let id_usuario = data.id_usuario;

    atualizarArrayCores(coresBike);
    pintarDivCores();
    $('#modalEditar').find('.modal-body').find('#inputMarca').val(marca);
    $('#modalEditar').find('.modal-body').find('#inputObs').val(obs);
    $('#modalEditar').find('.modal-body').find('#inputAro').val(aro);
    $('#modalEditar').find('.modal-body').find('#idUsuario').val(id_usuario);

    $('#modalEditar').find('.modal-footer').find('#bike').val(id);
}

function recuperarInformacoesDaBike(button) {
    return recuperarInformacoesDaLinha(button).bikes;
}