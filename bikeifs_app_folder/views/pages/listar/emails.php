<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin') { ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>Emails enviados</h1>
            </span>
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
                <table class="table table-sm responsive bg-light table-bordered table-striped table-hover" id="tableEmails" style="width: 100%;">
                    <caption>Lista de emails enviados aos usuários</caption>
                    <thead class="table-h">
                        <tr>
                            <th>&#9432;</th>
                            <th>Hora</th>
                            <th>Remetente</th>
                            <th>Usuário</th>
                            <th>Assunto</th>
                            <th class="none">Corpo</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot class="table-f">
                        <tr>
                            <th>&#9432;</th>
                            <th>Hora</th>
                            <th>Remetente</th>
                            <th>Usuário</th>
                            <th>Assunto</th>
                            <th>Corpo</th>
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

    <script type="text/javascript">
        var tabelaEmails;

        $(document).ready(function() {
            let hoje = "<?php echo date('Y-m-d'); ?>"
            popularTabelaEmails(hoje);
            configurarSelectData()
        });


        function popularTabelaEmails(dia) {
            tabelaEmails = $('#tableEmails').DataTable({
                "fixedHeader": {
                    footer: true
                },
                "order": [
                    [0, "desc"]
                ],
                "columnDefs": [{
                        // Centraliza o conteúdo das colunas
                        "className": "dt-center",
                        "targets": '_all'
                    },
                    {
                        // Remove a opção 'ordenar' das colunas referentes aos botões
                        "orderable": false,
                        "targets": [5, -1]
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
                        "targets": 3 // Coluna referente ao nome.
                    },
                    {
                        // Adiciona um link para o perfil de cada funcionário
                        "render": function(remetente, type, row) {
                            let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                            output += '<span onclick="abrirPerfilLateralFuncionario(' + row.funcionarios.id + ')">'
                            output += remetente + ' (' + row.funcionarios.nome.split(" ")[0] + ')</span>'
                            output += '<span class="tooltiptext-w3">'
                            output += 'Clique para ver mais'
                            output += '</span>'
                            return output
                        },
                        "targets": 2 // Coluna referente ao nome do funcionário
                    }
                ],
                // Configura o comportamento do botão '+' (mais informações)
                // O padrão, caso nenhuma cofiguração seja feita, é expandir a linha para baixo
                // Esta configuração abre um modal ao invés disso
                "responsive": {
                    details: {
                        // Abre um modal com as informações da linha
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(linha) {
                                var info = linha.data();
                                return 'Email nº ' + info.emails.id
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                "language": {
                    "url": "http://bikeifs.com/public/lib/scripts/Portuguese.json"
                },
                ajax: {
                    type: "POST",
                    url: "http://bikeifs.com/app/src/controller/carregar/emails.php",
                    data: {
                        dia
                    }
                },
                'processing': true,
                "columns": [{
                        data: "emails.id"
                    },
                    {
                        data: "emails.hora"
                    },
                    {
                        data: "emails.remetente"
                    },
                    {
                        data: "users.nome"
                    },
                    {
                        data: "emails.assunto"
                    },
                    {
                        data: "emails.corpo"
                    }
                ]
            });
        }

        function recuperarInformacoesDaLinha(button) {
            var linha = $(button).parents('tr');
            if (linha.hasClass('child')) { // Verifica se o botão está dentro de uma div expansível (para telas pequenas)
                linha = linha.prev(); // Caso esteja, aponta para a linha anterior (a linha mãe)
            }
            var data = tabelaEmails.row(linha).data();
            return data;
        }

        // Pesquisar os emails de acordo com a data escolhida
        function configurarSelectData() {
            let hoje = new Date().toISOString().substr(0, 10)
            $('#selectData').val(hoje)
            $('#selectData').change(function() {
                // Verifica se há uma data selecionada no input. Se não houver, pede ao server a data atual
                var dia = ($(this).val().length == 0 ? "<?php echo date('Y-m-d') ?>" : $(this).val());
                tabelaEmails.destroy();
                popularTabelaEmails(dia)
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