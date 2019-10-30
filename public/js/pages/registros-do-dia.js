var datatable;
var botaoRealizarCheckout = `<a onclick="confirmarCheckOut(this);" class="btn btn-danger text-light">
                                <i class="material-icons">send</i>
                            </a>`;

var botaoCheckoutRealizado = `<a onclick="confirmarCheckOut(this);" class="btn btn-success">
                                    <i class="material-icons">check</i>
                            </a`;

// TODO: Listagem de registros por dia
// TODO: Inserção automática de registros (RFID)
// TODO: Checkout de registros
// TODO: Desfazer checkout

$(document)
    .ready(function() {
        let timestamp = getTimeStampAtual()
        popularTabelaRegistros(timestamp);
        criarEConfigurarSelectData()

        popularTabelaPesquisarUsuario();
        configurarModalCadastroRegistro();
        configurarSelectBicicleta();
        configurarRegistroAutomatico();

        ativarMenuListar()
    });


// Ação do formulário de Checkin
$("#formRegistrarEntradaManual").submit(function(form) {
    form.preventDefault();

    $.ajax({
        type: 'POST',
        url: BASE_URL + 'crudAjax/ajaxInserirRegistro',
        dataType: 'json',
        data: $(this)
            .serialize(),
        beforeSend: function() {
            $("#btnCheckinManual")
                .html(loadingImg('Validando dados...'))
        },
        success: function(response) {
            if (response['status'] == 1) {
                atualizarDataTable(null, datatable)
                snackBarSucesso()
            } else if (response['status'] == -1) {
                swal.fire('Permissão negada', 'Administradores não possuem permissão para relizar registros.', 'error')
            } else {
                showErrors(response['error_list'])
            }
        },
        complete: function() {
            $("#btnCheckinManual")
                .html('<i>Check-in</i>')
        }
    })

    return false;
});


// Ação do formulário de Checkout
$('#formCheckOut').submit(function(form) {
    form.preventDefault();

    return false;

});

function desfazerCheckout(regId) {
    $.ajax({
        type: "POST",
        url: BASE_URL + "",
        data: {
            "id": regId
        },
        success: function(res) {
            if (res == 'success') {

            }
        }
    })
}

function popularTabelaRegistros(timestamp) {
    datatable = $('#tableRegistros').DataTable({
        "dom": `frt"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"`,
        "fixedHeader": {
            footer: true
        },
        "order": [
            [1, "desc"]
        ],
        "columnDefs": [{
                // Centraliza o conteúdo das colunas referentes aos botões
                "className": "dt-center",
                "targets": '_all'
            },
            {
                // Remove a opção 'ordenar' das colunas referentes aos botões
                "orderable": false,
                "targets": [0, 5, -1]
            },
            {
                // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                "render": function(cores, type, row) {
                    let modelo = row.bikes.modelo.toLowerCase()
                    let output = `<div onclick="abrirPainelLateralBike(${row.bikes.id})" 
                                class="bike-color" style="background: ${cores};">`
                    output += `<img src=${BASE_URL}"public/img/icons/bike-${modelo}.png" title="Bike" alt=""></div>`
                    return output
                },
                "targets": 5 // Coluna referente à cor.
            },
            {
                // Adiciona um link para o perfil de cada usuário
                "render": function(nome, type, row) {
                    let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                    output += '<span onclick="abrirPerfilLateralUsuario(' + row.users.id + ')">' + nome.split(" ")[0] + '</span>'
                    output += '<span class="tooltiptext-w3">'
                    output += 'Clique para ver mais'
                    output += '</span>'
                    return output
                },
                "targets": 6 // Coluna referente ao nome.
            },
            {
                // Adiciona um link para o perfil de cada funcionário (entrada)
                "render": function(nome, type, row) {
                    let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                    output += '<span onclick="abrirPerfilLateralFuncionario(' + row.funcionarios_entrada.id + ')">' + nome.split(" ")[0] + '</span>'
                    output += '<span class="tooltiptext-w3">'
                    output += 'Clique para ver mais'
                    output += '</span>'
                    return output
                },
                "targets": 3 // Coluna referente ao nome do funcionário (entrada).
            },
            {
                // Adiciona um link para o perfil de cada funcionário (saída)
                "render": function(nome, type, row) {
                    if (nome == 'Pendente')
                        return nome;
                    let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                    output += '<span onclick="abrirPerfilLateralFuncionario(' + row.funcionarios_saida.id + ')">' + nome.split(" ")[0] + '</span>'
                    output += '<span class="tooltiptext-w3">'
                    output += 'Clique para ver mais'
                    output += '</span>'
                    return output
                },
                "targets": -2 // Coluna referente ao nome do funcionário (saída).
            },
            {
                "width": "15%",
                "targets": 2
            }, // Garante que a coluna dsas obs terá um tamanho adequado
            {
                "width": "8%",
                "targets": 5
            }, // Garante que a coluna da cor terá um tamanho adequado
        ],
        "language": {
            "url": BASE_URL + "public/js/Portuguese.json"
        },
        ajax: {
            type: "POST",
            url: BASE_URL + "crudAjax/ajaxListarRegistrosDoDia",
            data: {
                timestamp
            }
        },
        'processing': true,
        "columns": [{
                render: function() {
                    return ''
                }
            },
            {
                data: "registros.data_hora"
            },
            {
                data: "registros.obs"
            },
            {
                data: "funcionarios_entrada.nome"
            },
            {
                data: "registros.num_trava"
            },
            {
                data: "bikes.cores"
            },
            {
                data: "users.nome"
            },
            {
                data: "saidas.data_hora"
            },
            {
                data: "saidas.obs"
            },
            {
                data: "funcionarios_saida.nome"
            },
            {
                "render": function(data, type, row) {
                    if (row.saidas.hora == 'Pendente')
                        return botaoRealizarCheckout;
                    return botaoCheckoutRealizado;
                }
            }
        ]
    });
}

