var tabela;
var botaoExcluir = `<button id="btnExcluirSelecionados" type="button" onclick="excluirAdmin(this)" class="btn btn-danger bmd-btn-icon">
                        <i class="material-icons">delete</i>
                    </button>`;

$(document).ready(function() {
    popularTabela();
    setInterval(function() {
        tabela.ajax.reload();
    }, 120000); // atualiza a tabela a cada 2 minutos

    $("#inputCpf").mask('000.000.000-00', { reverse: true });

    // Ativa o menu 'Listar' na navbar
    $(".nav-link").removeClass('active')
    $("#navLinkListagem").addClass('active')

    $('#modalCadastroAdmin').on('show.bs.modal', function() {
        clearErrors();
        $('#formCadastroAdmin').trigger('reset')
    })
});

function excluirAdmin(button) {
    let id = recuperarInformacoesDaLinha(button).id
    let ids_admins = [id]

    swal.fire({
        type: 'warning',
        title: 'Excluir Administrador',
        text: 'Deseja realmente excluir o administrador selecionado?',
        showCancelButton: true,
        cancelButtonText: 'Não',
        confirmButtonText: 'Sim, excluir',
        confirmButtonColor: 'crimson'
    }).then((querExcluir) => {
        if (querExcluir.value)
            enviarAjaxExclusao(ids_admins)
    })
}

$("#formCadastroAdmin").submit(function(form) {
    form.preventDefault()

    $.ajax({
        type: 'POST',
        url: BASE_URL + 'crudAjax/ajaxSalvarAdmin',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function() {
            $("#btnEnviarCadastro").html(loadingImg('Validando dados...'))
        },
        success: function(response) {
            if (response['status'] == 1) {
                tabela.ajax.reload()
                swal.fire('Sucesso!', 'Administrador cadastrado com sucesso. Aguarde a atualização da tabela.', 'success')
            } else {
                showErrors(response['error_list'])
            }
        },
        complete: function() {
            $("#btnEnviarCadastro").html('Cadastrar')
        }
    })
})

function excluirAdminsSelecionados() {
    var ids_admins = []
    tabela.rows({ selected: true }).data().toArray().forEach((row) => {
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
        }).then((querExcluir) => {
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
            $("#btnExcluirSelecionados").html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire("Sucesso!", "Administradores excluídos com sucesso. Um e-mail foi enviado para cada um informando a exclusão.", "success")
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            tabela.ajax.reload()
        },
        error: function(response) {
            console.log(response)
        },
        complete: function() {
            $("#btnExcluirSelecionados").html(' <i class="material-icons">delete</i>')
        }
    })
}

function popularTabela() {
    tabela = $('#tableAdmins').DataTable({
        "fixedHeader": {
            footer: true
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
        "select": true,
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