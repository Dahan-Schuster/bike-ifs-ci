var datatable;

function popularTabelaPesquisarUsuario() {
    datatable = $('#tableUsuarios').DataTable({
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
            "url": BASE_URL + "public/js/Portuguese.json"
        },
        ajax: {
            type: "POST",
            url: BASE_URL + "crudAjax/ajaxListarUsuarios"
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
function recuperarUsuariosSelecionados() {
    // Limpando a lista de usuários selecionados
    $("#destinatarios").html("")

    // recupera a(s) linha(s) selecionada na datatable
    var usuarios = datatable.rows({ selected: true }).data().toArray();
    usuarios.forEach(user => {

        let blocoDestinatario = document.createElement('div')
        $(blocoDestinatario).addClass('alert alert-destinatario')
        $(blocoDestinatario).attr('id', 'dest-' + user.id)

        let spanDestinatario = document.createElement('span')
        $(spanDestinatario).addClass('span-destinatario')
        $(spanDestinatario).attr('data-email', user.email)
        $(spanDestinatario).attr('data-id', user.id)
        $(spanDestinatario).click(function () {
            abrirPerfilLateralUsuario(user.id)
        })

        let botaoRemover = document.createElement('button')
        $(botaoRemover).addClass('close ml-3')
        $(botaoRemover).attr('data-dismiss', 'alert')
        $(botaoRemover).attr('aria-label', 'close')
        $(botaoRemover).html('<span aria-hidden="true">&times;</span>')

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