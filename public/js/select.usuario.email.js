function popularTabelaPesquisarUsuario() {
    return $('#tableUsuarios').DataTable({
        "fixedHeader": {
            header: true,
            footer: true
        },
        'select': {
            'style': 'multi'
        },
        "order": [
            [1, "asc"]
        ],
        "language": {
            "url": "<?= base_url() ?>/public/js/Portuguese.json"
        },
        ajax: {
            type: "POST",
            url: "<?= base_url() ?>/app/src/controller/carregar/usuarios.php"
        },
        "processing": true,
        "columns": [
            { data: "id" },
            { data: "nome" },
            { data: "email" },
            { data: "tipo" }
        ]
    });
}


/**
 * Função para criar o bloco do usuário na div destinatarios
 */
function recuperarUsuarioSelecionado(tabelaUsuarios) {
    // Limpando a lista de usuários selecionados
    $("#destinatarios").html("")

    // recupera a linha selecionada na tabelaUsuarios
    var usuarios = tabelaUsuarios.rows({ selected: true }).data().toArray();
    usuarios.forEach(user => {

        let blocoDestinatario = document.createElement('div')
        $(blocoDestinatario).addClass('bloco-destinatario')
        $(blocoDestinatario).attr('id', 'dest-' + user.id)

        let spanDestinatario = document.createElement('span')
        $(spanDestinatario).addClass('span-destinatario')
        $(spanDestinatario).attr('data-email', user.email)
        $(spanDestinatario).attr('data-id', user.id)
        $(spanDestinatario).click(function () {
            abrirPerfilLateralUsuario(user.id)
        })

        let botaoRemover = document.createElement('a')
        $(botaoRemover).addClass('span-destinatario remover-destinatario')
        $(botaoRemover).attr('href', 'javascript:void(0)')
        $(botaoRemover).click(function () {
            removerDestinatario('dest-' + user.id)
        })
        $(botaoRemover).html('&times;')

        $(blocoDestinatario).append(spanDestinatario)
        $(blocoDestinatario).append(botaoRemover)

        let nomeSeparado = user.nome.split(' ')
        // Preenche o span com o primeiro e último nome do usuário
        $(spanDestinatario).append(nomeSeparado[0])
        if (nomeSeparado.length > 1)
            $(spanDestinatario).append(' ' + nomeSeparado[nomeSeparado.length - 1])

        // Remove o aviso de selecionar ao menos um destinatario caso esteja visível
        if ($("#sem-destinatario").css('display') != 'none') {
            $("#sem-destinatario").css('display', 'none')
            $("#destinatarios").css('border-color', '#28a745');
        }

        $("#destinatarios").append(blocoDestinatario)
    });
}

function removerDestinatario(blocoDestinatarioId) {
    $('#' + blocoDestinatarioId).remove();
    closeNavPerfil();
}

function selecionarTodos(button, tabelaUsuarios) {
    $(button).html('Desselecionar todos');
    $(button).removeClass('btn-primary');
    $(button).addClass('btn-secondary')
    $(button).off('click')
    $(button).on('click', function () { desselecionarTodos(button, tabelaUsuarios) })
    tabelaUsuarios.rows().select()
}

function desselecionarTodos(button, tabelaUsuarios) {
    $(button).html('Selecionar todos');
    $(button).removeClass('btn-secondary');
    $(button).addClass('btn-primary')
    $(button).off('click')
    $(button).on('click', function () { selecionarTodos(button, tabelaUsuarios) })
    tabelaUsuarios.rows().deselect()
}