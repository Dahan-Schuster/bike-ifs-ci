<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin') { ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>Exclusão de registros</h1>
            </span>
            <div class="col-md-3"></div>
            <a class="col-11 col-md-3 btn btn-outline-danger mu-0 mb-3 mx-auto" href="?pagina=exclusao" role="button">
                Voltar para o menu de exclusão
            </a>
        </div>
        <hr class="my-3">
        <div class="row">
            <br>
            <div class="table-responsive">
                <table class="table table-sm responsive bg-light table-bordered table-striped table-hover" id="tableRegistros" style="width: 100%">
                    <caption style="caption-side: top">
                        <div class="row">
                            <div class="dropdown col-12 col-lg-6 mb-2">
                                <button style="width: 100%; border-color: #000000A0; text-align: left" class="btn btn-light border rounded " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filtrar por...
                                </button>
                                <div style="width: 95%; font-size: 14px; font-weight: 900" class="dropdown-menu dropdown-filtro" aria-labelledby="dropdownMenuButton">
                                    <div class="dropdown-item dropdown-filtro-item">
                                        <form id="formFiltro">
                                            <div class="form-group row">
                                                <label for="selectIntervalo" class="col-4 col-lg-2 col-form-label">Intervalo:</label>
                                                <div class="col-8 col-lg-3">
                                                    <select class="form-control form-control-sm" id="selectIntervalo">
                                                        <option value="+1 months">Um mês</option>
                                                        <option value="+2 months">Dois meses</option>
                                                        <option value="+3 months">Três meses</option>
                                                        <option value="+6 months">Seis meses</option>
                                                        <option value="+1 years">Um ano</option>
                                                        <option value="+2 years">Dois anos</option>
                                                        <option value="+3 years">Três anos</option>
                                                        <option value="+5 years">Cinco anos</option>
                                                        <option value="todos" class="text-light bg-danger">Todos</option>
                                                    </select>
                                                </div>
                                                <label for="inputDataInicial" class="col-4 col-lg-2 col-form-label">A partir de:</label>
                                                <div class="col-6 col-lg-4">
                                                    <input type="date" class="form-control form-control-sm" id="inputDataInicial">
                                                </div>
                                                <div class="col-1 col-lg-1 text-primary">
                                                    <span style="cursor: pointer" onclick="alert('Pesquise registros entre a data inicial e a quantidade de tempo escolhida')">
                                                        &quest;
                                                    </span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="selectFuncionarioCheckin" class="col-5 col-lg-3 col-form-label">Checkin feito por:</label>
                                                <div class="col-7 col-lg-6">
                                                    <select class="form-control form-control-sm" id="selectFuncionarioCheckin">
                                                        <option value="todos">Qualquer funcionário</option>
                                                        <?php $funcionarios = Funcionario::listarTodos();
                                                                foreach ($funcionarios as $funcionario) {
                                                                    echo '<option value="' . $funcionario['id'] . '">' .
                                                                        $funcionario['cpf'] .
                                                                        ' - ' .
                                                                        $funcionario['nome'] .
                                                                        '</option>';
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                                <div class="custom-control custom-switch px-5 col-10 col-lg-3">
                                                    <input type="checkbox" class="custom-control-input" id="switchApenasFuncionariosAtivosCheckin" checked>
                                                    <label for="switchApenasFuncionariosAtivosCheckin" class="custom-control-label">Apenas ativos</label>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="selectFuncionarioCheckout" class="col-5 col-lg-3 col-form-label">Checkout feito por:</label>
                                                <div class="col-7 col-lg-6">
                                                    <select class="form-control form-control-sm" id="selectFuncionarioCheckout">
                                                        <option value="todos">Qualquer funcionário</option>
                                                        <?php $funcionarios = Funcionario::listarTodos();
                                                                foreach ($funcionarios as $funcionario) {
                                                                    echo '<option value="' . $funcionario['id'] . '">' .
                                                                        $funcionario['cpf'] .
                                                                        ' - ' .
                                                                        $funcionario['nome'] .
                                                                        '</option>';
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                                <div class="custom-control custom-switch px-5 col-10 col-lg-3">
                                                    <input type="checkbox" class="custom-control-input" id="switchApenasFuncionariosAtivosCheckout" checked>
                                                    <label for="switchApenasFuncionariosAtivosCheckout" class="custom-control-label">Apenas ativos</label>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label for="selectTipoUsuario" class="col-5 col-lg-3 col-form-label">Tipo(s) de usuário:</label>
                                                <div class="col-7 col-lg-6">
                                                    <select class="form-control form-control-sm" id="selectTipoUsuario">
                                                        <option value="todos">Qualquer tipo</option>
                                                        <option value="aluno">Aluno</option>
                                                        <option value="servidor">Servidor</option>
                                                        <option value="visitante">Visitante</option>
                                                        <option value="aluno_servidor">Aluno/Servidor</option>
                                                        <option value="aluno_visitante">Aluno/Visitante</option>
                                                        <option value="servidor_visitante">Servidor/Visitante</option>
                                                    </select>
                                                </div>
                                                <div class="custom-control custom-switch px-5 col-10 col-lg-3">
                                                    <input type="checkbox" class="custom-control-input" id="switchApenasUsuariosAtivos" checked>
                                                    <label for="switchApenasUsuariosAtivos" class="custom-control-label">Apenas ativos</label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary mt-3">Pesquisar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 mb-2">
                                <button id="btnSelecionar" style="width: 100%;" class="btn btn-primary">Selecionar todos</button>
                            </div>
                            <div class="col-12 col-lg-3 mb-2">
                                <button onclick="confirmarExclusao()" style="width: 100%;" class="btn btn-danger">Excluir selecionados</button>
                            </div>
                        </div>
                    </caption>
                    <thead class="table-h">
                        <tr>
                            <th>&#9432;</th>
                            <th>Hora entrada</th>
                            <th>Obs entrada</th>
                            <th>Func. entrada</th>
                            <th>Nº trava:</th>
                            <th>Bicicleta</th>
                            <th>Usuário</th>
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
            <!-- Modal confirmar exclusão -->
            <div id="modalConfirmarExclusao" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header alert alert-danger">
                            <h3 class="modal-title">Apagar registros</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <h4 class="mt-0">Está certo de que deseja excluir os registros selecionados?</h4>
                            <hr>
                            <p class="lead">Esta operação é <span class="text-danger">irreversível</span> e irá apagar dados salvos pelo sistema.</p>
                            <p class="lead">Continue <b>apenas se souber o que estiver fazendo</b></p>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-warning" id="adm" data-dismiss="modal" onclick="excluirRegistros();">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim confirmar exclusão -->
            <!---------------------------->
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
            // Define um filtro inicial vazio. Isto fará com que o controlador exiba todos os registros
            let filtro = {}

            // Popula a tabela usando o framework Datatables
            popularTabelaRegistros(filtro);

            // Define um tamanho mínimo para a tabela
            // Isso previne que o filtro de pesquisa seja
            // sobreposto devido à regra CSS overflow-y
            $('.table-responsive').css('min-height', '400px')

            // Preenche o input date do filtro de pesquisa com a data de hoje
            $('#inputDataInicial').val(new Date().toISOString().slice(0, 10));

            // Configura o botão 'Selecionar Todos'
            $("#btnSelecionar").on('click', function() {
                selecionarTodos(this)
            })
        });

        /**
         * Função chamada pelo botão 'Selecionar Todos'
         * Seleciona todas as linhas da tabela,
         * autaliza o html e a cor do botão e altera
         * o evento de onclick do botão para o método
         * desselecionarTodos()
         */
        function selecionarTodos(button) {
            $(button).html('Desselecionar todos');
            $(button).removeClass('btn-primary');
            $(button).addClass('btn-secondary')
            $(button).off('click')
            $(button).on('click', function() {
                desselecionarTodos(button)
            })
            tabelaRegistros.rows().select()
        }

        /**
         * Função chamada pelo botão 'Selecionar Todos'
         * Desseleciona todas as linhas da tabela,
         * autaliza o html e a cor do botão e altera
         * o evento de onclick do botão para o método
         * selecionarTodos()
         */
        function desselecionarTodos(button, ) {
            $(button).html('Selecionar todos');
            $(button).removeClass('btn-secondary');
            $(button).addClass('btn-primary')
            $(button).off('click')
            $(button).on('click', function() {
                selecionarTodos(button)
            })
            tabelaRegistros.rows().deselect()
        }

        function confirmarExclusao() {
            $("#modalConfirmarExclusao").modal('show')
        }

        function excluirRegistros() {
            var registros = Array()
            let linhas = tabelaRegistros.rows({
                selected: true
            }).data().toArray()
            linhas.forEach(linha => {
                registros.push(linha.registros.id)
            })

            $.ajax({
                type: 'POST',
                url: 'http://bikeifs.com/app/src/controller/excluir/registros.php',
                data: {
                    registros
                },
                success: function(res) {
                    console.log(res);
                    if (res == 'success') {
                        alertSnackBar($("#alertaSucesso"), 'Operação realizada com sucesso!')
                        tabelaRegistros.ajax.reload();
                    } else if (res == 'error_1')
                        alertSnackBar($("#alertaInvalido"), 'Um ou mais registros não foram excluídos')
                }
            })
        }

        $("#formFiltro").submit(function(form) {
            form.preventDefault()

            let intervalo = $("#selectIntervalo").val()
            let dataInicial = $("#inputDataInicial").val()

            let funcionarioCheckin = $("#selectFuncionarioCheckin").val()
            let apenasFuncionariosAtivosCheckin = $("#switchApenasFuncionariosAtivosCheckin").is(':checked')

            let funcionarioCheckout = $("#selectFuncionarioCheckout").val()
            let apenasFuncionariosAtivosCheckout = $("#switchApenasFuncionariosAtivosCheckout").is(':checked')

            let tipoUsuario = $("#selectTipoUsuario").val()
            let apenasUsuariosAtivos = $("#switchApenasUsuariosAtivos").is(':checked')

            let filtro = {
                intervalo,
                dataInicial,
                funcionarioCheckin,
                apenasFuncionariosAtivosCheckin,
                funcionarioCheckout,
                apenasFuncionariosAtivosCheckout,
                tipoUsuario,
                apenasUsuariosAtivos
            }

            tabelaRegistros.destroy()
            popularTabelaRegistros(filtro)
        })

        function popularTabelaRegistros(filtro) {
            tabelaRegistros = $('#tableRegistros').DataTable({
                "fixedHeader": {
                    footer: true
                },
                searching: false,
                paging: false,
                "sScrollX": false,
                "order": [
                    1, "desc"
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
                        // Adiciona um link para o perfil de cada funcionário
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
                        // Adiciona um link para o perfil de cada funcionário
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
                'select': {
                    'style': 'multi'
                },
                "language": {
                    "url": "http://bikeifs.com/public/lib/scripts/Portuguese.json"
                },
                ajax: {
                    type: 'POST',
                    url: "http://bikeifs.com/app/src/controller/carregar/registros-filtrados.php",
                    data: {
                        filtro
                    }
                },
                'processing': true,
                "columns": [{
                        render: function() {
                            return ''
                        }
                    }, {
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
    </script>