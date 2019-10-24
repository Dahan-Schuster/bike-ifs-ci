<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario') { ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>Lista de tags RFID</h1>
            </span>
            <div class="col-md-3"></div>
            <a class="col-11 col-md-3 btn btn-success mu-0 mb-3 mx-auto" href="?pagina=listagem" role="button">
                Voltar para o menu de listagem
            </a>
        </div>
        <hr class="my-3">
        <div class="table-responsive">
            <table class="table table-sm responsive bg-light table-bordered table-striped table-hover" id="tableTags" style="width: 100%;">
                <caption>Lista de tags RFID</caption>
                <thead class="table-h">
                    <tr>
                        <th>&#9432;</th>
                        <th>Codigo</th>
                        <th>Bike</th>
                        <th class="desktop">Modelo</th>
                        <th>Marca</th>
                        <th>Aro</th>
                        <th>Situação Bicicleta</th>
                        <th>Dono</th>
                        <th class="desktop">Apagar</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot class="table-f">
                    <tr>
                        <th>&#9432;</th>
                        <th>Codigo</th>
                        <th>Bike</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Aro</th>
                        <th>Situação Bicicleta</th>
                        <th>Dono</th>
                        <th>Apagar</th>
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
<!-- Modal excluir -->
<div id="modalExcluir" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h3 class="modal-title">Remover etiqueta</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 class="mt-0">Está certo de que deseja apagar esta etiqueta?</h4>
                <h5>Você estará removendo-a do sistema, possibilitando um futuro recadastramento da mesma com outras informações.</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning" id="tag" onclick="confirmarExclusao(this);">Sim</button>
            </div>
        </div>
    </div>
</div>
<!-- Fim modal excluir -->
<!---------------------------->
<script language="JavaScript" src="<?= base_url() ?>/public/js/escolher.cores.slim.js"></script>
<script type="text/javascript">
    var tabela;
    var botaoExcluir = `<a onclick="excluir(this);" class="link btn btn-danger excluir">
                            <img src="<?= base_url() ?>/public/img/icons/delete.png" title="Excluir bicicleta" alt="Excluir">
                        </a>`;

    $(document).ready(function() {
        popularTabela();
        setInterval(function() {
            tabela.ajax.reload();
        }, 120000); // atualiza a tabela a cada 2 minutos

        
    });

    function excluir(button) {
        var data = recuperarInformacoesDaLinha(button);
        var id = data.tags.id;

        $('#modalExcluir').find('.modal-footer').find('#tag').val(id);;
        $('#modalExcluir').modal('show');
    }

    function confirmarExclusao(button) {

        var id = button.value;
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/app/src/controller/excluir/etiqueta.php",
            data: {
                "id": id
            },
            success: function(res) {
                if (res == 'success') {
                    alertSnackBar($("#alertaSucesso"), 'Exclusão realizada com sucesso!')
                    tabela.ajax.reload();
                } else if (res == 'error_1')
                    alertSnackBar($("#alertaInvalido"), 'Ocorreu um erro durante a exclusão. Tente novamente mais tarde.')
            }
        });
        $('#modalExcluir').modal('hide');
    }

    function popularTabela() {
        tabela = $('#tableTags').DataTable({
            "fixedHeader": {
                footer: true
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
                    // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                    // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                    // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                    "render": function(cores, type, row) {
                        atualizarArrayCores(cores);
                        cssBackground = criarCssBackground();
                        
                        let modelo = row.bikes.modelo.toLowerCase()
                        let output = `<div onclick="abrirPainelLateralBike(`+ row.bikes.id +`)" 
                                class="bike-color" style="background: ` + cssBackground + `;">`
                        output += '<img src="<?= base_url() ?>/public/img/icons/bike-' + modelo + '.png" title="Bike" alt=""></div>'
                        return output
                    },
                    "targets": 2 // Coluna referente à cor.
                },
                {
                    // Estiliza a coluna referente à situação do usuário
                    "render": function(situacao) {
                        var badge_class = 'd-none'; // por padrão, esconde a identificação de tipo antes de verificar se é válido

                        if (situacao === 'Ativa')
                            badge_class = 'badge-success';
                        else if (situacao === 'Inativa')
                            badge_class = 'badge-danger';

                        return '<span class="badge ' + badge_class + '"><h6><b>' + situacao + '</b></h6></span>';
                    },
                    "targets": 6
                },
                {
                    // Adiciona um link para o perfil de cada usuário
                    "render": function(nome, type, row) {
                        let output = '<div class="tooltip-w3 tooltip-w3-dotted">' 
                        output += '<span onclick="abrirPerfilLateralUsuario('+row.users.id+')">'+ nome.split(" ")[0]+'</span>'
                        output += '<span class="tooltiptext-w3">'
                        output += 'Clique para ver mais'
                        output += '</span>'
                        return output
                    },
                    "targets": 7 // Coluna referente ao nome.
                },
                {
                    "width": "15%",
                    "targets": 2
                }, // Garante que a coluna da cor terá um tamanho adequado

                // Define a ordem de prioridade de visibilidade de cada coluna
                {
                    responsivePriority: 10001,
                    targets: 7
                },
                {
                    responsivePriority: 10002,
                    targets: 3
                },
            ],
            "language": {
                "url": "<?= base_url() ?>/public/js/Portuguese.json"
            },
            'processing': true,
            ajax: {
                type: "POST",
                url: "<?= base_url() ?>/app/src/controller/carregar/etiquetas.php"
            },
            "columns": [{
                    data: "tags.id"
                },
                {
                    data: "tags.codigo"
                },
                {
                    data: "bikes.cores"
                },
                {
                    data: "bikes.modelo"
                },
                {
                    data: "bikes.marca"
                },
                {
                    data: "bikes.aro"
                },
                {
                    data: "bikes.situacao"
                },
                {
                    data: "users.nome"
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