var datatable;
var botaoExcluir = `<button type="button" onclick="excluirAdmin(this)" class="btn btn-danger bmd-btn-icon">
                        <i class="material-icons">delete</i>
                    </button>`;

$(document)
    .ready(function() {
        popularTabela();
        setInterval(function() {
            datatable.ajax.reload();
        }, 120000); // atualiza a tabela a cada 2 minutos

        // Máscara de CPF no formulário de cadastro
        $("#inputCpf")
            .mask('000.000.000-00', { reverse: true });

        // Ativa o menu 'Listar' na navbar
        $(".nav-link")
            .removeClass('active')
        $("#navLinkListagem")
            .addClass('active')

        // Configura o botão selecionar todos (o resto da configuração encontra-se no util.js de forma genérica)
        configurarBotaoSelecionarLinhas(
            document.getElementById('btnSelecionarLinhas'),
            '#tableAdmins',
            datatable)

        // Reseta o formulário e os erros do modal de cadastro ao abrir
        $('#modalCadastroAdmin')
            .on('show.bs.modal', function() {
                clearErrors();
                $('#formCadastroAdmin')
                    .trigger('reset')
            })
    });

$("#formCadastroAdmin")
    .submit(function(form) {
        form.preventDefault()

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'crudAjax/ajaxSalvarAdmin',
            dataType: 'json',
            data: $(this)
                .serialize(),
            beforeSend: function() {
                $("#btnEnviarCadastro")
                    .html(loadingImg('Validando dados...'))
            },
            success: function(response) {
                if (response['status'] == 1) {
                    datatable.ajax.reload()
                    swal.fire('Sucesso!', 'Administrador cadastrado com sucesso. Aguarde a atualização da tabela.', 'success')
                } else {
                    showErrors(response['error_list'])
                }
            },
            complete: function() {
                $("#btnEnviarCadastro")
                    .html('Cadastrar')
            }
        })
    })

function excluirAdmin(botao) {
    let id = recuperarInformacoesDaLinhaDatatable(botao, datatable).id
    let ids_admins = [id]

    swal.fire({
            type: 'warning',
            title: 'Excluir Administrador',
            text: 'Deseja realmente excluir o administrador selecionado?',
            showCancelButton: true,
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim, excluir',
            confirmButtonColor: 'crimson'
        })
        .then((querExcluir) => {
            if (querExcluir.value)
                enviarAjaxExclusao(ids_admins)
        })
}

function excluirAdminsSelecionados() {
    var ids_admins = []
    datatable.rows({ selected: true })
        .data()
        .toArray()
        .forEach((row) => {
            ids_admins.push(row.id)
        })

    if (ids_admins.length == 0) {
        swal.fire("Excluir selecionados", "Nenhuma linha selecionada. Selecione um administrador clicando em sua linha na tabela.", "error")
    } else {
        swal.fire({
                type: 'warning',
                title: "Excluir " + ids_admins.length + " administrador(es) ",
                text: 'Deseja realmente excluir os administradores selecionados?',
                showCancelButton: true,
                cancelButtonText: 'Não',
                confirmButtonText: 'Sim, excluir',
                confirmButtonColor: 'crimson'
            })
            .then((querExcluir) => {
                if (querExcluir.value)
                    enviarAjaxExclusao(ids_admins)
            })
    }
}

function enviarAjaxExclusao(ids_admins) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'crudAjax/ajaxDeletarAdmins',
        dataType: 'json',
        data: { ids_admins },
        beforeSend: function() {
            $("#btnExcluirSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire("Sucesso!", "Administradores excluídos com sucesso. Um e-mail foi enviado para cada um informando a exclusão.", "success")
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            datatable.ajax.reload()
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

function popularTabela() {
    datatable = $('#tableAdmins')
        .DataTable({
            "fixedHeader": {
                footer: true
            },
            'select': {
                'style': 'multi'
            },
            "order": [
                [1, "asc"]
            ],
            "columnDefs": [{
                    "className": "dt-center",
                    "targets": '_all'
                },
                {
                    "orderable": false,
                    "targets": -1
                },
                // Define a ordem de prioridade de visibilidade de cada coluna
                // A coluna de email será a primeira a ser escondida caso o
                // tamanho da tela não seja suficiente
                {
                    responsivePriority: 10001,
                    targets: 2
                },
            ],
            "language": {
                "url": BASE_URL + "public/js/Portuguese.json"
            },
            ajax: {
                type: "POST",
                url: BASE_URL + 'crudAjax/ajaxListarAdmins'
            },
            "processing": true,
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
                    data: "cpf"
                },
                {
                    "render": function() {
                        return botaoExcluir;
                    }
                }
            ]
        });
}