var datatable;

$(document)
    .ready(function() {
        popularTabela();
        popularTabelaPesquisarUsuario();
        configurarModalLerTag();
        configurarSelectBicicleta();

        setInterval(function() {
            atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable);
        }, 120000); // atualiza a tabela a cada 2 minutos

        // Máscara do UID da tag RFID no formulário de cadastro
        $("#inputUid")
            .mask('ZZ ZZ ZZ ZZ', {
                translation: {
                    'Z': {
                        pattern: /[0-9A-F]/,
                        optional: false
                    }
                }
            });

        ativarMenuListar()

        // Configura o botão selecionar todos (o resto da configuração encontra-se no util.js de forma genérica)
        configurarBotaoSelecionarLinhas(
            document.getElementById('btnSelecionarLinhas'),
            '#tableTags',
            datatable)

        // Reseta o formulário e os erros do modal de cadastro ao abrir
        $('#modalCadastroTag')
            .on('show.bs.modal', function() {
                clearErrors();
                $('#formCadastroTag')
                    .trigger('reset')
            })

    });

$("#formCadastroTag")
    .submit(function(form) {
        form.preventDefault()

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'crudAjax/ajaxSalvarTagRFID',
            dataType: 'json',
            data: $(this)
                .serialize(),
            beforeSend: function() {
                $("#btnEnviarCadastro")
                    .html(loadingImg('Validando dados...'))
            },
            success: function(response) {
                if (response['status'] == 1) {
                    atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
                    swal.fire('Sucesso!', 'Tag cadastrada com sucesso. Aguarde a atualização da tabela.', 'success')
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


function excluirTag(botao) {
    let id = recuperarInformacoesDaLinhaDatatable(botao, datatable).tags.id
    let ids_tags = [id]

    swal.fire({
            type: 'warning',
            title: 'Excluir Tag RFID',
            text: 'Deseja realmente excluir a tag RFID selecionada? Ao ser deletada, a tag estará livre para ser recadastrada com outra bicicleta. De preferência, certifique-se de ter o consentimento do dono atual.',
            showCancelButton: true,
            cancelButtonText: 'Não',
            confirmButtonText: 'Sim, excluir',
            confirmButtonColor: 'crimson'
        })
        .then((querExcluir) => {
            if (querExcluir.value)
                enviarAjaxExclusao(ids_tags)
        })
}

function excluirTagsSelecionadas() {
    var ids_tags = []
    datatable.rows({ selected: true })
        .data()
        .toArray()
        .forEach((row) => {
            ids_tags.push(row.tags.id)
        })

    if (ids_tags.length == 0) {
        swal.fire("Excluir selecionados", "Nenhuma linha selecionada. Selecione uma Tag RFID clicando em sua linha na tabela.", "error")
    } else {
        swal.fire({
                type: 'warning',
                title: "Excluir " + ids_tags.length + " tag(s) RFID",
                text: 'Deseja realmente excluir as Tags selecionadas? Após a exclusão, as tags estarão livres para serem recadastradas com outras bicicletas. De preferência, certifique-se de ter o consentimento de todos os donos.',
                showCancelButton: true,
                cancelButtonText: 'Não',
                confirmButtonText: 'Sim, excluir',
                confirmButtonColor: 'crimson'
            })
            .then((querExcluir) => {
                if (querExcluir.value)
                    enviarAjaxExclusao(ids_tags)
            })
    }
}

function enviarAjaxExclusao(ids_tags) {
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'crudAjax/ajaxDeletarTagsRFID',
        dataType: 'json',
        data: { ids_tags },
        beforeSend: function() {
            $("#btnExcluirSelecionados")
                .html(loadingImg())
        },
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire("Sucesso!", "Tags RFID excluídas com sucesso. Lembre-se: apenas o código UID da Tag foi removida do sistema. Ela pode agora ser recadastrada apontando para outra bicicleta, se for preciso.", "success")
            } else {
                swal.fire("Erro", response['error_message'], "error")
            }
            atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
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
    datatable = $('#tableTags').DataTable({
        "fixedHeader": {
            footer: true
        },
        'select': {
            style: 'multi'
        },
        "columnDefs": [{
                // Centraliza o conteúdo das colunas referentes aos botões
                "className": "dt-center",
                "targets": '_all'
            },
            {
                // Remove a opção 'ordenar' das colunas referentes aos botões
                "orderable": false,
                "targets": -1
            },
            {
                // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                "render": function(cores, type, row) {

                    let modelo = row.bikes.nome_modelo.toLowerCase()
                    let output = `<div onclick="abrirPainelLateralBike(${row.bikes.id})" 
                            class="bike-color" style="background: ${cores};">`
                    output += `<img src="${BASE_URL}public/img/icons/bike-${modelo}.png" title="Bike" alt=""></div>`
                    return output
                },
                "targets": 2 // Coluna referente à cor.
            },
            {
                // Estiliza a coluna referente à situação da bicicleta
                "render": function(situacao) {
                    var badge_class = 'd-none'; // por padrão, esconde a identificação de tipo antes de verificar se é válido

                    if (situacao === 'Ativa')
                        badge_class = 'badge-success';
                    else if (situacao === 'Inativa')
                        badge_class = 'badge-danger';

                    return '<span class="badge ' + badge_class + '"><h6><b>' + situacao + '</b></h6></span>';
                },
                "targets": 6
            },
            {
                // Adiciona um link para o perfil de cada usuário
                "render": function(nome, type, row) {
                    let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                    output += '<span onclick="abrirPerfilLateralUsuario(' + row.users.id + ')">' + nome.split(" ")[0] + '</span>'
                    output += '<span class="tooltiptext-w3">'
                    output += 'Clique para ver mais'
                    output += '</span>'
                    return output
                },
                "targets": 7 // Coluna referente ao nome.
            },
            {
                "width": "15%",
                "targets": 2
            }, // Garante que a coluna da cor terá um tamanho adequado

            // Define a ordem de prioridade de visibilidade de cada coluna
            {
                responsivePriority: 10001,
                targets: 7
            },
            {
                responsivePriority: 10002,
                targets: 3
            },
        ],
        // Configura o comportamento do botão '+' (mais informações)
        // O padrão, caso nenhuma cofiguração seja feita, é expandir a linha para baixo
        // Esta configuração abre um modal ao invés disso
        "responsive": {
            details: {
                // Abre um modal com as informações da linha
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(linha) {
                        return 'Tag RFID # ' + linha.data().tags.codigo
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        "language": {
            "url": BASE_URL + 'public/js/Portuguese.json'
        },
        'processing': true,
        ajax: {
            type: "POST",
            url: BASE_URL + 'crudAjax/ajaxListarTagsRFID'
        },
        "columns": [{
                data: "tags.id"
            },
            {
                data: "tags.codigo"
            },
            {
                data: "bikes.cores"
            },
            {
                data: "bikes.nome_modelo"
            },
            {
                data: "bikes.marca"
            },
            {
                data: "bikes.aro"
            },
            {
                data: "bikes.situacao"
            },
            {
                data: "users.nome"
            },
            {
                "render": function() {
                    return `<button onclick="excluirTag(this);" class="btn btn-danger bmd-btn-icon">
                                <i class="material-icons">delete</i>
                            </button>`;
                }
            }
        ]
    });
}

function configurarSelectBicicleta() {
    // Atualizar select bicicleta ao escolher um usuário
    $('#selectUsuario').change(function() {
        var id_usuario = $(this).val();
        if (id_usuario) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'crudAjax/gerarOpcoesDeBikesPorUsuario',
                data: { id_usuario },
                success: function(html) {
                    $('#selectBicicleta').html(html);
                }
            });
        } else {
            $('#selectBicicleta').html('<option value="">Primeiramente, selecione um usuário.</option>');
        }
    });

    // Atualizar a div cores ao escolher uma bicicleta
    $('#selectBicicleta').change(function() {
        var cores = $('#selectBicicleta option:selected').data('color');
        if (!cores) cores = '#fff'
        $("#selectedBikeColor").css('background', cores)
    })
}