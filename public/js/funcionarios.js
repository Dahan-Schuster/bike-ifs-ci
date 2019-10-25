var tabela;

$(document).ready(function() {
    popularTabela();
    setInterval(function() {
        tabela.ajax.reload();
    }, 120000); // atualiza a tabela a cada 2 minutos


});

// TODO: ativar, desativar e cadastrar funcionários
function alterarSituacao(fun, situacao) {
    if (situacao == 'Ativo')
        desativar(fun)
    else if (situacao == 'Inativo')
        ativar(fun)
}

function popularTabela() {
    tabela = $('#tableFuncionarios').DataTable({
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
                "targets": [-1, -2]
            },
            {
                // Define um switch para a situação do funcionario
                "render": function(situacao, type, row) {
                    var checked = ''

                    if (situacao == 'Ativo')
                        checked = 'checked'

                    return `<input onchange="alterarSituacao('` + row.id + `', '` + situacao + `')"
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
            "url": "<?= base_url() ?>/public/js/Portuguese.json"
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