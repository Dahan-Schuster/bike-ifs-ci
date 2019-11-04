<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/lib/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/lib/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/lib/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/lib/css/perfil.css">
</head>

<body id="body-perfil-sidepanel">
    <div id="conteudo-perfil-sidepanel" class="container-fluid">
        <div class="perfil">
            <div class="perfil-sidebar pb-3">
                <div class="perfil-foto">
                    <img src="<?= base_url('public/img/icons/cyclist.png') ?>" title="Usuário" class="img-responsive" alt="Usuário">
                </div>
                <div class="perfil-titulo">
                    <div id="perfil-nome" class="perfil-titulo-nome">
                        <?= $usuario->nome ?>
                    </div>
                    <div id="perfil-tipo" class="perfil-titulo-tipo">
                        <?= $usuario->nome_tipo ?>
                    </div>
                </div>
                <div class="perfil-menu">
                    <hr class="py-0 my-0">
                    <ul class="nav">
                        <li>
                            <button id="btn-info" type="button">
                                <img src="<?= base_url() ?>public/img/icons/info.png" title="Bicicletas do usuário" alt="Bicicletas">
                                <span>Informações</span>
                            </button>
                        </li>
                        <li>
                            <button id="btn-bikes" type="button">
                                <img src="<?= base_url() ?>public/img/icons/bikes.png" title="Bicicletas do usuário" alt="Bicicletas">
                                <span>Bicicletas</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="conteudo-perfil" id="conteudo-perfil">
                <div id="informacoes">
                    <div class="form-group row">
                        <label for="nome" class="col-md-4 col-form-label"><b>Nome</b></label>
                        <div class="col-md-8">
                            <span id="nome" name="nome"><?= $usuario->nome ?></span>
                        </div>
                    </div>
                    <hr class="my-0 py-0">
                    <div class="form-group row">
                        <label for="telefone" class="col-md-4 col-form-label"><b>Telefone</b></label>
                        <div class="col-md-8">
                            <span id="telefone"><?= trim($usuario->telefone) ? $usuario->telefone : 'Não informado' ?></span>
                        </div>
                    </div>
                    <hr class="my-0 py-0">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label"><b>Email</b></label>
                        <div class="col-md-8">
                            <span id="email"><?= $usuario->email ?></span>
                        </div>
                    </div>
                    <hr class="my-4 bg-dark">
                    <div class="form-group row">
                        <label for="tipo" class="col-md-4 col-form-label"><b>Tipo de usuário</b></label>
                        <div class="col-md-8">
                            <span id="tipo"><?= $usuario->nome_tipo ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="custom-switch hidden" id="situacao" <?= $usuario->ativo ? 'checked' : '' ?>>
                        <label class="custom-switch-label custom-switch-label-right" for="situacao"><span><?= $usuario->nome_situacao ?></span></label>
                    </div>
                    <hr class="my-4 bg-dark">
                    <a href="javascript:void(0)" onclick="abrirPaginaPerfil()">Abrir perfil em uma nova guia &nearhk;</a>
                </div>
                <div class="hidden" id="bicicletas">
                    <div class="table-responsive">
                        <table class="table table-sm responsive table-striped table-hover p-0" id="tableBikes" style="width: 100%;">
                            <caption>Lista de bicicletas</caption>
                            <thead class="bg-default-primary">
                                <tr>
                                    <th>Cor</th>
                                    <th>Modelo</th>
                                    <th>Situacao</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            configurarDivConteudo()
            //popularTabelaBicicletasUsuario()
        });

        function configurarDivConteudo() {
            $("#conteudo-perfil").load('perfil-lateral-info.html')

            $("#btn-info").click(function(e) {
                $("#btn-info").addClass('active')
                $("#informacoes").removeClass('hidden')
                $("#btn-bikes").removeClass('active')
                $("#bicicletas").addClass('hidden')
            })

            $("#btn-bikes").click(function(e) {
                $("#btn-bikes").addClass('active')
                $("#bicicletas").removeClass('hidden')
                $("#btn-info").removeClass('active')
                $("#informacoes").addClass('hidden')
            })

        }

        function popularTabelaBicicletasUsuario() {

            $("#tableBikes tbody").html("") // Limpa a tabela

            $.ajax({
                type: "POST",
                url: BASE_URL 'usuario/\/bicicleta/',
                data: {
                    id: usuarioCarregado
                },
                success: function(data) {
                    let bikes = data['data'];

                    bikes.forEach(bike => {
                        var linha = document.createElement('tr')

                        // Cria a coluna das cores
                        var colunaCores = document.createElement('td')
                        $(colunaCores).css('width', '30%')
                        var divCores = document.createElement('div') // Criando a div das cores
                        $(divCores).addClass('bike-color') // Adicionando a classe bike-color
                        atualizarArrayCores(bike.cores); // Criando o css das cores
                        let cssBackground = criarCssBackground();
                        $(divCores).css('background', cssBackground) // Formatando o background da div
                        $(divCores).html(`<img src="${BASE_URL}public/img/icons/bike-${bike.modelo.toLowerCase()}png">`)
                        $(colunaCores).html(divCores) // Colocando a div das cores na coluna

                        // Cria a coluna do modelo
                        var colunaModelo = document.createElement('td')
                        $(colunaModelo).css('width', '30%')
                        $(colunaModelo).html(bike.modelo) // Preenche a coluna com o modelo da bike

                        // Cria a coluna da situação
                        var colunaSituacao = document.createElement('td')
                        $(colunaSituacao).css('width', '40%')

                        // Definindo se o switch estará ligado ou não
                        var checked = ''
                        if (bike.situacao == 'Ativa')
                            checked = 'checked'

                        // Criando o html do switch
                        let switchSituacao = `<div class="custom-control custom-switch">
                        <input onchange="alterarSituacaoBike('` + bike.id + `', '` + bike.situacao + `')" 
                        type="checkbox" class="custom-control-input" id="switchSituacao` + bike.id + `" ` + checked + `>
                        <label class="custom-control-label" for="switchSituacao` + bike.id + `">` + bike.situacao + `</label>
                        </div>`;

                        // Preenchendo a coluna situação com o switch configurado
                        $(colunaSituacao).html(switchSituacao)

                        $(linha).append(colunaCores) // Adicionando a coluna 'cores' à linha da tabela
                        $(linha).append(colunaModelo) // Adicionando a coluna 'modelo' à linha da tabela
                        $(linha).append(colunaSituacao) // Adicionando a coluna 'situação' à linha da tabela

                        $("#tableBikes tbody").append(linha) // Adicionando a linha à tabela
                    });
                }
            })
        }

        function abrirPaginaPerfil() {
            let path = parent.location.pathname.split('/')
            open(`${BASE_URL}usuario/${path[path.length - 1]}`)
        }
    </script>
</footer>

</html>