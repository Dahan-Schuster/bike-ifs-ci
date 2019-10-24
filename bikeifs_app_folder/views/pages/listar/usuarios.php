<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario') { ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>Lista de usuários</h1>
            </span>
            <div class="col-md-3"></div>
            <a class="col-11 col-md-3 btn btn-success mu-0 mb-3 mx-auto" href="?pagina=listagem" role="button">
                Voltar para o menu de listagem
            </a>
        </div>
        <hr class="my-3">
        <div class="table-responsive">
            <table class="table table-sm responsive bg-light table-bordered table-striped table-hover display" id="tableUsuarios" style="width: 100%;">
                <caption>Lista de usuários</caption>
                <thead class="table-h">
                    <tr>
                        <th>&#9432;</th>
                        <th>Nome</th>
                        <th class="none">Telefone</th>
                        <th class="none">Email</th>
                        <th>Tipo</th>
                        <th>CPF</th>
                        <th>Matrícula</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot class="table-f">
                    <tr>
                        <th>&#9432;</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>CPF</th>
                        <th>Matrícula</th>
                        <th>Situação</th>
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
    <div class="alert alert-danger" role="alert">
        É necessário fazer login para acessar esta página.
    </div>
<?php } ?>
<br>
<?php
include_once('../modals/modalTipoVisitante.html');
?>
<script type="text/javascript">
    var tabela;

    $(document).ready(function() {
        popularTabela();
        setInterval(function() {
            tabela.ajax.reload();
        }, 120000); // atualiza a tabela a cada 2 minutos


    });

    function alterarSituacao(user, situacao) {
        if (situacao == 'Ativo')
            desativar(user)
        else if (situacao == 'Inativo')
            ativar(user)
    }

    function ativar(user) {
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/ativar/usuario.php',
            data: {
                user
            },
            success: function(user) {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                tabela.ajax.reload();
            }
        });
    }

    function desativar(user) {
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/desativar/usuario.php',
            data: {
                user
            },
            success: function(user) {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                tabela.ajax.reload();
            }
        });
    }


    function popularTabela() {
        tabela = $('#tableUsuarios').DataTable({
            "fixedHeader": {
                footer: true
            },
            "order": [
                1, "asc"
            ],
            "orderFixed": [4, "asc"],
            rowGroup: {
                startRender: null,
                endRender: function(rows, group) {
                    return group;
                },
                dataSrc: 'tipo'
            },
            "columnDefs": [{
                    // Centraliza o conteúdo das colunas referentes aos botões
                    "className": "dt-center",
                    "targets": '_all'
                },
                {
                    // Remove a opção 'ordenar' das colunas referentes aos botões
                    "orderable": false,
                    "targets": -1
                },
                {
                    // Define um switch para a situação do usuário
                    "render": function(situacao, type, row) {
                        var checked = ''

                        if (situacao == 'Visitante')
                            return situacao;
                        else if (situacao == 'Ativo')
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
                    // Adiciona um link para o perfil de cada usuário
                    "render": function(nome, type, row) {
                        let output = '<div class="tooltip-w3 tooltip-w3-dotted">'
                        output += '<span onclick="abrirPerfilLateralUsuario(' + row.id + ')">' + nome.split(" ")[0] + '</span>'
                        output += '<span class="tooltiptext-w3">'
                        output += 'Clique para ver mais'
                        output += '</span>'
                        return output
                    },
                    "targets": 1 // Coluna referente ao nome.
                },
                // Define a ordem de prioridade de visibilidade de cada coluna
                {
                    responsivePriority: 10001,
                    targets: 6
                },
                {
                    responsivePriority: 10002,
                    targets: 4
                },
                {
                    responsivePriority: 1,
                    targets: 1
                }
            ],
            "language": {
                "url": "<?= base_url() ?>/public/js/Portuguese.json"
            },
            ajax: {
                type: "POST",
                url: "<?= base_url() ?>/app/src/controller/carregar/usuarios.php"
            },
            "processing": true,
            "columns": [{
                    data: "id"
                },
                {
                    data: "nome"
                },
                {
                    data: "telefone"
                },
                {
                    data: "email"
                },
                {
                    data: "tipo"
                },
                {
                    data: "cpf"
                },
                {
                    data: "matricula"
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