<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario') { ?>
        <div class="row">
            <span class="col-12 col-md-6">
                <h1>Lista de bicicletas</h1>
            </span>
            <div class="col-md-3"></div>
            <a class="col-11 col-md-3 btn btn-success mu-0 mb-3 mx-auto" href="?pagina=listagem" role="button">
                Voltar para o menu de listagem
            </a>
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
                        <th class="none">Obs</th>
                        <th>Aro</th>
                        <th>Dono</th>
                        <th>Situacao</th>
                        <th>Editar</th>
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
                        <th>Dono</th>
                        <th>Situacao</th>
                        <th>Editar</th>
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
<!-- Modal editar -->
<div id="modalEditar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-info">
                <h3 class="modal-title">Editar bicicleta</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="formEditarBike">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputCor">Cor <span class="text-danger"><b>*</b></span></label>
                        <div class="input-group">
                            <div class="form-control bike-color" id="inputCor"></div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEscolherCor" style="outline: none; box-shadow: none; padding: 0 .75rem;">
                                    <img src="<?= base_url() ?>/public/img/icons/color.png" title="Escolher cor" alt="Escolher cor">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMarca">Marca</label>
                        <input type="text" name="marca" class="form-control" id="inputMarca" placeholder="Selecione uma marca">
                    </div>
                    <div class="form-group">
                        <label for="inputAro">Aro <span class="text-danger"><b>*</b></span></label>
                        <input type="number" name="aro" class="form-control" id="inputAro" placeholder="Tamanho do aro" required>
                        <div class="invalid-feedback">
                            Por favor, informe o tamanho do aro da bicicleta.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputObs">Observações sobre a bicicleta</label>
                        <textarea class="form-control" id="inputObs" name="obs" maxlength="255"></textarea>
                    </div>
                    <input type='hidden' id='idUsuario'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="bike" name="bike">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fim modal editar -->
<!---------------------->

