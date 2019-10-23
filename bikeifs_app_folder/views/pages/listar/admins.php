<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin') { ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>Lista de administradores</h1>
            </span>
            <div class="col-md-3"></div>
            <a class="col-11 col-md-3 btn btn-success mu-0 mb-3 mx-auto" href="?pagina=listagem" role="button">
                Voltar para o menu de listagem
            </a>
        </div>
        <hr class="my-3">
        <div class="table-responsive">
            <table class="table table-sm responsive bg-light table-bordered table-striped table-hover" id="tableAdmins" style="width: 100%;">
                <caption>
                    Lista de administradores
                </caption>
                <thead class="table-h">
                    <tr>
                        <th>&#9432;</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Documento</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot class="table-f">
                    <tr>
                        <th>&#9432;</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Documento</th>
                        <th>Excluir</th>
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
<!-- Modal excluir -->
<div id="modalExcluir" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h3 class="modal-title">Remover administrador</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 class="mt-0">Está certo de que deseja excluir este administrador?</h4>
                <hr>
                <p class="lead">Note que um email será enviado para o email do administrador excluído, notificando sua exclusão.</p>
            </div>
            <hr>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning" id="adm" onclick="excluir(this);">Sim</button>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal excluir -->
<!---------------------------->
<script type="text/javascript">
    var tabela;
    var botaoExcluir = `<a onclick="confirmarExclusao(this);" class="link btn btn-danger excluir">
                                <img src="http://bikeifs.com/public/img/icons/delete-person-24.png" title="Excluir Conta" alt="Excluir">
                            </a>`;

    $(document).ready(function() {
        popularTabela();
        setInterval(function() {
            tabela.ajax.reload();
        }, 120000); // atualiza a tabela a cada 2 minutos

        
    });

    function confirmarExclusao(button) {
        var data = recuperarInformacoesDaLinha(button);
        var id = data.id;

        $('#modalExcluir').find('.modal-footer').find('#adm').val(id);;
        $('#modalExcluir').modal('show');
    }

    function excluir(button) {
        $('#modalExcluir').modal('hide');

        var id = button.value;
        ajaxExclusao(id);
    }


    function popularTabela() {
        tabela = $('#tableAdmins').DataTable({
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
                // Define a ordem de prioridade de visibilidade de cada coluna
                // A coluna de email será a primeira a ser escondida caso o
                // tamanho da tela não seja suficiente
                {
                    responsivePriority: 10001,
                    targets: 2
                },
            ],
            "language": {
                "url": "http://bikeifs.com/public/lib/scripts/Portuguese.json"
            },
            ajax: {
                type: "POST",
                url: "http://bikeifs.com/app/src/controller/carregar/admins.php"
            },
            "processing": true,
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
                    data: "documento"
                },
                {
                    "render": function() {
                        return botaoExcluir;
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
        var data = tabela.row(linha).data();
        return data;
    }
</script>