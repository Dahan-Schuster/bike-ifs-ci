<div class="row">
    <span class="col-12">
        <h1>
            Relatórios
            <button type="button" data-toggle="modal" data-target="#modalImprimirPDF" class="btn btn-danger bmd-btn-fab">
                <i class="material-icons pl-3">printer</i>
            </button>
        </h1>
    </span>
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
            <div class="modal-header raised pb-3">
                <h3 class="modal-title">Gráfico expandido.</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="height: fit-content">
                <canvas class="bg-light p-4 border border-dark" id="graficoModal"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-raised" onclick="baixarPDFModal()" data-dismiss="modal">Imprimir PDF</button>
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
            <div class="modal-header raised pb-3">
                <h3 class="modal-title">
                    Imprimir relatórios como PDF
                    <i class="material-icons">picture_as_pdf</i>
                </h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="lead">Selecione quais gráficos deseja incluir no PDF.</p>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                <button onclick="baixarPDFGraficos()" type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Imprimir</button>
            </div>
        </div>
    </div>
</div>
<!-- fim modal imprimir pdf -->