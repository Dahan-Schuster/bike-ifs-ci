let canvasModal = document.getElementById('graficoModal')

$(document).ready(function() {
    desenharGraficoTiposUsuarios(document.getElementById('graficoA'), $("#graficoA"))
    desenharGraficoModelosBikes(document.getElementById('graficoB'), $("#graficoB"))
    desenharGraficoBikesRfid(document.getElementById('graficoC'), $("#graficoC"))
    desenharGraficoRegistrosPorDia(document.getElementById('graficoD'), $("#graficoD"))
    desenharGraficoRegistrosPorSemana(document.getElementById('graficoE'), $("#graficoE"))
    desenharGraficoRegistrosPorMes(document.getElementById('graficoF'), $("#graficoF"))

    $("#modalExpandirCanvas").on('show.bs.modal', function() {
        canvasModal.remove()
        $(this).find('.modal-body').html('<canvas class="bg-light p-4 border border-dark" id="graficoModal"></canvas>')
        canvasModal = document.getElementById('graficoModal')
    })

    configurarCanvas();

    $(".nav-link").removeClass('active')
    $("#navLinkRelatorios").addClass('active')
})

function configurarCanvas() {

    $("#graficoA").click(function() {
        $("#modalExpandirCanvas").modal('show')
        $("#modalExpandirCanvas").find('#graficoModal').attr('data-texto', $(this).data('texto'))
        desenharGraficoTiposUsuarios(canvasModal, $("#graficoModal"))
    })

    $("#graficoB").click(function() {
        $("#modalExpandirCanvas").modal('show')
        $("#modalExpandirCanvas").find('#graficoModal').attr('data-texto', $(this).data('texto'))
        desenharGraficoModelosBikes(canvasModal, $("#graficoModal"))
    })

    $("#graficoC").click(function() {
        $("#modalExpandirCanvas").modal('show')
        $("#modalExpandirCanvas").find('#graficoModal').attr('data-texto', $(this).data('texto'))
        desenharGraficoBikesRfid(canvasModal, $("#graficoModal"))
    })

    $("#graficoD").click(function() {
        $("#modalExpandirCanvas").modal('show')
        $("#modalExpandirCanvas").find('#graficoModal').attr('data-texto', $(this).data('texto'))
        desenharGraficoRegistrosPorDia(canvasModal, $("#graficoModal"))
    })

    $("#graficoE").click(function() {
        $("#modalExpandirCanvas").modal('show')
        $("#modalExpandirCanvas").find('#graficoModal').attr('data-texto', $(this).data('texto'))
        desenharGraficoRegistrosPorSemana(canvasModal, $("#graficoModal"))
    })

    $("#graficoF").click(function() {
        $("#modalExpandirCanvas").modal('show')
        $("#modalExpandirCanvas").find('#graficoModal').attr('data-texto', $(this).data('texto'))
        desenharGraficoRegistrosPorMes(canvasModal, $("#graficoModal"))
    })
}

function baixarPDFModal() {

    var pdf = new jsPDF()
    pdf = adicionarCabecalho(pdf)

    pdf.setFontSize(14)

    var texto = $("#graficoModal").data('texto')
    pdf.text(15, 40, '# ' + texto)
    pdf.addImage(canvasModal.toDataURL('image/png'), 'PNG', 15, 40, 180, 90)

    pdf.save('Bike-IFS_Relatorio_' + getDataHoraAtual('_'))
}

function baixarPDFGraficos() {
    if (!$("input[type='checkbox']").is(":checked")) {
        alert('Nenhum gráfico selecionado!')
        return
    }
    var pdf = new jsPDF()
    var distanciaTopo = 25;

    var checkboxesSelecionados = $("input[type='checkbox']:checked").toArray()
    checkboxesSelecionados.forEach((checkbox, index) => {
        pdf = adicionarCabecalho(pdf)
    
        pdf.setFontSize(14)
        var texto = $("#" + $(checkbox).data('canvas')).data('texto')
        var grafico = document.getElementById($(checkbox).data('canvas')).toDataURL('image/png')

        pdf.text(15, distanciaTopo, '# ' + texto)
        distanciaTopo += 15 // 25 + 15 = 40 ou 155 + 15 = 170 
        pdf.addImage(grafico, 'PNG', 15, distanciaTopo, 180, 90)
        distanciaTopo += 115 // 40 + 115 = 155 ou 170 + 115 = 285 

        if (distanciaTopo > 155 && index != checkboxesSelecionados.length - 1) {
            pdf.addPage()
            distanciaTopo = 25
        }
    })

    pdf.save('Bike-IFS_Relatorio_'+ getDataHoraAtual('_'))
}

function adicionarCabecalho(pdf) {
    getDataUri(BASE_URL + 'public/img/img-logo.png', function(logo) {
        localStorage.setItem('logo-uri', logo)
    });

    pdf.setFontSize(14)
    pdf.text(30, 10, 'Bike IFS')

    pdf.setFontSize(12)
    pdf.text(30, 15, 'Relatório de dados do sistema')

    pdf.addImage(localStorage.getItem('logo-uri'), 'PNG', 10, 5, 15, 12)

    return pdf
}