<?php
include_once('../modals/modalEscolherCor.html');
include_once('../modals/modalBikeJaCadastrada.html');
?>
<script language="JavaScript" src="<?= base_url() ?>/public/js/escolher.cores.js"></script>
<script type="text/javascript">
    var tabela;
    var botaoEditar = `<a onclick="editar(this);" class="btn btn-info">
                            <img src="<?= base_url() ?>/public/img/icons/edit.png" title="Editar bicicleta" alt="Editar">
                        </a>`;


    $(document).ready(function() {
        popularTabela();
        setInterval(function() {
            tabela.ajax.reload();
        }, 120000); // atualiza a tabela a cada 2 minutos

        
    });

    // Métodos de controle (edição, ativar/desativar, carregamento da tabela)

    function editar(button) {
        var data = recuperarInformacoesDaBike(button);
        atualizarCamposDoModalEditar(data);
        $('#modalEditar').modal('show');
    }

    $("#formEditarBike").submit(function(form) {
        form.preventDefault();

        if (!this.checkValidity())
            return; // impede que o formulário utilize o botão submit para enviar informações

        var url = '<?= base_url() ?>/app/src/controller/editar/bicicleta.php';

        var dados = recuperarInformacoesDoModalEditar();

        $.ajax({
            type: "POST",
            url: url,
            data: dados,
            success: function(resultado) {
                if (resultado === 'error_1')
                    $("#modalBikeJaCadastrada").modal('show');
                else if (resultado === 'error_2')
                    alertSnackBar($("#alertaInvalido"), 'Ocorreu um erro durante a edição. Por favor, tente novamente.')
                else if (resultado === 'success') {
                    alertSnackBar($("#alertaSucesso"), 'Operação realizada com sucesso')
                    tabela.ajax.reload();
                }
            }
        });

        $('#modalEditar').modal('hide');

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
            url: '<?= base_url() ?>/app/src/controller/ativar/bicicleta.php',
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
            url: '<?= base_url() ?>/app/src/controller/desativar/bicicleta.php',
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
            "fixedHeader": {
                footer: true
            },
            "order": [
                [6, "asc"]
            ],
            "columnDefs": [{
                    // Centraliza o conteúdo das colunas referentes aos botões
                    "className": "dt-center",
                    "targets": '_all'
                },
                {
                    // Remove a opção 'ordenar' das colunas referentes aos botões
                    "orderable": false,
                    "targets": [1, -1, -2]
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
                    "targets": 1 // Coluna referente à cor.
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
                    // Define um switch para a situação da bike
                    "render": function(situacao, type, row) {
                        var checked = ''

                        if (situacao == 'Ativa')
                            checked = 'checked'

                        return `<div class="custom-control custom-switch">
                                    <input onchange="alterarSituacao('` + row.bikes.id + `', '` + situacao + `')" 
                                        type="checkbox" class="custom-control-input" id="switchSituacao` + row.bikes.id + `" ` + checked + `>
                                    
                                    <label class="custom-control-label" for="switchSituacao` + row.bikes.id + `">` + situacao + `</label>
                                </div>`;
                    },
                    "targets": -2 // Coluna referente à situação.
                },
                {
                    "width": "10%",
                    "targets": 1
                }, // Garante que a coluna da cor terá um tamanho adequado

                // Define a ordem de prioridade de visibilidade de cada coluna
                {
                    responsivePriority: 10001,
                    targets: 7
                },
                {
                    responsivePriority: 10002,
                    targets: 8
                },
                {
                    responsivePriority: 10003,
                    targets: 3
                },
                {
                    responsivePriority: 10004,
                    targets: 5
                },
                {
                    responsivePriority: 10005,
                    targets: 4
                },
            ],
            "language": {
                "url": "<?= base_url() ?>/public/js/Portuguese.json"
            },
            ajax: {
                type: "POST",
                url: "<?= base_url() ?>/app/src/controller/carregar/bicicletas.php"
            },
            "processing": true,
            "columns": [{
                    data: "bikes.id"
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
                    data: "bikes.obs"
                },
                {
                    data: "bikes.aro"
                },
                {
                    data: "users.nome"
                },
                {
                    data: "bikes.situacao"
                },
                {
                    "render": function() {
                        return botaoEditar;
                    }
                }
            ]
        });
    }

    // Fim Métodos de controle

    // Métodos chamados por outros métodos

    function recuperarInformacoesDoModalEditar() {
        var id = $('#modalEditar').find('.modal-footer').find('#bike').val();
        var cores = stringArrayCores();
        var marca = $('#modalEditar').find('.modal-body').find('#inputMarca').val();
        var obs = $('#modalEditar').find('.modal-body').find('#inputObs').val();
        var aro = $('#modalEditar').find('.modal-body').find('#inputAro').val();
        var id_usuario = $('#modalEditar').find('.modal-body').find('#idUsuario').val();

        var dados = '{ "id" : "' + id + '", "cores" : "' + cores + '", "marca" : "' + marca + '", "obs" : "' + obs + '", "aro" : "' + aro + '", "id_usuario" : "' + id_usuario + '"}';
        return JSON.parse(dados);
    }

    function atualizarCamposDoModalEditar(data) {
        let id = data.id;
        let coresBike = data.cores;
        let marca = data.marca;
        let obs = data.obs;
        let aro = data.aro;
        let id_usuario = data.id_usuario;

        atualizarArrayCores(coresBike);
        pintarDivCores();
        $('#modalEditar').find('.modal-body').find('#inputMarca').val(marca);
        $('#modalEditar').find('.modal-body').find('#inputObs').val(obs);
        $('#modalEditar').find('.modal-body').find('#inputAro').val(aro);
        $('#modalEditar').find('.modal-body').find('#idUsuario').val(id_usuario);

        $('#modalEditar').find('.modal-footer').find('#bike').val(id);
    }

    function recuperarInformacoesDaBike(button) {
        return recuperarInformacoesDaLinha(button).bikes;
    }

    function recuperarInformacoesDaLinha(button) {
        var linha = $(button).parents('tr'); // Recupera a linha do botão na tabela
        if (linha.hasClass('child')) // Verifica se o botão está dentro de uma div expansível (para telas pequenas)
            linha = linha.prev(); // Caso esteja, aponta para a linha anterior (a linha mãe)

        var data = tabela.row(linha).data(); // Recupera os dados da linha
        return data;
    }
</script>