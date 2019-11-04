$(document).ready(function() {
    let timestamp = getTimeStampAtual()
    popularTabelaRegistros(timestamp);
    criarEConfigurarSelectData()

    $("#btn-info").click(function() {
        $("#btn-info").parent().addClass('active')
        $("#informacoes").removeClass('hidden')
        $("#btn-registros, #btn-medalhas").parent().removeClass('active')
        $("#registros, #medalhas").addClass('hidden')
    })

    $("#btn-registros").click(function() {
        $("#btn-registros").parent().addClass('active')
        $("#registros").removeClass('hidden')
        $("#btn-info, #btn-medalhas").parent().removeClass('active')
        $("#informacoes, #medalhas").addClass('hidden')
    })

    $("#btn-medalhas").click(function() {
        $("#btn-medalhas").parent().addClass('active')
        $("#medalhas").removeClass('hidden')
        $("#btn-info, #btn-registros").parent().removeClass('active')
        $("#informacoes, #registros").addClass('hidden')
    })
})

function atualizarNome(id, nome_antigo) {
    swal.fire({
        text: 'Informe seu nome:',
        input: 'text',
        inputValue: nome_antigo
    }).then((result) => {
        if (result.value)
            enviarAjaxEditarNome(id, result.value)
    })
}

function atualizarEmail(email_antigo) {
    swal.fire({
        allowOutsideClick: false,
        showCloseButton: true,
        confirmButtonText: 'Verificar código',
        title: 'Alterar email',
        html: `<div class="form-group">
                    <label for="editEmail" class="bmd-label-placeholder">Novo email</label>
                    <div class="input-group">
                        <input value="${email_antigo}" id="editEmail" type="email" class="form-control">
                        <div class="input-group-append">
                            <button id="btnEnviarCodigo" onclick="ajaxEnviarCodigoEmail(this)" title="Enviar código de confirmação" type="button" class="btn">
                                <i class="material-icons">send</i>
                            </button>
                        </div>
                    </div>
                    <span id="aviso" class="valid-feedback"></span>
                </div>
                <div class="form-group">
                <label for="inputCodigo" class="bmd-label-placeholder">Código de confirmação</label>
                    <input id="inputCodigo" type="text" class="form-control">
                </div>
                <hr>`,
        inputValue: email_antigo,
        onOpen: function(el) {
            var container = $(el);
            var originalConfirmButton = container.find('.swal2-confirm');
            var clonedConfirmButton = originalConfirmButton.clone();

            originalConfirmButton.hide();
            clonedConfirmButton.insertAfter(originalConfirmButton);

            clonedConfirmButton.on('click', function() {
                enviarAjaxEditarEmail($("#inputCodigo").val())
            });
        }
    })
}

function atualizarTelefone(id, telefone_antigo) {
    swal.fire({
        text: 'Informe seu telefone:',
        input: 'text',
        inputValue: telefone_antigo,
        inputAttributes: {
            id: 'editTelefone'
        },
        onOpen: function(el) {
            var container = $(el);
            container.find('#editTelefone').mask('(00) 00000-0000');
        }
    }).then((result) => {
        if (result.value)
            enviarAjaxEditarTelefone(id, result.value)
    })
}

function alterarSenha() {
    swal.fire({
        allowOutsideClick: false,
        showCloseButton: true,
        confirmButtonText: 'Alterar',
        title: 'Alterar senha',
        html: `<div id="divInputSenhaAtual" class="form-group">
                    <label for="inputSenhaAtual" class="bmd-label-placeholder">Senha atual</label>
                    <input id="inputSenhaAtual" type="password" class="form-control">
                    <span id="aviso" class="invalid-feedback"></span>
                </div>
                <hr>
                <div class="form-row">
                    <div id="divInputNovaSenha" class="form-group col-6">
                        <label for="inputNovaSenha" class="bmd-label-placeholder">Nova senha</label>
                        <input id="inputNovaSenha" type="password" class="form-control">
                        <span id="aviso" class="invalid-feedback"></span>
                    </div>
                    <div id="divInputConfirmarNovaSenha" class="form-group col-6">
                        <label for="inputConfirmarNovaSenha" class="bmd-label-placeholder">Confirme a nova senha</label>
                        <input id="inputConfirmarNovaSenha" type="password" class="form-control">
                        <span id="aviso" class="invalid-feedback"></span>
                    </div>
                </div>
                <hr>`,
        onOpen: function(el) {
            var container = $(el);
            var originalConfirmButton = container.find('.swal2-confirm');
            var clonedConfirmButton = originalConfirmButton.clone();

            originalConfirmButton.hide();
            clonedConfirmButton.insertAfter(originalConfirmButton);

            clonedConfirmButton.on('click', function() {
                enviarAjaxEditarSenha($("#inputSenhaAtual").val(), $("#inputNovaSenha").val(), $("#inputConfirmarNovaSenha").val())
            });
        }
    })
}

