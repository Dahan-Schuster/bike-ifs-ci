var datatableUsuarios;

function popularTabelaPesquisarUsuario() {
    datatableUsuarios = $('#tableUsuarios')
        .on('xhr.dt', function(e, settings, response, xhr) {
            preencherSelectUsuario(response.data)
        })
        .DataTable({
            "fixedHeader": {
                header: true,
                footer: true
            },
            "select": {
                style: 'single'
            },
            "order": [
                [1, "asc"]
            ],
            "language": {
                "url": BASE_URL + "public/js/Portuguese.json"
            },
            ajax: {
                type: "GET",
                url: BASE_URL + 'usuario'
            },
            "processing": true,
            "columns": [
                { data: "id" },
                { data: "nome" },
                { data: "email" },
                { data: "tipo" },
                { data: "cpf" },
                { data: "matricula" }
            ]
        });
}

function preencherSelectUsuario(usuarios) {
    $.each(usuarios, function(i, usuario) {
        $('#selectUsuario').append($('<option>', {
            value: usuario.id,
            text: usuario.nome + ' - ' + usuario.email
        }));
    });
}

function recuperarUsuarioSelecionado() {
    if (datatableUsuarios.rows({ selected: true }).count() === 0)
        return false; // não faz nada caso nenhum usuário seja selecionado na tabelaUsuarios

    // recupera as informações do usuário selecionado
    var usuario = datatableUsuarios.rows({ selected: true }).data()[0];
    atualizarSelectUsuario(usuario.id);
}

function atualizarSelectUsuario(id) {
    // salva o id do usuário para enviar no formulário
    $('#selectUsuario').val(id); // seleciona o usuário no selectUsuario
    $('#selectUsuario').change(); // dispara o evento de mudança para ativar certos handles
}

function configurarModalPesquisarUsuarios() {
    $('#modalPesquisarUsuario').on('show.bs.modal', async function() {
        await datatableUsuarios.ajax.reload(); // atualiza a tabelaUsuarios ao abrir o modal
        datatableUsuarios.search('').columns().search('').draw(); // limpa o filtro de pesquisa
    })
}