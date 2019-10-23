<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario') { ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>Registros</h1>
            </span>
            <div class="col-md-3"></div>
            <a class="col-11 col-md-3 btn btn-success mu-0 mb-3 mx-auto" href="?pagina=listagem" role="button">
                Voltar para o menu de listagem
            </a>
        </div>
        <hr class="my-3">
        <div class="row">
            <label for="selectData" class="col-12 col-md-1 py-0 my-1">
                <h4><span class="badge badge-secondary">Listar por data</span></h4>
            </label>
            <input type='date' id="selectData" class="form-control col-11 col-md-3 mx-auto">
            <div class="col-md-5">
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-sm responsive bg-light table-bordered table-striped table-hover" id="tableRegistros" style="width: 100%">
                    <caption>Lista de registros</caption>
                    <thead class="table-h">
                        <tr>
                            <th></th>
                            <th class="all">Hora entrada</th>
                            <th class="desktop">Obs entrada</th>
                            <th class="all">Func. entrada</th>
                            <th class="none">Nº trava:</th>
                            <th class="all">Bicicleta</th>
                            <th class="min-tablet">Usuário</th>
                            <th class="none">Hora saída:</th>
                            <th class="none">Obs saída:</th>
                            <th class="none">Funcionário saída:</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot class="table-f">
                        <tr>
                            <th></th>
                            <th>Hora entrada</th>
                            <th>Obs entrada</th>
                            <th>Func. entrada</th>
                            <th>Nº trava</th>
                            <th>Bicicleta</th>
                            <th>Usuário</th>
                            <th>Hora saída</th>
                            <th>Obs saída</th>
                            <th>Funcionário saída</th>
                        </tr>
                    </tfoot>
                </table>
                <br>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger" role="alert">
                Você não tem permissão para acessar esta página.
            </div>
        <?php }
        } else { ?>
        <div class="alert alert-danger" role="alert">
            É necessário fazer login para acessar esta página.
        </div>
    <?php } ?>

    <script language="JavaScript" src="http://bikeifs.com/public/lib/scripts/escolher.cores.slim.js"></script>
    <script type="text/javascript">
        var tabelaRegistros;

        $(document).ready(function() {
            popularTabelaRegistros();
            configurarSelectData();
            setInterval(function() {
                tabelaRegistros.ajax.reload();
            }, 120000); // atualiza a tabela a cada 2 minutos
        });

        function popularTabelaRegistros() {
            tabelaRegistros = $('#tableRegistros').DataTable({
                "fixedHeader": {
                    footer: true
                },
                "sScrollX": false,
                "order": [
                    [1, "desc"]
                ],
                "rowGroup": {
                    startRender: null,
                    endRender: function(rows, group) {
                        return group;
                    },
                    dataSrc: 'registros.data'
                },
                "columnDefs": [{
                        // Centraliza o conteúdo das colunas referentes aos botões
                        "className": "dt-center",
                        "targets": '_all'
                    },
                    {
                        // Remove a opção 'ordenar' das colunas referentes aos botões
                        "orderable": false,
                        "targets": [0, 5, -1]
                    },
                    {
                        // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                        // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                        // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                        "render": function(cores, type, row) {
                            atualizarArrayCores(cores);
                            cssBackground = criarCssBackground();

                            let modelo = row.bikes.modelo.toLowerCase()
                            let output = `<div onclick="abrirPainelLateralBike(` + row.bikes.id + `)" 
                                class="bike-color" style="background: ` + cssBackground + `;">`
                            output += '<img src="http://bikeifs.com/public/img/icons/bike-' + modelo + '.png" title="Bike" alt=""></div>'
                            return output
                        },
                        "targets": 5 // Coluna referente à cor.
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
                        "targets": 6 // Coluna referente ao nome.
                    },
                    {
                        // Adiciona um link para o perfil de cada funcionário (entrada)
                        "render": function(nome, type, row) {
                            let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                            output += '<span onclick="abrirPerfilLateralFuncionario(' + row.funcionarios_entrada.id + ')">' + nome.split(" ")[0] + '</span>'
                            output += '<span class="tooltiptext-w3">'
                            output += 'Clique para ver mais'
                            output += '</span>'
                            return output
                        },
                        "targets": 3 // Coluna referente ao nome do funcionário (entrada).
                    },
                    {
                        // Adiciona um link para o perfil de cada funcionário (saída)
                        "render": function(nome, type, row) {
                            if (nome == 'Pendente')
                                return nome;
                            let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                            output += '<span onclick="abrirPerfilLateralFuncionario(' + row.funcionarios_saida.id + ')">' + nome.split(" ")[0] + '</span>'
                            output += '<span class="tooltiptext-w3">'
                            output += 'Clique para ver mais'
                            output += '</span>'
                            return output
                        },
                        "targets": -1 // Coluna referente ao nome do funcionário (saída).
                    },
                    {
                        "width": "10%",
                        "targets": 5
                    }, // Garante que a coluna da cor terá um tamanho adequado
                ],
                "language": {
                    "url": "http://bikeifs.com/public/lib/scripts/Portuguese.json"
                },
                ajax: {
                    type: "POST",
                    url: "http://bikeifs.com/app/src/controller/carregar/registros.php"
                },
                'processing': true,
                "columns": [{
                        render: function() {
                            return ''
                        }
                    },
                    {
                        data: "registros.hora"
                    },
                    {
                        data: "registros.obs"
                    },
                    {
                        data: "funcionarios_entrada.nome"
                    },
                    {
                        data: "registros.num_trava"
                    },
                    {
                        data: "bikes.cores"
                    },
                    {
                        data: "users.nome"
                    },
                    {
                        data: "saidas.hora"
                    },
                    {
                        data: "saidas.obs"
                    },
                    {
                        data: "funcionarios_saida.nome"
                    },
                ]
            });
        }
        // Pesquisar os registros de acordo com a data escolhida
        function configurarSelectData() {
            let hoje = new Date().toISOString().substr(0, 10)
            $('#selectData').val(hoje)
            $('#selectData').change(function() {
                var dataFormatada = ($(this).val().length == 0 ? '' : formatarDataUSA_BR($(this).val()));
                tabelaRegistros.column(1).search(dataFormatada).draw();
            })
        }
    </script>