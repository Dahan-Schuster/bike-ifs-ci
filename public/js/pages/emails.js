var datatable;

$(document)
    .ready(function() {
        let timestamp = getTimeStampAtual()
        popularTabela(timestamp);
        criarEConfigurarSelectData(datatable, popularTabela)

        ativarMenuListar()
    });

function popularTabela(timestamp) {
    datatable = $('#tableEmails')
        .DataTable({
            "dom": `frt"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"`,
            "fixedHeader": {
                footer: true
            },
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                    // Centraliza o conteúdo das colunas
                    "className": "dt-center",
                    "targets": '_all'
                },
                {
                    // Remove a opção 'ordenar' das colunas referentes aos botões
                    "orderable": false,
                    "targets": [5, -1]
                },
                {
                    // Adiciona um link para o perfil de cada usuário
                    "render": function(nome, type, row) {
                        let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                        output += `<span onclick="abrirPerfilLateralUsuario(${row.users.id})">${nome.split(" ")[0]}</span>`
                        output += '<span class="tooltiptext-w3">'
                        output += 'Clique para ver mais'
                        output += '</span>'
                        return output
                    },
                    "targets": 3 // Coluna referente ao nome.
                },
                {
                    // Adiciona um link para o perfil de cada funcionário
                    "render": function(remetente, type, row) {
                        let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                        output += `<span onclick="abrirPerfilLateralFuncionario(${row.funcionarios.id})">`
                        output += remetente + `(${row.funcionarios.nome.split(" ")[0]})</span>`
                        output += '<span class="tooltiptext-w3">'
                        output += 'Clique para ver mais'
                        output += '</span>'
                        return output
                    },
                    "targets": 2 // Coluna referente ao nome do funcionário
                }
            ],
            // Configura o comportamento do botão '+' (mais informações)
            // O padrão, caso nenhuma cofiguração seja feita, é expandir a linha para baixo
            // Esta configuração abre um modal ao invés disso
            "responsive": {
                details: {
                    // Abre um modal com as informações da linha
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(linha) {
                            var info = linha.data();
                            return 'Email nº ' + info.emails.id
                        }
                    }),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            "language": {
                "url": BASE_URL + "public/js/Portuguese.json"
            },
            ajax: {
                type: "POST",
                url: BASE_URL + "crudAjax/ajaxListarEmailsDoDia",
                data: {
                    timestamp
                }
            },
            'processing': true,
            "columns": [{
                    data: "emails.id"
                },
                {
                    data: "emails.hora"
                },
                {
                    data: "emails.remetente"
                },
                {
                    data: "users.nome"
                },
                {
                    data: "emails.assunto"
                },
                {
                    data: "emails.corpo"
                }
            ]
        });
}