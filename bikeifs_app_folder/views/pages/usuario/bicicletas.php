<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'usuario') { ?>
        <div class="row">
            <span class="col-12">
                <h1>Lista de bicicletas</h1>
            </span>
        </div>
        <hr class="my-3">
        <div class="table-responsive">
            <table class="table table-sm responsive bg-light table-bordered table-striped table-hover" id="tableBikes" style="width: 100%;">
                <caption>Lista de bicicletas</caption>
                <thead class="table-h">
                    <tr>
                        <th>&#9432;</th>
                        <th>Cor</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Obs</th>
                        <th>Aro</th>
                        <th>Situacao</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot class="table-f">
                    <tr>
                        <th>&#9432;</th>
                        <th>Cor</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Obs</th>
                        <th>Aro</th>
                        <th>Situacao</th>
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


    $(document).ready(function() {
        popularTabela();
        setInterval(function() {
            tabela.ajax.reload();
        }, 120000); // atualiza a tabela a cada 2 minutos
    });

    function alterarSituacao(bike, situacao) {
        if (situacao == 'Ativa')
            desativar(bike)
        else if (situacao == 'Inativa')
            ativar(bike)
    }

    function ativar(bike) {
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/ativar/bicicleta.php',
            data: {
                bike
            },
            success: function(res) {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                tabela.ajax.reload();
            }
        });

    }

    function desativar(bike) {
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/desativar/bicicleta.php',
            data: {
                bike
            },
            success: function() {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                tabela.ajax.reload();
            }
        });

    }

    function popularTabela() {
        tabela = $('#tableBikes').DataTable({
            "columnDefs": [{
                    // Centraliza o conteúdo das colunas referentes aos botões
                    "className": "dt-center",
                    "targets": [-1]
                },
                {
                    // Remove a opção 'ordenar' das colunas referentes aos botões
                    "orderable": false,
                    "targets": [-1]
                },
                {
                    // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                    // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                    // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                    "render": function(cores) {
                        atualizarArrayCores(cores);
                        cssBackground = criarCssBackground();
                        return '<div class="bike-color" style="background: ' + cssBackground + ';"><img src="http://bikeifs.com/public/img/icons/bycicle.png" title="Bike" alt=""></div>';
                    },
                    "targets": 1 // Coluna referente à cor.
                },
                {
                    // Define um switch para a situação da bike
                    "render": function(situacao, type, row) {
                        var checked = ''

                        if (situacao == 'Ativa')
                            checked = 'checked'

                        return `<div class="custom-control custom-switch">
                                    <input onchange="alterarSituacao('` + row.id + `', '` + situacao + `')" 
                                        type="checkbox" class="custom-control-input" id="switchSituacao` + row.id + `" ` + checked + `>
                                    
                                    <label class="custom-control-label" for="switchSituacao` + row.id + `">` + situacao + `</label>
                                </div>`;
                    },
                    "targets": -1 // Coluna referente à situação.
                },
                // Define a ordem de prioridade de visibilidade de cada coluna
                {
                    responsivePriority: 10001,
                    targets: 4
                },
                {
                    "width": "10%",
                    "targets": 1
                }, // Garante que a coluna da cor terá um tamanho adequado
            ],
            "language": {
                "url": "http://bikeifs.com/public/lib/scripts/Portuguese.json"
            },
            ajax: {
                type: "POST",
                url: "http://bikeifs.com/app/src/controller/carregar/bicicletas-usuario.php",
                data: {
                    id: "<?php echo $_SESSION['id'] ?>"
                }
            },
            "columns": [{
                    data: "id"
                },
                {
                    data: "cores"
                },
                {
                    data: "modelo"
                },
                {
                    data: "marca"
                },
                {
                    data: "obs"
                },
                {
                    data: "aro"
                },
                {
                    data: "situacao"
                }
            ]
        });
    }

    function recuperarInformacoesDaLinha(button) {
        return tabela.row(button.closest('tr')).data();
    }
</script>