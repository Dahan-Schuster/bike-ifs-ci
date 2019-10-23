function desenharGraficoTiposUsuarios(canvas, ctx) {
    $.ajax({
        url: 'http://bikeifs.com/app/src/controller/contar/tipos-de-usuarios.php',
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
        url: 'http://bikeifs.com/app/src/controller/contar/modelos-de-bikes.php',
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
        url: 'http://bikeifs.com/app/src/controller/contar/bikes-com-rfid.php',
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
        url: 'http://bikeifs.com/app/src/controller/contar/registros-por-dia.php',
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
        url: 'http://bikeifs.com/app/src/controller/contar/registros-por-semana.php',
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
        url: 'http://bikeifs.com/app/src/controller/contar/registros-por-mes.php',
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