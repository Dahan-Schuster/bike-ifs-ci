var datatable;
var botaoRealizarCheckout = `<button onclick="confirmarCheckOut(this);" class="btn btn-danger bmd-btn-fab bmd-btn-fab-sm">
                                <i class="material-icons">send</i>
                            </button>`;

var botaoCheckoutRealizado = `<button onclick="alertarCheckoutRealizado()" class="btn btn-success bmd-btn-icon">
                                    <i class="material-icons">check</i>
                            </button`;

// TODO: Inserção automática de registros (RFID)

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


/**
 * Ação do formulário de Checkin
 */
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
                fecharModal($("#modalRegistroManual"));
            } else if (response['status'] == -1) {
                swal.fire('Permissão negada', response['error_message'], 'error')
            } else if (response['status'] == -2) {
                alertarBicicletaOuUsuarioInativos(response['objetos'])
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

/**
 * Abre um sweetalert com dois modais para vericação dos dados da bicicleta
 * e para envio de observações sobre o checkout.
 * No final, chama a função para envio da requisição Ajax de checkout
 * 
 * @param {HTMLButtonElement} botao o botão checkout, usado para recuperar os dados da linha    
 */
function confirmarCheckOut(botao) {
    var data = recuperarInformacoesDaLinhaDatatable(botao, datatable)
    Swal.mixin({
        confirmButtonText: 'Avançar &rarr;',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
        progressSteps: ['1', '2']
    }).queue([{
            title: 'Check-Out',
            html: `<h4>Confirme as informações da bicicleta</h4>
                    <table class="table table-borderless">
                        <thead class="thead-dark">
                            <tr>
                                <th colspan="4">Bicicleta</th>
                            </tr>
                            <tr>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Cor</th>
                                <th>Aro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${data.bikes.modelo}</td>
                                <td>${data.bikes.marca}</td>
                                <td><div class="col-3 bike-color" style="max-width: 100%; background: ${data.bikes.cores}"></div></td>
                                <td>${data.bikes.aro}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-borderless">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="4">Usuário (dono)</th>
                            </tr>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Matrícula</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>${data.users.nome}</td>
                                <td>${data.users.cpf}</td>
                                 <td>${data.users.matricula}</td>
                            </tr>
                        </tbody>
                    </table>`
        },
        {
            title: 'Deseja registrar alguma observação?',
            input: 'textarea',
        }
    ]).then((result) => {
        if (result.value) {
            enviarAjaxCheckout(result.value[1], data.registros.id)
        }
    })
}

function enviarAjaxCheckout(obs, id_registro) {
    $.ajax({
        type: "POST",
        url: BASE_URL + "crudAjax/ajaxCheckoutRegistro",
        dataType: 'json',
        data: {
            obs,
            id_registro
        },
        success: function(response) {
            if (response['status'] == 1) {
                atualizarDataTable(null, datatable)
                snackBarSucessoCheckout(response['id_registro'], response['id_saida'])
            } else {
                swal.fire('Permissão negada', response['error_message'], 'error')
            }
        }
    })
}

function desfazerCheckout(id_registro, id_saida) {
    $.ajax({
        type: "POST",
        url: BASE_URL + "crudAjax/ajaxDesfazerCheckout",
        dataType: 'json',
        data: {
            id_registro,
            id_saida
        },
        success: function(response) {
            if (response['status'] == 1) {
                atualizarDataTable(null, datatable)
                snackBarSucessoCheckoutDesfeito()
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
                    output += `<img src="${BASE_URL}public/img/icons/bike-${modelo}.png" title="Bike" alt=""></div>`
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
                    if (row.saidas.data_hora == 'Pendente')
                        return botaoRealizarCheckout;
                    return botaoCheckoutRealizado;
                }
            }
        ]
    });
}

/**
 * Configura o comportamento dos modais de inserção de registros
 */
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

/**
 * Configura o comportamento dos selects Usuário e Bicicleta no modal de inserção de registros
 */
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
    $('#modalRegistroManual').find('#selectBicicleta').change(function() {
        var cores = $('#selectBicicleta option:selected').data('color');
        if (!cores) cores = '#fff'
        $('#modalRegistroManual').find("#selectedBikeColor").css('background', cores)
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
            popularTabelaRegistros(getTimeStampAtual(data))
        }
    })
}