function configurarModalCadastroRegistro() {
    $("#modalRegistroManual").on('show.bs.modal', function() {
        $(this).find('form').trigger('reset')
        $(this).find('#selectedBikeColor').css('background', '')
    })

    $("#modalRegistroAutomatico").on('show.bs.modal', function() {
        $(this).find('#inputObs').val('')
        $(this).find('#inputNumTrava').val('0')
    })
}

// Selecionar usuário e bicicleta no modal de cadastro de registros
function configurarSelectBicicleta() {

    // Atualizar select bicicleta ao escolher um usuário
    $('#modalRegistroManual').find('#selectUsuario').on('change', function() {
        var id_usuario = $(this).val();
        if (id_usuario) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'crudAjax/gerarOpcoesDeBikesPorUsuario',
                data: { id_usuario },
                success: function(html) {
                    $('#modalRegistroManual').find('#selectBicicleta').html(html);
                }
            });
        } else {
            $('#modalRegistroManual').find('#selectBicicleta').html('<option value="">Primeiramente, selecione um usuário.</option>');
        }
    });

    // Atualizar a div cores ao escolher uma bicicleta
    $('#selectBicicleta').change(function() {
        var cores = $('#selectBicicleta option:selected').data('color');
        if (!cores) cores = '#fff'
        $("#selectedBikeColor").css('background', cores)
    })

}

/**
 * Cria um input, instancia-o com o método datepicker() (Framework Gijgo.js),
 * e configura para destruir e repopopular a datatable com o método popularTabela
 * 
 * Utilizado nas tabelas com listagem por dia (registros, registros-do-dia, emails)
 * 
 * @param {object} datatable o objeto retornado apóis usar o método .DataTable()
 * @param {function} callback função responsável por popular a datatable
 */
function criarEConfigurarSelectData() {
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
            let data = $(selectData).val().substring(6) + '-' + $(selectData).val().substring(3, 5) + '-' + $(selectData).val().substring(0, 2)
            popularTabelaRegistros(Date.parse(data))
        }
    })
}

function configurarRegistroAutomatico() {
    $('#inputUID').on('UidDetectado', function() {
        pesquisarBikePorUID($('#inputUID').html());
    });
}

// Função chamada pelo botão de pesquisa de usuários
// Chamar este método em conjunto com o evento de abertura do modal
// melhora a experiência de visualização da troca de modais.
// Esconder o modal de registros após abrir o modal de pesquisa não
// fica bonito de se ver. Dessa forma ficou mais agradável.
function esconderModalRegistro() {
    $('#modalRegistroManual').modal('hide');
}