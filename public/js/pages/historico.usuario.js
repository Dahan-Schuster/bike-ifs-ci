var datatable;

$(document).ready(function() {
    let timestamp = getTimeStampAtual()
    popularTabela(timestamp);
    criarEConfigurarSelectData()
    setInterval(function() {
        datatable.ajax.reload();
    }, 1800000); // atualiza a tabela a cada 2 minutos

    $(".nav-link")
        .removeClass('active')
    $("#navLinkHistorio")
        .addClass('active')

});

function popularTabela(timestamp) {
    datatable = $('#tableRegistros').DataTable({
        "dom": `frt"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"`,
        "columnDefs": [{
                // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                "render": function(cores, type, row) {
                    let modelo = row.bikes.modelo.toLowerCase()
                    let output = `<div onclick="abrirPainelLateralBike(${row.bikes.id})" 
                                class="bike-color" style="background: ${cores};">`
                    output += `<img src="${BASE_URL}public/img/icons/bike-${modelo}.png" title="Bike" alt=""></div>`
                    return output
                },
                "targets": 3 // Coluna referente à cor.
            },
            {
                "width": "10%",
                "targets": 3
            }, // Garante que a coluna da cor terá um tamanho adequado
        ],
        "language": {
            "url": BASE_URL + "public/js/Portuguese.json"
        },
        ajax: {
            type: "POST",
            url: BASE_URL + "crudAjax/ajaxListarRegistrosDoDia",
            data: {
                from_logged_user: true,
                timestamp
            }
        },
        'processing': true,
        "columns": [{
                data: "registros.id"
            },
            {
                data: "registros.data_hora"
            },
            {
                data: "registros.obs"
            },
            {
                data: "bikes.cores"
            },
            {
                data: "funcionarios_entrada.nome"
            },
            {
                data: "registros.num_trava"
            },
            {
                data: "saidas.data_hora"
            },
            {
                data: "saidas.obs"
            },
            {
                data: "funcionarios_saida.nome"
            }
        ]
    });
}

/**
 * Cria um input, instancia-o com o método datepicker() (Framework Gijgo.js),
 * e configura para destruir e repopopular a datatable com o método popularTabela
 * 
 * Utilizado nas tabelas com listagem por dia (registros, registros-do-dia, emails)
 * 
 * @param {object} datatable o objeto retornado apóis usar o método .DataTable()
 * @param {function} callback função responsável por popular a datatable
 */
function criarEConfigurarSelectData() {
    var selectData = document.createElement('input')
    selectData.id = "selectData"
    selectData.width = "312"
    selectData.autocomplete = "off"
    $(selectData).addClass('form-control')

    var labelSelectData = document.createElement('label')
    labelSelectData.for = "selectData"
    labelSelectData.innerHTML = "Pesquisar por data:"

    $(".div-datepicker").append(labelSelectData).append(selectData)
    $(selectData).datepicker({
        modal: true,
        header: true,
        footer: true,
        format: 'dd/mm/yyyy',
        uiLibrary: 'materialdesign',
        iconsLibrary: 'materialicons',
        change: function(e) {
            datatable.destroy()
            let data = $(selectData).val().substring(6) + '-' + $(selectData).val().substring(3, 5) + '-' + $(selectData).val().substring(0, 2)
            popularTabela(getTimeStampAtual(data))
        }
    })
}