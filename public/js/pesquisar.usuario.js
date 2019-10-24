function popularTabelaPesquisarUsuario() {
   return $('#tableUsuarios').DataTable({
        "fixedHeader": {
            header: true,
            footer: true
        },
        "select" : {
            style : 'single'
        },
        "order": [[ 1, "asc" ]],
        "language": {
            "url": "<?= base_url() ?>/public/js/Portuguese.json"
        },
        ajax: {
            type: "POST",
            url: "<?= base_url() ?>/app/src/controller/carregar/usuarios.php"
        },
        "processing" : true,
        "columns": [
            {data : "id"},
            {data : "nome"},
            {data : "telefone"},
            {data : "email"},
            {data : "tipo"},
            {data : "cpf"},
            {data : "matricula"}
        ]
    });
}

function preencherSelectUsuario() {
    $.ajax({
    type: "POST",
    url: '<?= base_url() ?>/app/src/controller/carregar/usuarios.php',
    success: function(users) {
            $.each(users.data, function (i, user) {
                $('#selectUsuario').append($('<option>', { 
                    value: user.id,
                    text : user.nome + ' - ' + user.email 
                }));
            });
        }
    })
}

function recuperarUsuarioSelecionado(tabelaUsuarios) {
    if (tabelaUsuarios.rows( { selected: true }).count() === 0)
        return 0; // não faz nada caso nenhum usuário seja selecionado na tabelaUsuarios
    
    // recupera a linha selecionada na tabelaUsuarios
    var usuario = tabelaUsuarios.rows( { selected: true }).data()[0];
    atualizarSelectUsuario(usuario);
}

function atualizarSelectUsuario(usuario) {
    $('#selectUsuario').val(usuario.id) // seleciona o usuário no selectUsuario
    $('#selectUsuario').change();
    $('#modalPesquisarUsuario').modal('hide');
}

function configurarModalPesquisarUsuarios(tabelaUsuarios) {
    $('#modalPesquisarUsuario').on('show.bs.modal', async function(){
        await tabelaUsuarios.ajax.reload(); // atualiza a tabelaUsuarios ao abrir o modal
        tabelaUsuarios.search( '' ).columns().search( '' ).draw(); // limpa o filtro de pesquisa
        $('#modalPesquisarUsuario').modal('handleUpdate');
    })
}