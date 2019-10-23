<?php
@session_start();
if (isset($_SESSION['login'])) :
    if ($_SESSION['tipoAcesso'] == 'admin') : ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>
                    Relatórios
                    <button data-toggle="modal" data-target="#modalImprimirPDF" class="btn btn-outline-secondary">
                        <img src="http://bikeifs.com/public/img/icons/printer.png">
                    </button>
                </h1>
            </span>
            <div class="col-md-3"></div>
            <a class="col-12 col-md-3 btn btn-success mu-0 mb-3" href="?pagina=restrita" role="button">
                Voltar para a área restrita
            </a>
        </div>
        <hr>
        <br>
        <div class="row canvas-list">
            <div class="col-12 col-md-6 my-3">
                <canvas title="Clique para expandir" class="bg-light p-4 border border-dark" id="graficoA" data-texto='Relação entre os tipos de usuários cadastrados no sistema'></canvas>
            </div>
            <div class="col-12 col-md-6 my-3">
                <canvas title="Clique para expandir" class="bg-light p-4 border border-dark" id="graficoB" data-texto='Quantidade de cada modelo de bicicleta cadastrado no sistema'></canvas>
            </div>
            <div class="col-12 col-md-6 my-3">
                <canvas title="Clique para expandir" class="bg-light p-4 border border-dark" id="graficoC" data-texto='Relação entre as bicicletas que possuem e não possuem Tag RFID'></canvas>
            </div>
            <div class="col-12 col-md-6 my-3">
                <canvas title="Clique para expandir" class="bg-light p-4 border border-dark" id="graficoD" data-texto='Quantidade de registros de cada dia desde <?php echo date('d/m/Y', strtotime('-13 days')); ?> até <?php echo date('d/m/Y'); ?>.'></canvas>
            </div>
            <div class="col-12 col-md-6 my-3">
                <canvas title="Clique para expandir" class="bg-light p-4 border border-dark" id="graficoE" data-texto='Quantidade de registros de cada uma das oito semana anteriores'></canvas>
            </div>
            <div class="col-12 col-md-6 my-3">
                <canvas title="Clique para expandir" class="bg-light p-4 border border-dark" id="graficoF" data-texto='Quantidade de registros de cada mês do ano'></canvas>
            </div>
        </div>
        <!-- --------------------------- -->
        <!-- Modal expandir canvas -->
        <div id="modalExpandirCanvas" class="modal fade" role="dialog">
            <div style="max-width:90%; width: 60%; height: 60%;" class="modal-dialog modal-dialog-centered mx-auto">

                <!-- Modal content-->
                <div class="modal-content" style="height: fit-content; width: auto; min-width: 100%; border-radius: 0;">
                    <div class="modal-header bg-danger">
                        <h3 class="modal-title text-light">Gráfico expandido.</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="height: fit-content">
                        <canvas class="bg-light p-4 border border-dark" id="graficoModal"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" onclick="baixarPDFModal()" data-dismiss="modal">Imprimir PDF</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fim modal expandir canvas -->
        <!-- --------------------------- -->
        <!-- Modal imprimir pdf -->
        <div id="modalImprimirPDF" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h3 class="modal-title text-light">Imprimir relatórios como PDF.</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4>Selecione quais gráficos deseja incluir no PDF.</h4>
                        <hr>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" data-canvas="graficoA" class="custom-control-input" id="switchImprimirGraficoTiposDeUsuarios">
                            <label class="custom-control-label" for="switchImprimirGraficoTiposDeUsuarios">Tipos de Usuários</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" data-canvas="graficoB" class="custom-control-input" id="switchImprimirGraficoModelosDeBikes">
                            <label class="custom-control-label" for="switchImprimirGraficoModelosDeBikes">Modelos de Bikes</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" data-canvas="graficoC" class="custom-control-input" id="switchImprimirGraficoBikesComTag">
                            <label class="custom-control-label" for="switchImprimirGraficoBikesComTag">Bikes que possuem Tag RFID</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" data-canvas="graficoD" class="custom-control-input" id="switchImprimirGraficoRegPorDia">
                            <label class="custom-control-label" for="switchImprimirGraficoRegPorDia">Registros dos últimos 14 dias</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" data-canvas="graficoE" class="custom-control-input" id="switchImprimirGraficoRegPorMes">
                            <label class="custom-control-label" for="switchImprimirGraficoRegPorMes">Registros as últimas 8 semanas</label>
                        </div>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" data-canvas="graficoF" class="custom-control-input" id="switchImprimirGraficoRegPorAno">
                            <label class="custom-control-label" for="switchImprimirGraficoRegPorAno">Registros do ano por mês</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button onclick="baixarPDFGraficos()" type="button" class="btn btn-danger">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fim modal imprimir pdf -->
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            Você não tem permissão para acessar esta página.
        </div>
    <?php endif;
    else : ?>
    <div class="alert alert-warning" role="alert">
        É necessário fazer login para acessar esta página.
    </div>
<?php endif; ?>
<link rel="stylesheet" type="text/css" href="http://bikeifs.com/public/lib/css/chart.min.css">
<script language="javascript" src="http://bikeifs.com/public/lib/scripts/chart.min.js"></script>
<script language="javascript" src="http://bikeifs.com/public/lib/scripts/chartjs-plugin-datalabels.min.js"></script>
<script language="javascript" src="http://bikeifs.com/public/lib/scripts/jspdf.min.js"></script>
<script language="javascript" src="http://bikeifs.com/public/lib/scripts/desenhar.graficos.js"></script>
<script type="text/javascript">
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
        pdf = adicionarCapa(pdf)

        pdf.setFontSize(14)

        var texto = $("#graficoModal").data('texto')
        pdf.text(15, 25, '# ' + texto)
        pdf.addImage(canvasModal.toDataURL('image/png'), 'PNG', 15, 40, 180, 90)

        pdf.save('Bike-IFS_Relatorio_<?php echo date('d-m-Y_H-i-s'); ?>.pdf')

    }

    function baixarPDFGraficos() {
        if (!$("input[type='checkbox']").is(":checked")) {
            alert('Nenhum gráfico selecionado!')
            return
        }
        var pdf = new jsPDF()
        pdf = adicionarCapa(pdf)

        pdf.setFontSize(14)

        var distanciaTopo = 25;

        var checkboxesSelecionados = $("input[type='checkbox']:checked").toArray()
        checkboxesSelecionados.forEach((checkbox, index) => {
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

        pdf.save('ts.pdf')
    }

    function adicionarCapa(pdf) {
        getDataUri('../../img/img-logo.png', function(logo) {
            localStorage.setItem('logo-uri', logo)
        });

        pdf.setFontSize(26)
        pdf.text(90, 150, 'Bike IFS')

        pdf.setFontSize(20)
        pdf.text(60, 160, 'Relatório de dados do sistema')

        pdf.addImage(localStorage.getItem('logo-uri'), 'PNG', 80, 90, 55, 50)

        pdf.addPage()

        return pdf
    }
</script>