var datatable;

// Configuração da página
$(document)
    .ready(() => {
        popularTabela();
        popularTabelaPesquisarUsuario();
        setInterval(function() {
            datatable.ajax.reload();
        }, 120000); // atualiza a tabela a cada 2 minutos

        // Configura o botão selecionar todos (o resto da configuração encontra-se no util.js de forma genérica)
        configurarBotaoSelecionarLinhas(
            document.getElementById('btnSelecionarLinhas'),
            '#tableBikes',
            datatable)

        configurarPopoverCores();

        // Reseta o formulário e os erros do modal de cadastro ao abrir
        $('#modalSalvarBike')
            .on('show.bs.modal', function() {
                clearErrors();
                $('#formSalvarBike')
                    .trigger('reset')
                $('#formSalvarBike')
                    .find('#idBicicleta')
                    .val('')
                $('#formSalvarBike')
                    .find('#inputCores')
                    .val('black')
                $('#formSalvarBike')
                    .find('#divCores')
                    .css('background', 'black')
                $('#formSalvarBike')
                    .find('#selectUsuario')
                    .val('')
                $('#popoverEscolherCores')
                    .find('#popoverCoresBody')
                    .find('.selecionada')
                    .removeClass('selecionada')
            })


        // Ativa o menu 'Listar' na navbar
        $(".nav-link")
            .removeClass('active')
        $("#navLinkListagem")
            .addClass('active')

    });

// Cadastro/Edição de bicicletas
$("#formSalvarBike")
    .submit(function(form) {
        form.preventDefault()

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'crudAjax/ajaxSalvarBicicleta',
            dataType: 'json',
            data: $(this)
                .serialize(),
            beforeSend: function() {
                $("#btnEnviar")
                    .html(loadingImg('Validando dados...'))
            },
            success: function(response) {
                if (response['status'] == 1) {
                    datatable.ajax.reload()
                    swal.fire('Sucesso!', 'Bicicleta cadastrada com sucesso. Aguarde a atualização da tabela.', 'success')
                } else {
                    showErrors(response['error_list'])
                }
            },
            complete: function() {
                $("#btnEnviar")
                    .html('Salvar')
            }
        })

        return false;
    })

// Ativar/desativar bicicletas

function alterarSituacaoBicicleta(bike, situacao) {
    var ids_bicicletas = [bike];
    if (situacao == 'Ativa')
        enviarAjaxDesativar(ids_bicicletas)
    else if (situacao == 'Inativa')
        enviarAjaxAtivar(ids_bicicletas)
}

function ativarBicicletasSelecionadas() {
    var ids_bicicletas = []
    datatable.rows({ selected: true })
        .data()
        .toArray()
        .forEach((row) => {
            ids_bicicletas.push(row.bikes.id)
        })

    if (ids_bicicletas.length == 0) {
        swal.fire("Ativar selecionados", "Nenhuma linha selecionada. Selecione uma bike clicando em sua linha na tabela.", "error")
    } else {
        swal.fire({
                type: 'warning',
                title: "Ativar " + ids_bicicletas.length + " bicicleta(s) ",
                text: 'Deseja realmente ativar as bicicletas selecionadas?',
                showCancelButton: true,
                cancelButtonText: 'Não',
                confirmButtonText: 'Sim, ativar',
                confirmButtonColor: 'crimson'
            })
            .then((querAtivar) => {
                if (querAtivar.value)
                    enviarAjaxAtivar(ids_bicicletas)
            })
    }
}

function desativarBicicletasSelecionadas() {
    var ids_bicicletas = []
    datatable.rows({ selected: true })
        .data()
        .toArray()
        .forEach((row) => {
            ids_bicicletas.push(row.bikes.id)
        })

    if (ids_bicicletas.length == 0) {
        swal.fire("Desativar selecionados", "Nenhuma linha selecionada. Selecione uma bike clicando em sua linha na tabela.", "error")
    } else {
        swal.fire({
                type: 'warning',
                title: "Desativar " + ids_bicicletas.length + " bicicleta(s) ",
                text: 'Deseja realmente desativar os bicicletas selecionados?',
                showCancelButton: true,
                cancelButtonText: 'Não',
                confirmButtonText: 'Sim, desativar',
                confirmButtonColor: 'crimson'
            })
            .then((querDesativar) => {
                if (querDesativar.value)
                    enviarAjaxDesativar(ids_bicicletas)
            })
    }
}

function enviarAjaxAtivar(ids_bicicletas) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'crudAjax/ajaxAtivarBicicletas',
        dataType: 'json',
        data: { ids_bicicletas },
        beforeSend: function() {
            $("#btnAtivarSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire("Sucesso!", "Bicicleta(s) ativada(s) com sucesso.", "success")
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            datatable.ajax.reload()
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

function enviarAjaxDesativar(ids_bicicletas) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'crudAjax/ajaxDesativarBicicletas',
        dataType: 'json',
        data: { ids_bicicletas },
        beforeSend: function() {
            $("#btnDestivarSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire("Sucesso!", "Bicicleta(s) desativada(s) com sucesso.", "success")
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            datatable.ajax.reload()
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

// Listagem de bicicletas

function popularTabela() {
    datatable = $('#tableBikes').DataTable({
        "fixedHeader": {
            footer: true
        },
        "order": [
            [6, "asc"]
        ],
        'select': {
            'style': 'multi'
        },
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
                    let modelo = row.bikes.nome_modelo.toLowerCase()
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

                    return `<input onchange="alterarSituacaoBicicleta('${row.bikes.id}','${situacao}')" 
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
                data: "bikes.nome_modelo"
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
                    return `<button class="btn btn-primary bmd-btn-icon" onclick='atualizarCamposModal(this)'
                                    data-toggle="modal" data-target="#modalSalvarBike" 
                                    data-backdrop="static" data-keyboard="false" 
                                    title="Editar" type="button">
                    <i class="material-icons">edit</i>
                </button>`;
                }
            }
        ]
    });
}

// Fim Métodos de controle

// Métodos chamados por outros métodos

function configurarPopoverCores() {
    var popover = $("#popoverEscolherCores")
    var button = $('#btnPalette')
    button.on('click', () => {
        popover.toggle()
        var popper = new Popper(button, popover, {
            placement: 'right',
            modifiers: {
                flip: {
                    behavior: ['left', 'right', 'top', 'bottom']
                },
                arrow: {
                    enabled: true
                }
            }
        })
    })

    $('.closePopover').click(() => {
        popover.hide()
    })
}

function atualizarCamposModal(botao) {

    var bike = recuperarInformacoesDaLinhaDatatable(botao, datatable).bikes;

    let id = bike.id;
    let cores = bike.cores;
    let marca = bike.marca;
    let aro = bike.aro;
    let modelo = bike.modelo;
    let obs = bike.obs;
    let id_usuario = bike.id_usuario;

    $('#modalSalvarBike').find('.modal-body').find('#idBicicleta').val(id);
    $('#modalSalvarBike').find('.modal-body').find('#inputCores').val(cores);
    $('#modalSalvarBike').find('.modal-body').find('#divCores').css('background', cores);
    $('#modalSalvarBike').find('.modal-body').find('#inputMarca').val(marca);
    $('#modalSalvarBike').find('.modal-body').find('#inputObs').val(obs);
    $('#modalSalvarBike').find('.modal-body').find('#inputAro').val(aro);
    $('#modalSalvarBike').find('.modal-body').find('#selectModelo').val(modelo);
    $('#modalSalvarBike').find('.modal-body').find('#selectUsuario').val(id_usuario);
}