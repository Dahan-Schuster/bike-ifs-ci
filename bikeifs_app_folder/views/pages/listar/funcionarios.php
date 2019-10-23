<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin') { ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>Lista de funcionários</h1>
            </span>
            <div class="col-md-3"></div>
            <a class="col-11 col-md-3 btn btn-success mu-0 mb-3 mx-auto" href="?pagina=listagem" role="button">
                Voltar para o menu de listagem
            </a>
        </div>
        <hr class="my-3">
        <div class="table-responsive">
            <table class="table table-sm responsive bg-light table-bordered table-striped table-hover" id="tableFuncionarios" style="width: 100%;">
                <caption>Lista de funcionários</caption>
                <thead class="table-h">
                    <tr>
                        <th>&#9432;</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Situacao</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot class="table-f">
                    <tr>
                        <th>&#9432;</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Situacao</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <br>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Você não tem permissão para acessar esta página.
        </div>
    <?php }
    } else { ?>
    <div class="alert alert-warning" role="alert">
        É necessário fazer login para acessar esta página.
    </div>
<?php } ?>
<script type="text/javascript">
    var tabela;

    $(document).ready(function() {
        popularTabela();
        setInterval(function() {
            tabela.ajax.reload();
        }, 120000); // atualiza a tabela a cada 2 minutos

        
    });

    function alterarSituacao(fun, situacao) {
        if (situacao == 'Ativo')
            desativar(fun)
        else if (situacao == 'Inativo')
            ativar(fun)
    }

    function ativar(fun) {
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/ativar/funcionario.php',
            data: {
                fun
            },
            success: function(res) {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                tabela.ajax.reload();
            }
        });

    }

    function desativar(fun) {
        alert('Aguarde enquanto um email é enviado para o funcionário notificando sua desativação.')
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/desativar/funcionario.php',
            data: {
                fun
            },
            success: function() {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
            },
            complete: function() {
                tabela.ajax.reload();
            }
        });

    }

    function popularTabela() {
        tabela = $('#tableFuncionarios').DataTable({
            "fixedHeader": {
                footer: true
            },
            "order": [
                [1, "asc"]
            ],
            "columnDefs": [{
                    "className": "dt-center",
                    "targets": '_all'
                },
                {
                    "orderable": false,
                    "targets": -1
                },
                {
                    // Define um switch para a situação do funcionario
                    "render": function(situacao, type, row) {
                        var checked = ''

                        if (situacao == 'Ativo')
                            checked = 'checked'

                        return `<div class="custom-control custom-switch">
                                    <input onchange="alterarSituacao('` + row.id + `', '` + situacao + `')" 
                                        type="checkbox" class="custom-control-input" id="switchSituacao` + row.id + `" ` + checked + `>
                                    
                                    <label class="custom-control-label" for="switchSituacao` + row.id + `">` + situacao + `</label>
                                </div>`;
                    },
                    "targets": -1 // Coluna referente à situação.
                },
                {
                    // Adiciona um link para o perfil de cada funcionário
                    "render": function(nome, type, row) {
                        let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                        output += '<span onclick="abrirPerfilLateralFuncionario(' + row.id + ')">' + nome.split(" ")[0] + '</span>'
                        output += '<span class="tooltiptext-w3">'
                        output += 'Clique para ver mais'
                        output += '</span>'
                        return output
                    },
                    "targets": 1 // Coluna referente ao nome.
                },
                // Define a ordem de prioridade de visibilidade de cada coluna
                // As colunas de nome e do botão de exclusão são as que possuem maior
                // prioridade quando o tamanho da tela não é suficiente
                {
                    responsivePriority: 1,
                    targets: 1
                },
                {
                    responsivePriority: 2,
                    targets: 5
                },
            ],
            "language": {
                "url": "http://bikeifs.com/public/lib/scripts/Portuguese.json"
            },
            ajax: {
                type: "POST",
                url: "http://bikeifs.com/app/src/controller/carregar/funcionarios.php"
            },
            'processing': true,
            "columns": [{
                    data: "id"
                },
                {
                    data: "nome"
                },
                {
                    data: "email"
                },
                {
                    data: "telefone"
                },
                {
                    data: "cpf"
                },
                {
                    data: "situacao"
                }
            ]
        });
    }

    function recuperarInformacoesDaLinha(button) {
        var linha = $(button).parents('tr');
        if (linha.hasClass('child')) { // Verifica se o botão está dentro de uma div expansível (para telas pequenas)
            linha = linha.prev(); // Caso esteja, aponta para a linha anterior (a linha mãe)
        }
        var data = tabela.row(linha).data();
        return data;
    }
</script>