/**
 * Confira o input de texto que é preenchido após a leitura de uma tag RFID
 * para chamar a função que irá pesquisar por uma bicicleta através do UID
 * da Tag assim que o evento UidDetectado for disparado.
 * 
 * Este evento é disparado pelo método preencherInputUID no arquivo ler.tag.js
 * 
 */
function configurarRegistroAutomatico() {
    $('#inputUID').on('UidDetectado', function() {
        pesquisarBikePorUID($('#inputUID').html());
    });
}

/**
 * Abre um sweetalert informando já fora realizado um checkout para o registro escolhido.
 */
function alertarCheckoutRealizado() {
    swal.fire('Checkout Realizado', 'Esta bicicleta já teve sua saída registrada. Verifique se selecionou a bicicleta correta.', 'warning')
}

/**
 * Abre um sweetalert contento um aviso sobre a situação da Bicicleta e do Usuário.
 * Um pequeno painel de controle é gerado para edição rápida dos objetos, podendo ativá-los
 * antes de realizar o registro de entrada.
 * 
 * @param {array} objetos resposta do servidor contendo os objetos Bicicleta e Usuário para edição
 */
function alertarBicicletaOuUsuarioInativos(objetos) {
    swal.fire({
        type: 'warning',
        allowOutsideClick: false,
        title: 'Permissão negada',
        html: `Um ou mais problemas foram encontrados com a bicicleta e o usuário. Por favor, verifique os erros abaixo e tome as devidas providências.
                <hr><div class="row d-fler justify-content-center">
                <div class="row col-12">
                <span class="col-6">Situação da bike</span> <input 
                    type="checkbox" class="custom-switch hidden" id="switchSituacaoBike" ${objetos.bicicleta.situacao == 0 ? 'checked' : ''}>
                <label class="custom-switch-label" for="switchSituacaoBike"></label>
                </div>
                <div class="row col-12">
                <span class="col-6">Situação do usuário</span> <input 
                    type="checkbox" class="custom-switch hidden" id="switchSituacaoUser" ${objetos.usuario.situacao == 0 ? 'checked' : ''}>
                <label class="custom-switch-label" for="switchSituacaoUser"></label>
                </div>`, // TODO: bike verificada/não verificada
        showCancelButton: true,
        confirmButtonText: 'Enviar e Registrar entrada',
        cancelButtonText: 'Enviar'
    }).then((querRegistrar) => {
        if ($('#switchSituacaoBike').is(':checked')) {
            enviarAjaxAtivarBicicletas([objetos.bicicleta.id])
        }
        if ($('#switchSituacaoUser').is(':checked')) {
            enviarAjaxAtivarUsuarios([objetos.usuario.id])
        }
        if (querRegistrar.value)
            $('#btnCheckinManual').click()
        else
            swal.fire('Sucesso', 'Operação realizada com sucesso. Tente registrar a entrada novamente', 'success')
    })
}

/**
 * Mostra um snackbar com um botão para desfazer o checkout recém-registrado
 * 
 * @param {int} id_registro id do registro associado à saída
 * @param {int} id_saida id da saída recém-registrada
 */
function snackBarSucessoCheckout(id_registro, id_saida) {
    var options = {
        content: `<i class='material-icons'>check_circle_outline</i>
                <span class='mb-5'>Checkout realizado com sucesso</span>
                <button onclick="desfazerCheckout(${id_registro}, ${id_saida})" type="button" class="btn btn-primary"><strong>Desfazer</strong></button>`,
        style: "snackbar",
        timeout: 5000
    }

    $.snackbar(options);
}

/**
 * Mostra um snackbar informando que a o checkout foi desfeito
 */
function snackBarSucessoCheckoutDesfeito() {
    var options = {
        content: `<i class='material-icons'>check_circle_outline</i>
                <span class='mb-5'>Checkout desfeito com sucesso</span>`,
        style: "snackbar",
        timeout: 5000
    }

    $.snackbar(options);
}