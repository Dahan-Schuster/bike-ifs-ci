var datatable;

$(document)
    .ready(function() {
        popularTabela();
        popularTabelaPesquisarUsuario();
        configurarSelectBicicleta();
        configurarModalLerTag();
        escutarIframe()

        setInterval(function() {
            atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable);
        }, 120000); // atualiza a tabela a cada 2 minutos

        // Máscara do UID da tag RFID no formulário de cadastro
        $("#inputUID")
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
                $(this)
                    .find('#selectBicicleta')
                    .html('<option value="">Primeiramente, selecione um usuário.</option>');

            })

    });

$("#formCadastroTag")
    .submit(function(form) {
        form.preventDefault()

        const data = `id_bicicleta=${$('.dd-selected-value').val()}&${$(this).serialize()}`

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'tagRFID',
            dataType: 'json',
            data: data,
            beforeSend: function() {
                $("#btnEnviarCadastro")
                    .html(loadingImg('Validando dados...'))
            },
            success: function(response) {
                if (response['status'] == 1) {
                    atualizarDataTable(document.getElementById('btnSelecionarLinhas'), datatable)
                    fecharModal($('#modalCadastroTag'))
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
    const ids_tags = []
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
        url: BASE_URL + 'tagRFID/delete',
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
                // Define uma imagem da foto da bike
                "render": function(foto_url, type, row) {
                    return `<img onclick="abrirPainelLateralBike(${row.bikes.id})"
                                rel="popover" class="img-fluid img-thumbnail" 
                                src="${foto_url}" title="Foto da bike" alt="foto">`;
                },
                "targets": 3 // Coluna referente à foto.
            },
            {
                // Estiliza a coluna referente à situação da bicicleta
                "render": function(situacao) {
                    return `<i class="material-icons ${situacao == 'Ativa' ? 'text-success"> thumb_up' : 'text-danger"> thumb_down'}</i>`;
                },
                "targets": 7
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
                "targets": -2 // Coluna referente ao nome.
            },
            {
                "width": "15%",
                "targets": 2
            }, // Garante que a coluna da cor terá um tamanho adequado
            {
                "width": "8%",
                "targets": 3
            }, // Garante que a coluna da foto terá um tamanho adequado

            // Define a ordem de prioridade de visibilidade de cada coluna
            {
                responsivePriority: 10001,
                targets: 8
            },
            {
                responsivePriority: 10002,
                targets: 4
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
            type: "GET",
            url: BASE_URL + 'tagRFID'
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
                data: "bikes.foto_url"
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
        ],
        drawCallback: function() {
            configurarZoomImagens($("#popperZoomImagem"))
        }
    });
}

function configurarSelectBicicleta() {
    $('#selectBicicleta').ddslick({
        width: '100%'
    })

    // Atualizar select bicicleta ao escolher um usuário
    $('#selectUsuario').on('change', function() {
        const id_usuario = $(this).val();
        if (id_usuario) {
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'bicicleta/gerarOpcoesDeBikesPorUsuario',
                data: { id_usuario },
                success: function(html) {
                    $('#selectBicicleta').ddslick('destroy')
                    $('#selectBicicleta').html(html);

                    // Plugin JQuery que irá transformar os atributos data-imagesrc de cada option em imagens
                    // Esses atributos são preenchidos pelo controlador com as fotos da bikes
                    $('#selectBicicleta').ddslick({
                        width: '100%',
                        height: '190px',
                        onSelected: function() {
                            configurarZoomImagens($("#popperZoomImagem"))
                        }
                    });

                    configurarZoomImagens($("#popperZoomImagem"))
                }
            });
        } else {
            $('#selectBicicleta').html('<option value="">Primeiramente, selecione um usuário.</option>');
        }
    });

}