function enviarAjaxEditarSenha(senhaAtual, novaSenha, confirmarNovaSenha) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'funcionario/updatePassword',
        data: {
            senhaAtual,
            novaSenha,
            confirmarNovaSenha
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.close()
                snackBarSucesso()
            } else {
                showErrors(response['error_list'])
            }
        }
    })
}

function enviarAjaxEditarEmail(codigo) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'funcionario/updateEmail',
        data: {
            codigo
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.close()
                snackBarSucesso()
                $("#spanEmail").html(response['novo_email'])
            } else {
                $.snackbar({
                    content: response['error_message'],
                    style: 'snackbar',
                    timeout: 3000
                })
            }
        }
    })
}

function enviarAjaxEditarNome(id, nome) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'funcionario',
        data: {
            id,
            nome
        },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso()
                $("#spanNome, #perfil-nome").html(nome)
            } else {
                swal.fire('Erro', 'Ocorreu um erro ao atualizar as informações. Tente novamente.', 'error')
            }
        }
    })
}

function enviarAjaxEditarTelefone(id, telefone) {
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: BASE_URL + 'funcionario',
        data: {
            id,
            telefone
        },
        success: function(response) {
            if (response['status'] == 1) {
                snackBarSucesso()
                $("#spanTelefone").html(telefone)
            } else {
                swal.fire('Erro', 'Ocorreu um erro ao atualizar as informações. Tente novamente.', 'error')
            }
        }
    })
}

function ajaxEnviarCodigoEmail(botao) {
    var email = $(botao).parent().siblings()[0].value
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: BASE_URL + 'mailer/ajaxEnviarCodigo',
        data: { email },
        beforeSend: function() {
            $("#aviso").html("")
            $("#aviso").css("display", 'none')
            $("#btnEnviarCodigo").html(loadingImg())
            $("#btnEnviarCodigo").attr('disabled', 'disabled')
            $("#btnEnviarCodigo").css('cursor', 'not-allowed')
        },
        success: function(response) {
            if (response['status'] == 1) {
                $("#aviso").html("O código enviado irá expirar em 30 minutos. Verifique seu email.")
                $("#aviso").css("display", 'block')
                $.snackbar({
                    content: `<i class='material-icons'>check_circle_outline</i> <span class='mb-5'>Código de confirmação enviado para <b><u>${email}</u></b></span>`,
                    style: "snackbar",
                    timeout: 5000
                })
            } else {
                swal.fire('Erro', response['error_message'], 'error')
            }
        },
        complete: function() {
            $("#btnEnviarCodigo").html('<i class="material-icons">send</i>')
            $("#btnEnviarCodigo").removeAttr('disabled')
            $("#btnEnviarCodigo").css('cursor', 'pointer')
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
                "targets": 4 // Coluna referente à cor.
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
                "targets": 5 // Coluna referente ao nome.
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
                "targets": -1 // Coluna referente ao nome do funcionário (saída).
            },
            {
                "width": "8%",
                "targets": 4
            }, // Garante que a coluna da cor terá um tamanho adequado
        ],
        "language": {
            "url": BASE_URL + "public/js/Portuguese.json"
        },
        ajax: {
            type: "GET",
            url: BASE_URL + `funcionario/historico/${timestamp}`
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
            }
        ]
    });
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