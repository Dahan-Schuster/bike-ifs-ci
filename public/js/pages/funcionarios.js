var datatable;

$(document)
    .ready(function() {
        popularTabela();
        setInterval(function() {
            atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable);
        }, 120000); // atualiza a tabela a cada 2 minutos

        // Adiciona as máscasras de CPF e Telefone
        $("#inputCpf")
            .mask('000.000.000-00', { reverse: true });
        $("#inputTel")
            .mask('(00) 00000-0000');

        // Configura o botão selecionar todos (o resto da configuração encontra-se no util.js de forma genérica)
        configurarBotaoSelecionarLinhas(
            document.getElementById('btnSelecionarLinhas'),
            '#tableFuncionarios',
            datatable)

        // Reseta o formulário e os erros do modal de cadastro ao abrir
        $('#modalCadastroFuncionario')
            .on('show.bs.modal', function() {
                clearErrors();
                $('#formCadastroFuncionario')
                    .trigger('reset')
            })

        // Ativa o menu 'Listar' na navbar
        $(".nav-link")
            .removeClass('active')
        $("#navLinkListagem")
            .addClass('active')
    });

$("#formCadastroFuncionario")
    .submit(function(form) {
        form.preventDefault()

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'crudAjax/ajaxSalvarFuncionario',
            dataType: 'json',
            data: $(this)
                .serialize(),
            beforeSend: function() {
                $("#btnEnviarCadastro")
                    .html(loadingImg('Validando dados...'))
            },
            success: function(response) {
                console.log(response)
                if (response['status'] == 1) {
                    atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
                    swal.fire('Sucesso!', 'Funcionário cadastrado com sucesso. Aguarde a atualização da tabela.', 'success')
                } else {
                    showErrors(response['error_list'])
                }
            },
            complete: function() {
                $("#btnEnviarCadastro")
                    .html('Cadastrar')
            }
        })

        return false;
    })

function alterarSituacaoFuncionario(fun, situacao) {
    ids_funcionarios = [fun];
    if (situacao == 'Ativo')
        enviarAjaxDesativar(ids_funcionarios)
    else if (situacao == 'Inativo')
        enviarAjaxAtivar(ids_funcionarios)
}

function ativarFuncionariosSelecionados() {
    var ids_funcionarios = []
    datatable.rows({ selected: true })
        .data()
        .toArray()
        .forEach((row) => {
            ids_funcionarios.push(row.id)
        })

    if (ids_funcionarios.length == 0) {
        swal.fire("Ativar selecionados", "Nenhuma linha selecionada. Selecione um funcionário clicando em sua linha na tabela.", "error")
    } else {
        swal.fire({
                type: 'warning',
                title: "Ativar " + ids_funcionarios.length + " funcionario(s) ",
                text: 'Deseja realmente ativar os funcionários selecionados?',
                showCancelButton: true,
                cancelButtonText: 'Não',
                confirmButtonText: 'Sim, ativar',
                confirmButtonColor: 'crimson'
            })
            .then((querAtivar) => {
                if (querAtivar.value)
                    enviarAjaxAtivar(ids_funcionarios)
            })
    }
}

function desativarFuncionariosSelecionados() {
    var ids_funcionarios = []
    datatable.rows({ selected: true })
        .data()
        .toArray()
        .forEach((row) => {
            ids_funcionarios.push(row.id)
        })

    if (ids_funcionarios.length == 0) {
        swal.fire("Desativar selecionados", "Nenhuma linha selecionada. Selecione um funcionário clicando em sua linha na tabela.", "error")
    } else {
        swal.fire({
                type: 'warning',
                title: "Desativar " + ids_funcionarios.length + " funcionario(s) ",
                text: 'Deseja realmente desativar os funcionários selecionados?',
                showCancelButton: true,
                cancelButtonText: 'Não',
                confirmButtonText: 'Sim, desativar',
                confirmButtonColor: 'crimson'
            })
            .then((querDesativar) => {
                if (querDesativar.value)
                    enviarAjaxDesativar(ids_funcionarios)
            })
    }
}

function enviarAjaxAtivar(ids_funcionarios) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'crudAjax/ajaxAtivarFuncionarios',
        dataType: 'json',
        data: { ids_funcionarios },
        beforeSend: function() {
            $("#btnAtivarSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire("Sucesso!", "Funcionário(s) ativado(s) com sucesso.", "success")
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
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

function enviarAjaxDesativar(ids_funcionarios) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'crudAjax/ajaxDesativarFuncionarios',
        dataType: 'json',
        data: { ids_funcionarios },
        beforeSend: function() {
            $("#btnDestivarSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire("Sucesso!", "Funcionário(s) desativado(s) com sucesso.", "success")
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
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

function popularTabela() {
    datatable = $('#tableFuncionarios')
        .DataTable({
            "fixedHeader": {
                footer: true
            },
            "order": [
                [1, "asc"]
            ],
            'select': {
                'style': 'multi'
            },
            "columnDefs": [{
                    "className": "dt-center",
                    "targets": '_all'
                },
                {
                    "orderable": false,
                    "targets": [-1, -2]
                },
                {
                    // Define um switch para a situação do funcionario
                    "render": function(situacao, type, row) {
                        var checked = ''

                        if (situacao == 'Ativo')
                            checked = 'checked'

                        return `<input onchange="alterarSituacaoFuncionario('` + row.id + `', '` + situacao + `')"
                                type="checkbox" class="custom-switch hidden" id="switchSituacao` + row.id + `" ` + checked + `>
                            <label class="custom-switch-label" for="switchSituacao` + row.id + `"></label>`
                    },
                    "targets": -1 // Coluna referente à situação.
                },
                {
                    // Adiciona um link para o perfil de cada funcionário
                    "render": function(nome, type, row) {
                        let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                        output += '<span onclick="abrirPerfilLateralFuncionario(' + row.id + ')">' + nome.split(" ")[0] + '</span>'
                        output += '<span class="tooltiptext-w3">'
                        output += 'Clique para ver mais'
                        output += '</span>'
                        return output
                    },
                    "targets": 1 // Coluna referente ao nome.
                },
                // Define a ordem de prioridade de visibilidade de cada coluna
                // As colunas de nome e do botão de exclusão são as que possuem maior
                // prioridade quando o tamanho da tela não é suficiente
                {
                    responsivePriority: 1,
                    targets: 1
                },
                {
                    responsivePriority: 2,
                    targets: 5
                },
            ],
            "language": {
                "url": BASE_URL + "public/js/Portuguese.json"
            },
            ajax: {
                type: "POST",
                url: BASE_URL + 'crudAjax/ajaxListarFuncionarios'
            },
            'processing': true,
            "columns": [{
                    data: "id"
                },
                {
                    data: "nome"
                },
                {
                    data: "email"
                },
                {
                    data: "telefone"
                },
                {
                    data: "cpf"
                },
                {
                    data: "situacao"
                }
            ]
        });
}