function desenharGraficoTiposUsuarios(canvas, ctx) {
    $.ajax({
        url: BASE_URL + 'relatorio/ajaxContarTiposDeUsuarios',
        method: 'GET',
        dataType: 'json',
        success: function(res) {

            dados = []

            dados.push(res.alunos)
            dados.push(res.servidores)
            dados.push(res.visitantes)

            var grafico = new Chart(ctx, {
                type: 'doughnut',
                label: 'Tipos de usuário',
                data: {
                    labels: ['Aluno', 'Servidor', 'Visitante'],
                    datasets: [{
                        label: 'Tipos de usuários',
                        data: dados,
                        backgroundColor: [
                            '#ff6384',
                            '#ffcd56',
                            '#36a2eb'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    title: { display: true, text: 'Quantidade de cada tipo de usuário cadastrado no sistema' },
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'top'
                        }
                    }
                }
            })
        }
    });

}

function desenharGraficoModelosBikes(canvas, ctx) {
    $.ajax({
        url: BASE_URL + 'relatorio/ajaxContarModelosDeBikes',
        method: 'GET',
        dataType: 'json',
        success: function(res) {

            dados = []

            dados.push(res.urbanas)
            dados.push(res.dobraveis)
            dados.push(res.fixas)
            dados.push(res.mountains)
            dados.push(res.speeds)
            dados.push(res.bmxs)
            dados.push(res.downhills)
            dados.push(res.eletricas)

            var grafico = new Chart(ctx, {
                type: 'bar',
                label: 'Modelos de bicicleta',
                data: {
                    labels: [
                        'Urbana',
                        'Dobrável',
                        'Fixa',
                        'Mountain',
                        'Speed',
                        'BMX',
                        'Downhill',
                        'Elétrica'
                    ],
                    datasets: [{
                        label: 'Modelos de bicicleta',
                        data: dados,
                        backgroundColor: [
                            '#ff6384',
                            '#cccccc',
                            '#36a2eb',
                            '#e4a2fb',
                            '#66d28b',
                            '#bb70bb',
                            '#7080ff',
                            '#ffbb30'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    title: { display: true, text: 'Quantidade de cada modelo de bicicleta entre as cadastradas no sistema' }
                }
            })
        }
    });
}

function desenharGraficoBikesRfid(canvas, ctx) {
    $.ajax({
        url: BASE_URL + 'relatorio/ajaxContarBikesComRFID',
        method: 'GET',
        dataType: 'json',
        success: function(res) {

            dados = []

            dados.push(res.com)
            dados.push(res.sem)

            var grafico = new Chart(ctx, {
                type: 'pie',
                label: 'Bicicletas que possuem RFID',
                data: {
                    labels: ['Possui', 'Não Possui'],
                    datasets: [{
                        label: 'Quantidade de bicicletas',
                        data: dados,
                        backgroundColor: [
                            '#36a2eb',
                            '#cccccc'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    title: { display: true, text: 'Quantidade de bicicletas com e sem tags RFID cadastradas' }
                }
            })
        }
    });
}

function desenharGraficoRegistrosPorDia(canvas, ctx) {
    $.ajax({
        url: BASE_URL + 'relatorio/ajaxContarRegistrosPorDia',
        method: 'GET',
        dataType: 'json',
        success: function(res) {

            var labels = []
            var dados = []
            
            res.forEach(b => {
                labels.push(b.dia)
                dados.push(b.count)
            })


            var grafico = new Chart(ctx, {
                type: 'bar',
                label: 'Registros dos últimos 14 dias',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Registros do dia',
                        data: dados,
                        backgroundColor: [
                            '#008080',
                            '#CCCCCC',
                            '#32CD32',
                            '#BA55D3',
                            '#00CCFF',
                            '#2E8B57',
                            '#E9967A',
                            '#9400D3',
                            '#ADD8E6',
                            '#DC143C',
                            '#FF8C00',
                            '#FF8C00',
                            '#CD5C5C',
                            '#778899'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    title: { display: true, text: 'Quantidade de registros de cada um dos últimos 14 dias' },
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Dia'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            })

        }
    });
}

function desenharGraficoRegistrosPorSemana(canvas, ctx) {
    $.ajax({
        url: BASE_URL + 'relatorio/ajaxContarRegistrosPorSemana',
        method: 'GET',
        dataType: 'json',
        success: function(res) {

            var labels = []
            var dados = []

            res.forEach(b => {
                labels.push(b.semana)
                dados.push(b.count)
            })


            var grafico = new Chart(ctx, {
                type: 'line',
                label: 'Registros das últimas 8 semanas',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Registros da semana',
                        data: dados,
                        backgroundColor: 'rgba(153, 102, 255, 0.5)',
                        borderColor: 'rgb(153, 102, 255)',
                        fill: 'start'

                    }]
                },
                options: {
                    responsive: true,
                    title: { display: true, text: 'Quantidade de registros em cada uma das últimas 8 semanas' },
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Número da semana'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                title: 'AAA',
                                beginAtZero: true
                            }
                        }]
                    }
                }
            })
        }
    });
}

function desenharGraficoRegistrosPorMes(canvas, ctx) {
    $.ajax({
        url: BASE_URL + 'relatorio/ajaxContarRegistrosPorMes',
        method: 'GET',
        dataType: 'json',
        success: function(res) {

            var labels = []
            var dados = []

            res.forEach(b => {
                labels.push(b.mes)
                dados.push(b.count)
            })


            var grafico = new Chart(ctx, {
                type: 'line',
                label: 'Registros do mês',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Registros do mês',
                        data: dados,
                        fill: 'start',
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgb(54, 162, 235)'
                    }]
                },
                options: {
                    responsive: true,
                    title: { display: true, text: 'Quantidade de registros em cada mês do ano' },
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Mês'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            display: true
                        }]
                    }
                }
            })

        }
    });
}