<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'usuario') { ?>
        <div class="row">
            <span class="col-12">
                <h1>Histórico de registros</h1>
            </span>
        </div>
        <hr class="my-3">
        <div class="table-responsive">
            <table class="table table-sm responsive bg-light table-bordered table-striped table-hover" id="tableRegistros" style="width: 100%;">
                <caption>Histórico de registros</caption>
                <thead class="table-h">
                    <tr>
                        <th class="all">#</th>
                        <th class="all">Hora entrada</th>
                        <th class="desktop">Obs entrada</th>
                        <th class="desktop">Nome da bike</th>
                        <th class="all">Cor</th>
                        <th class="all">Funcionário entrada</th>
                        <th class="none">Nº trava:</th>
                        <th class="none">Hora saída:</th>
                        <th class="none">Obs saída:</th>
                        <th class="none">Funcionário saída:</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot class="table-f">
                    <tr>
                        <th>&#9432;</th>
                        <th>Hora entrada</th>
                        <th>Obs entrada</th>
                        <th>Nome da bike</th>
                        <th>Cor</th>
                        <th>Funcionário entrada</th>
                        <th>Nº trava</th>
                        <th>Hora saída</th>
                        <th>Obs saída</th>
                        <th>Funcionário saída</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Esta página é restrita para usuários. Para listar bicicletas, acesse a página de listagem de todas a bicicletas.
        </div>
    <?php } 
} else { ?>
    <div class="alert alert-danger" role="alert">
        É necessário fazer login para acessar esta página.
    </div>
<?php } ?>
<script language="JavaScript" src="http://bikeifs.com/public/lib/scripts/escolher.cores.slim.js"></script>
<script type="text/javascript">
    
    var tabela;

    $(document).ready(function(){
        popularTabela();
        setInterval( function () {
            tabela.ajax.reload();
        }, 30000 ); // atualiza a tabela a cada 30 segundos
    });

    function popularTabela() {
        tabela = $('#tableRegistros').DataTable({
            "columnDefs": [
                {
                    // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                    // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                    // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                    "render" : function(cores, type, row) {
                        atualizarArrayCores(cores);
                        cssBackground = criarCssBackground();
                        let output = '<div class="bike-color tooltip-w3" style="background: ' + cssBackground + ';">'
                        output += '<span class="tooltiptext-w3">'
                        output += 'Modelo: ' + row.bikes.modelo + '<br>'
                        output += 'Marca: &nbsp;' + row.bikes.marca + '<br>'
                        output += 'Aro: &nbsp;&nbsp;&nbsp;' + row.bikes.aro + '<br>'
                        output += 'Nome: &nbsp;&nbsp;' + row.bikes.nome + '<br>'
                        output += '</span>'
                        output += '<img src="http://bikeifs.com/public/img/icons/bycicle.png" title="Bike" alt=""></div>' 
                        return output
                    },
                    "targets": 4 // Coluna referente à cor.
                },
                { "width": "10%", "targets": 4 }, // Garante que a coluna da cor terá um tamanho adequado
            ],
            "language": {
                "url": "http://bikeifs.com/public/lib/scripts/Portuguese.json"
            },
            ajax: {
                type: "POST",
                url: "http://bikeifs.com/app/src/controller/carregar/historico-usuario.php",
                data: {id : "<?php echo $_SESSION['id'] ?>"}
            },
            'processing': true,
            "columns": [
                {data : "registros.id"},
                {data : "registros.hora"},
                {data : "registros.obs"},
                {data : "bikes.nome"},
                {data : "bikes.cores"},
                {data : "funcionarios_entrada.nome"},
                {data : "registros.num_trava"},
                {data : "saidas.hora"},
                {data : "saidas.obs"},
                {data : "funcionarios_saida.nome"}
            ]
        });
    }

</script>
