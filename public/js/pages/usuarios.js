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
            '#tableUsuarios',
            datatable)

        // Reseta o formulário e os erros do modal de cadastro ao abrir
        $('#modalCadastroUsuario')
            .on('show.bs.modal', function() {
                clearErrors();
                $('#formCadastroUsuario')
                    .trigger('reset')
            })

        // Desabilita o campo Matrícula quando o usuário for Visitante
        $("#selectTipo").change(function() {
            if ($(this).val() == 2) {
                $('#inputMatricula').attr('disabled', 'true')
                $('#inputMatricula').val('')
            } else {
                $('#inputMatricula').removeAttr('disabled')
            }
        })

        ativarMenuListar()
    });

$("#formCadastroUsuario")
    .submit(function(form) {
        form.preventDefault()

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'usuario',
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
                    fecharModal($('#modalCadastroUsuario'))
                    swal.fire('Sucesso!', 'Usuário cadastrado com sucesso. Aguarde a atualização da tabela.', 'success')
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

function alterarSituacaoUsuario(user, situacao) {
    ids_usuarios = [user];
    if (situacao == 'Ativo')
        enviarAjaxDesativarUsuarios(ids_usuarios)
    else if (situacao == 'Inativo')
        enviarAjaxAtivarUsuarios(ids_usuarios)
}

function ativarUsuariosSelecionados() {
    var ids_usuarios = []
    datatable.rows({ selected: true })
        .data()
        .toArray()
        .forEach((row) => {
            ids_usuarios.push(row.id)
        })

    if (ids_usuarios.length == 0) {
        swal.fire("Ativar selecionados", "Nenhuma linha selecionada. Selecione um usuário clicando em sua linha na tabela.", "error")
    } else {
        swal.fire({
                type: 'warning',
                title: "Ativar " + ids_usuarios.length + " usuario(s) ",
                text: 'Deseja realmente ativar os usuários selecionados?',
                showCancelButton: true,
                cancelButtonText: 'Não',
                confirmButtonText: 'Sim, ativar',
                confirmButtonColor: 'crimson'
            })
            .then((querAtivar) => {
                if (querAtivar.value)
                    enviarAjaxAtivarUsuarios(ids_usuarios)
            })
    }
}

function desativarUsuariosSelecionados() {
    var ids_usuarios = []
    datatable.rows({ selected: true })
        .data()
        .toArray()
        .forEach((row) => {
            ids_usuarios.push(row.id)
        })

    if (ids_usuarios.length == 0) {
        swal.fire("Desativar selecionados", "Nenhuma linha selecionada. Selecione um usuário clicando em sua linha na tabela.", "error")
    } else {
        swal.fire({
                type: 'warning',
                title: "Desativar " + ids_usuarios.length + " usuario(s) ",
                text: 'Deseja realmente desativar os usuários selecionados?',
                showCancelButton: true,
                cancelButtonText: 'Não',
                confirmButtonText: 'Sim, desativar',
                confirmButtonColor: 'crimson'
            })
            .then((querDesativar) => {
                if (querDesativar.value)
                    enviarAjaxDesativarUsuarios(ids_usuarios)
            })
    }
}

function popularTabela() {
    datatable = $('#tableUsuarios')
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
                    // Define um switch para a situação do usuario
                    "render": function(situacao, type, row) {
                        var checked = ''

                        if (situacao == 'Ativo')
                            checked = 'checked'

                        return `<input onchange="alterarSituacaoUsuario('${row.id}', '${situacao}')"
                                type="checkbox" class="custom-switch hidden" id="switchSituacao${row.id}" ${checked}>
                            <label class="custom-switch-label" for="switchSituacao${row.id}"></label>`
                    },
                    "targets": -1 // Coluna referente à situação.
                },
                {
                    // Adiciona um link para o perfil de cada usuário
                    "render": function(nome, type, row) {
                        let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                        output += `<span onclick="abrirPerfilLateralUsuario(${row.id})">${nome.split(" ")[0]}</span>`
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
                type: "GET",
                url: BASE_URL + 'usuario'
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