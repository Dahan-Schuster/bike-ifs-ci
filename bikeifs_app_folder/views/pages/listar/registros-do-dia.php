<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario') { ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>Registros do dia</h1>
            </span>
            <button class="col-8 col-md-4 mr-3 ml-auto btn btn-warning border border-dark mu-0 mb-3" type="button" data-toggle="modal" data-target="#modalRegistroManual">
                Registrar entrada
            </button>
            <button class="col-2 col-md-1 ml-3 mr-auto btn btn-outline-warning border border-dark text-dark mu-0 mb-3" type="button" data-toggle="modal" data-target="#modalLerTag">
                <img src="http://bikeifs.com/public/img/icons/rfid.png" class="img-responsive" title="Ler Tag RFID" alt="Ler Tag Rfid">
            </button>
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
                <table class="table table-sm responsive bg-light table-bordered table-striped table-hover" id="tableRegistros" style="width: 100%;">
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
                            <th class="min-tablet"><i>Check Out</i></th>
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
                            <th><i>Check Out</i></th>
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

    <?php
    include_once('../modals/modalsRegistro.html');
    include_once('../modals/modalPesquisarUsuario.html');
    include_once('../modals/modalLerTag.html');
    include_once('../modals/modalTagNaoEncontrada.html');
    ?>

    <script language="javascript" src="http://bikeifs.com/public/lib/scripts/pesquisar.usuario.js"></script>
    <script language="JavaScript" src="http://bikeifs.com/public/lib/scripts/escolher.cores.slim.js"></script>
    <script type="text/javascript">
        var tabelaRegistros;
        var tabelaUsuarios;
        var botaoRealizarCheckout = `<a onclick="confirmarCheckOut(this);" class="btn btn-danger text-light">
    <img src="http://bikeifs.com/public/img/icons/checkout.png" title="Realizar checkout" alt="Checkout">
                                    </a>`;
        var botaoCheckoutRealizado = `<a onclick="confirmarCheckOut(this);" class="btn btn-success">
    <img src="http://bikeifs.com/public/img/icons/checked.png" title="Checkout realizado" alt="Checked">
                                    </a`;

        $(document).ready(function() {
            let hoje = "<?php echo date('Y-m-d'); ?>"
            popularTabelaRegistros(hoje);
            tabelaUsuarios = popularTabelaPesquisarUsuario();
            configurarModalPesquisarUsuarios(tabelaUsuarios);
            configurarModalCadastroRegistro();
            configurarSelectBicicleta();
            configurarSelectData();
            configurarModalLerTag();
            configurarRegistroAutomatico();
            adicionarEventoRegistro();

            $('#modalPesquisarUsuario').on('hide.bs.modal', function() {
                $('#modalRegistroManual').modal('show');
            });

        });

        function confirmarCheckOut(button) {
            var data = recuperarInformacoesDaLinha(button);
            if (data.saidas.id) {
                $("#modalAvisoCheckOut").modal('show');
                return;
            }

            var id = data.registros.id;
            var user = data.users.nome;
            var userDoc = data.users.matricula;
            var coresBike = data.bikes.cores;
            var modelo = data.bikes.modelo;
            var marca = data.bikes.marca;
            var aro = data.bikes.aro;

            $('#modalConfirmarCheckOut').find('.modal-body').find("#nomeUsuario").val(user + ' - ' + userDoc);

            atualizarArrayCores(coresBike);
            pintarDivCores($('#modalConfirmarCheckOut').find('.modal-body').find("#divBicicleta"));

            $('#modalConfirmarCheckOut').find('.modal-body').find("#divBicicleta").prev().html(
                'Bicicleta: <b>Modelo:</b> ' + modelo + ' - <b>Aro:</b> ' + aro + ' - <b>Marca:</b> ' + marca);

            $('#modalConfirmarCheckOut').find('.modal-footer').find('#check').val(id);
            $('#modalConfirmarCheckOut').modal('show');

        }

        function checkOut() {
            var id = $('#modalConfirmarCheckOut').find('.modal-footer').find('#check').val();
            $('#modalCheckOut').find('.modal-footer').find('#check').val(id);

            $('#modalConfirmarCheckOut').modal('hide');
            $('#modalCheckOut').modal('show');
        }

        // Ação do formulário de Checkout
        $('#formCheckOut').submit(function(form) {

            form.preventDefault();

            var obs = $('#modalCheckOut').find('.modal-body').find('#inputObs').val();
            var id = $('#modalCheckOut').find('.modal-footer').find('#check').val();

            $.ajax({
                type: "POST",
                url: 'http://bikeifs.com/app/src/controller/editar/checkout-registro.php',
                data: {
                    "id": id,
                    "obs": obs
                },
                success: function(reg) {
                    if (reg === 'Acesso negado.')
                        $("#modalAcessoNegado").modal('show');
                    else {
                        alertSnackBar($("#alertaSucesso"),
                            `Checkout realizado! 
                            <button onclick="desfazerCheckout(` + reg.id + `)" class="ml-3 btn bg-primary text-light">Desfazer</button>`)
                        tabelaRegistros.ajax.reload();
                    }

                }
            });

            $('#modalCheckOut').modal('hide');
        });

        function desfazerCheckout(regId) {
            $.ajax({
                type: "POST",
                url: "http://bikeifs.com/app/src/controller/editar/desfazer-checkout.php",
                data: {
                    "id": regId
                },
                success: function(res) {
                    if (res == 'success') {
                        alertSnackBar($("#alertaInvalido"), 'Checkout desfeito!')
                        tabelaRegistros.ajax.reload()
                    }
                }
            })
        }

        // Ação do formulário de Checkin
        $("#formRegistrarEntrada").submit(function(form) {

            form.preventDefault();

            if (!this.checkValidity())
                return;

            var id = $('#modalRegistroManual').find('#selectBike').val();
            var obs = $('#modalRegistroManual').find('#inputObs').val();
            var num_trava = $('#modalRegistroManual').find('#inputNumTrava').val();
            var userId = $('#modalRegistroManual').find('.modal-body').find("#selectUsuario").val();

            inserirRegistro(id, obs, num_trava, userId);

            $('#modalRegistroManual').modal('hide');

        });

        function realizarRegistroAutomatico() {
            var id = $('#modalRegistroAutomatico').find('#bikeId').val();
            var obs = $('#modalRegistroAutomatico').find('#inputObs').val();
            var num_trava = $('#modalRegistroAutomatico').find('#inputNumTrava').val();
            var userId = $('#modalRegistroAutomatico').find("#idUsuario").val();

            inserirRegistro(id, obs, num_trava, userId);

            $('#modalRegistroAutomatico').modal('hide');
        }

        function inserirRegistro(id, obs, num_trava, userId) {
            $.ajax({
                type: "POST",
                url: 'http://bikeifs.com/app/src/controller/inserir/registro.php',
                data: {
                    "id_bicicleta": id,
                    "obs": obs,
                    'num_trava': num_trava
                },
                success: function(reg) {
                    if (reg === 'Acesso negado.')
                        $("#modalAcessoNegado").modal('show');
                    else if (reg === 'Registros em aberto.')
                        $("#modalRegistrosEmAberto").modal('show');
                    else if (reg === 'error_1') {
                        $("#modalBikeInativa").find("#linkPerfil").attr('href', '?pagina=perfil_usuario&user=' + userId)
                        $("#modalBikeInativa").modal('show');
                    } else if (reg === 'error_2') {
                        $("#modalUsuarioInativo").find("#linkPerfil").attr('href', '?pagina=perfil_usuario&user=' + userId)
                        $("#modalUsuarioInativo").modal('show');
                    } else {
                        alertSnackBar($("#alertaSucesso"), 'Checkin realizado com sucesso!')
                        tabelaRegistros.ajax.reload();
                    }

                }
            });
        }

        function popularTabelaRegistros(dia) {
            tabelaRegistros = $('#tableRegistros').DataTable({
                "fixedHeader": {
                    footer: true
                },
                "order": [
                    [1, "desc"]
                ],
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
                        "targets": -2 // Coluna referente ao nome do funcionário (saída).
                    },
                    {
                        "width": "15%",
                        "targets": 2
                    }, // Garante que a coluna dsas obs terá um tamanho adequado
                    {
                        "width": "8%",
                        "targets": 5
                    }, // Garante que a coluna da cor terá um tamanho adequado
                ],
                "language": {
                    "url": "http://bikeifs.com/public/lib/scripts/Portuguese.json"
                },
                ajax: {
                    type: "POST",
                    url: "http://bikeifs.com/app/src/controller/carregar/registrosPorDia.php",
                    data: {
                        dia
                    }
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
                    {
                        "render": function(data, type, row) {
                            if (row.saidas.hora == 'Pendente')
                                return botaoRealizarCheckout;
                            return botaoCheckoutRealizado;
                        }
                    }
                ]
            });
        }

        function recuperarInformacoesDaLinha(button) {
            var linha = $(button).parents('tr');
            if (linha.hasClass('child')) { // Verifica se o botão está dentro de uma div expansível (para telas pequenas)
                linha = linha.prev(); // Caso esteja, aponta para a linha anterior (a linha mãe)
            }
            var data = tabelaRegistros.row(linha).data();
            return data;
        }


        function configurarModalCadastroRegistro() {
            $('#modalRegistroManual').on('shown.bs.modal', preencherSelectUsuario());

            $("#modalRegistroManual").on('hide.bs.modal', function() {
                $(this).find('form').trigger('reset')
                $(this).find('#selectedBikeColor').css('background', '')
            })

            $("#modalRegistroAutomatico").on('hide.bs.modal', function() {
                $(this).find('#inputObs').val('')
                $(this).find('#inputNumTrava').val('0')
            })
        }

        // Selecionar usuário e bicicleta no modal de cadastro de registros
        function configurarSelectBicicleta() {

            // Atualizar select bicicleta ao escolher um usuário
            $('#modalRegistroManual').find('#selectUsuario').on('change', function() {
                var usuarioID = $(this).val();
                if (usuarioID) {
                    $.ajax({
                        type: 'POST',
                        url: window.origin + '/app/src/controller/gerar-opcoes-select-de-bikes-por-usuario.php',
                        data: 'id_usuario=' + usuarioID,
                        success: function(html) {
                            $('#selectBike').html(html);
                        }
                    });
                } else {
                    $('#modalRegistroManual').find('#selectBike').html('<option value="">Primeiramente, selecione um usuário.</option>');
                }
            });


            // Altera a cor do select de acordo com a bicicleta selecionada
            $('#modalRegistroManual').find('#selectBike').on('change', function() {
                var coresBike = $('#modalRegistroManual').find('#selectBike option:selected').data('color');
                atualizarArrayCores(coresBike);
                pintarDivCores($('#modalRegistroManual').find('#selectedBikeColor'));
            });
        }

        // Pesquisar os registros de acordo com a data escolhida
        function configurarSelectData() {
            let hoje = new Date().toISOString().substr(0, 10)
            $('#selectData').val(hoje)
            $('#selectData').change(function() {
                var dia = ($(this).val().length == 0 ? "<?php echo date('Y-m-d') ?>" : $(this).val());
                tabelaRegistros.destroy();
                popularTabelaRegistros(dia)
            })
        }

        function configurarRegistroAutomatico() {
            $('#inputUID').on('UidDetectado', function() {
                pesquisarBikePorUID($('#inputUID').html());
            });
        }

        // Evento de teclado para novos registros
        function adicionarEventoRegistro() {
            $(document).keyup(function(e) {
                if (e.which == 113 || e.keyCode == 113) { // 113 = Tecla F2
                    $('#modalRegistroManual').modal('show');
                }
            })
        }

        // Função chamada pelo botão de pesquisa de usuários
        // Chamar este método em conjunto com o evento de abertura do modal
        // melhora a experiência de visualização da troca de modais.
        // Esconder o modal de registros após abrir o modal de pesquisa não
        // fica bonito de se ver. Dessa forma ficou mais agradável.
        function esconderModalRegistro() {
            $('#modalRegistroManual').modal('hide');
        }
    </script>