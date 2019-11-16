var datatable;

$(document).ready(function() {
    // Define um filtro inicial vazio. Isto fará com que o controlador carregue 0 registros
    let filtro = new Array()

    // Popula a tabela usando o framework Datatables
    popularTabelaRegistros(filtro);

    // Preenche o input date do filtro de pesquisa com a data de hoje
    $('#inputDataInicial').
    val(new Date().toISOString().slice(0, 10));

    preencherSelectsFuncionario();

    // Ativa o menu 'excluir' no header
    $(".nav-link")
        .removeClass('active')
    $("#navLinkExclusao")
        .addClass('active')

    // Define um tamanho mínimo para a tabela
    // Isso previne que o filtro de pesquisa seja
    // sobreposto devido à regra CSS overflow-y
    $('.table-responsive').css('min-height', '480px')

    // Configura o botão selecionar todos (o resto da configuração encontra-se no util.js de forma genérica)
    configurarBotaoSelecionarLinhas(
        document.getElementById('btnSelecionarLinhas'),
        '#tableRegistros',
        datatable)

});


function excluirRegistro(botao) {
    let id = recuperarInformacoesDaLinhaDatatable(botao, datatable).registros.id
    let ids_registros = [id]
    swal.fire({
        type: 'warning',
        title: 'Excluir Registro',
        html: `<div id="divInputSenhaExcluir" class="form-group">
                    <label for="inputSenhaExcluir" class="bmd-label-placeholder">Informe sua senha</label>
                    <input id="inputSenhaExcluir" type="password" class="form-control">
                    <span class="invalid-feedback"></span>
                </div>`,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Excluir',
        confirmButtonColor: 'crimson',
        onOpen: function(el) {
            var container = $(el);
            var originalConfirmButton = container.find('.swal2-confirm');
            var clonedConfirmButton = originalConfirmButton.clone();

            originalConfirmButton.hide();
            clonedConfirmButton.insertAfter(originalConfirmButton);

            clonedConfirmButton.on('click', function() {
                enviarAjaxExclusao($("#inputSenhaExcluir").val(), ids_registros)
            });
        }
    })
}

function excluirRegistrosSelecionados() {
    const ids_registros = []
    datatable.rows({ selected: true })
        .data()
        .toArray()
        .forEach((row) => {
            ids_registros.push(row.id)
        })

    if (ids_registros.length == 0) {
        swal.fire("Excluir selecionados",
            "Nenhuma linha selecionada. " +
            "Liste registros utilizando o filtro de pesquisa." +
            "Selecione um registro clicando em sua linha na tabela, " +
            "ou todos clicando no botão azul.", "error")
    } else {
        swal.fire({
            type: 'warning',
            title: "Excluir " + ids_registros.length + " registros(s) ",
            html: `<div id="divInputSenhaExcluir" class="form-group">
                            <label for="inputSenhaExcluir" class="bmd-label-placeholder">Informe sua senha</label>
                            <input id="inputSenhaExcluir" type="password" class="form-control">
                            <span class="invalid-feedback"></span>
                        </div>`,
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Excluir',
            confirmButtonColor: 'crimson',
            onOpen: function(el) {
                var container = $(el);
                var originalConfirmButton = container.find('.swal2-confirm');
                var clonedConfirmButton = originalConfirmButton.clone();

                originalConfirmButton.hide();
                clonedConfirmButton.insertAfter(originalConfirmButton);

                clonedConfirmButton.on('click', function() {
                    enviarAjaxExclusao($("#inputSenhaExcluir").val(), ids_registros)
                });
            }
        })
    }
}

function enviarAjaxExclusao(senha, ids_registros) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'registro/delete',
        dataType: 'json',
        data: { senha, ids_registros },
        beforeSend: function() {
            $("#btnExcluirSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire({
                    type: "info",
                    title: "Registros excluídos com sucesso."
                })
                atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
            } else if (response['status'] == 0) {
                showErrors(response['error_list'])
            }
        },
        error: function(response) {
            console.log(response)
        },
        complete: function() {
            $("#btnExcluirSelecionados")
                .html(' <i class="material-icons">delete</i>')
        }
    })
}

function preencherSelectsFuncionario() {
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: BASE_URL + 'funcionario',
        success: function(response) {
            let funcionarios = response['data']
            $.each(funcionarios, function(i, funcionario) {
                $('#selectFuncionarioCheckin, #selectFuncionarioCheckout').append($('<option>', {
                    value: funcionario.id,
                    text: funcionario.nome + ' - ' + funcionario.cpf
                }));
            })
        }
    })

}

$("#formFiltro").submit(function(form) {
    form.preventDefault()

    let intervalo = $("#selectIntervalo").val()
    let dataInicial = $("#inputDataInicial").val()

    let funcionarioCheckin = $("#selectFuncionarioCheckin").val()
    let apenasFuncionariosAtivosCheckin = $("#switchApenasFuncionariosAtivosCheckin").is(':checked')

    let funcionarioCheckout = $("#selectFuncionarioCheckout").val()
    let apenasFuncionariosAtivosCheckout = $("#switchApenasFuncionariosAtivosCheckout").is(':checked')

    let tipoUsuario = $("#selectTipoUsuario").val()
    let apenasUsuariosAtivos = $("#switchApenasUsuariosAtivos").is(':checked')

    let filtro = {
        intervalo,
        dataInicial,
        funcionarioCheckin,
        apenasFuncionariosAtivosCheckin,
        funcionarioCheckout,
        apenasFuncionariosAtivosCheckout,
        tipoUsuario,
        apenasUsuariosAtivos
    }

    datatable.destroy()
    popularTabelaRegistros(filtro)
})

function popularTabelaRegistros(filtro) {
    datatable = $('#tableRegistros').DataTable({
        "fixedHeader": {
            footer: true
        },
        searching: false,
        paging: false,
        "sScrollX": false,
        "order": [
            1, "desc"
        ],
        "rowGroup": {
            startRender: null,
            endRender: function(rows, group) {
                return group;
            },
            dataSrc: 'registros.data'
        },
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
                    let output = `<div onclick="abrirPainelLateralBike(` + row.bikes.id + `)" 
                            class="bike-color" style="background: ` + cores + `;">`
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
                // Adiciona um link para o perfil de cada funcionário
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
                // Adiciona um link para o perfil de cada funcionário
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
                "targets": -1 // Coluna referente ao nome do funcionário (saída).
            },
            {
                "width": "10%",
                "targets": 5
            }, // Garante que a coluna da cor terá um tamanho adequado
        ],
        'select': {
            'style': 'multi'
        },
        "language": {
            "url": BASE_URL + "/public/js/Portuguese.json"
        },
        ajax: {
            type: 'POST',
            url: BASE_URL + 'registro/filtrar',
            data: {
                filtro
            }
        },
        'processing': true,
        "columns": [{
                render: function() {
                    return ''
                }
            }, {
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
                "render": function() {
                    return `<button type="button" onclick="excluirRegistro(this)" class="btn btn-danger bmd-btn-icon">
                                <i class="material-icons">delete</i>
                            </button>`;
                }
            }

        ]
    });

    configurarBotaoSelecionarLinhas(
        document.getElementById('btnSelecionarLinhas'),
        '#tableRegistros',
        datatable)
}