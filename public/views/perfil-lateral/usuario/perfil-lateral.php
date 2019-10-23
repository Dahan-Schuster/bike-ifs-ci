<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://bikeifs.com/public/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://bikeifs.com/public/lib/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="http://bikeifs.com/public/lib/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="http://bikeifs.com/public/lib/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="http://bikeifs.com/public/lib/css/perfil.css">
</head>

<body id="body-perfil-sidepanel">
    <div id="conteudo-perfil-sidepanel" class="container-fluid">
        <div class="perfil">
            <div class="perfil-sidebar pb-3">
                <div class="perfil-foto">
                    <img src="http://bikeifs.com/public/img/icons/cyclist.png" title="Usuário" class="img-responsive" alt="Usuário">
                </div>
                <div class="perfil-titulo">
                    <div id="perfil-nome" class="perfil-titulo-nome">
                    </div>
                    <div id="perfil-tipo" class="perfil-titulo-tipo">
                    </div>
                </div>
                <div class="perfil-menu">
                    <hr class="py-0 my-0">
                    <ul class="nav">
                        <li>
                            <button id="btn-info" type="button">
                                <img src="http://bikeifs.com/public/img/icons/info.png" title="Bicicletas do usuário" alt="Bicicletas">
                                <span>Informações</span>
                            </button>
                        </li>
                        <li>
                            <button id="btn-bikes" type="button">
                                <img src="http://bikeifs.com/public/img/icons/bikes.png" title="Bicicletas do usuário" alt="Bicicletas">
                                <span>Bicicletas</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="conteudo-perfil" id="conteudo-perfil">

            </div>
        </div>
    </div>
    <!-- SnackBars -->
    <div class="snackbar snackbar-invalido" id="alertaInvalido"></div>
    <div class="snackbar snackbar-sucesso" id="alertaSucesso"></div>
    <!-- Fim SnackBars -->
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script language="javascript" src="http://bikeifs.com/public/lib/scripts/ferramentas.js"></script>
<script language="JavaScript" src="http://bikeifs.com/public/lib/scripts/escolher.cores.slim.js"></script>
<script>
    var usuarioCarregado;

    $(document).ready(function() {

        usuarioCarregado = "<?php echo $_GET['user'] ?>";

        configurarDivConteudo()
        pesquisarUsuario();
    });

    function configurarDivConteudo() {
        $("#conteudo-perfil").load('perfil-lateral-info.html')

        $("#btn-info").click(function(e) {
            $("#conteudo-perfil").load('perfil-lateral-info.html')
            pesquisarUsuario()
        })

        $("#btn-bikes").click(function(e) {
            $("#conteudo-perfil").load('perfil-lateral-bikes.html')
            popularTabelaBicicletasUsuario()
        })

    }

    function pesquisarUsuario() {
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/carregar/usuario-por-id.php',
            data: {
                user: usuarioCarregado
            },
            success: function(user) {
                atualizarCamposComDadosDoUsuario(user)
            }
        });
    }

    function popularTabelaBicicletasUsuario() {

        $("#tableBikes tbody").html("") // Limpa a tabela

        $.ajax({
            type: "POST",
            url: "http://bikeifs.com/app/src/controller/carregar/bicicletas-usuario.php",
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
                    $(divCores).html('<img src="http://bikeifs.com/public/img/icons/bike-' + bike.modelo.toLowerCase() + '.png">')
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

    function alterarSituacaoUsuario() {
        if ($("#situacao").html() == 'Ativo')
            desativarUsuario()
        else if ($("#situacao").html() == 'Inativo')
            ativarUsuario()
    }

    function ativarUsuario() {
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/ativar/usuario.php',
            data: {
                "user": usuarioCarregado
            },
            success: function(user) {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                atualizarCamposComDadosDoUsuario(user)
            }
        });
    }

    function desativarUsuario() {
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/desativar/usuario.php',
            data: {
                "user": usuarioCarregado
            },
            success: function(user) {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                atualizarCamposComDadosDoUsuario(user)
            }
        });
    }

    function alterarSituacaoBike(bike, situacao) {
        if (situacao == 'Ativa')
            desativarBike(bike)
        else if (situacao == 'Inativa')
            ativarBike(bike)
    }

    function ativarBike(bike) {
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/ativar/bicicleta.php',
            data: {
                bike
            },
            success: function(res) {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                popularTabelaBicicletasUsuario();
            }
        });

    }

    function desativarBike(bike) {
        $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/desativar/bicicleta.php',
            data: {
                bike
            },
            success: function() {
                alertSnackBar($("#alertaSucesso"), 'Alterado com sucesso!<br>Aguarde a atualização da tabela.')
                popularTabelaBicicletasUsuario()
            }
        });

    }

    function atualizarCamposComDadosDoUsuario(user) {
        $("#perfil-nome").html(user.nome.split(" ")[0]);
        $("#perfil-tipo").html(user.tipo);
        $("#nome").html(user.nome);
        $("#telefone").html(user.telefone);
        $("#email").html(user.email);
        $("#tipo").html(user.tipo);
        $("#situacao").html(user.situacao);
        if (user.situacao == 'Ativo')
            $("#switchSituacao").attr('checked', 'true')
        else if (user.situacao == 'Visitante')
            $("#switchSituacao").attr('disabled', 'disabled')
    }

    function abrirPaginaPerfil() {
        let url = parent.location.origin + parent.location.pathname + '?pagina=perfil_usuario&user=<?php echo $_GET['user'] ?>'
        open(url)
    }
</script>

</html>