<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/snackbar.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/palette.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>public/css/perfil.css">
</head>

<body style="font-size: 10pt;" id="body-perfil-sidepanel">
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
                                <i class="material-icons mr-3">info</i>
                                <span>Informações</span>
                            </button>
                        </li>
                        <li>
                            <button id="btn-bikes" type="button">
                                <i class="material-icons mr-3">directions_bike</i>
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
                            <span id="telefone"><?= $usuario->perfil_privado == 'f' ? (trim($usuario->telefone) ? $usuario->telefone : 'Não informado') : 'Privado' ?></span>
                        </div>
                    </div>
                    <hr class="my-0 py-0">
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label"><b>Email</b></label>
                        <div class="col-md-8">
                            <span id="email"><?= $usuario->email ?></span>
                        </div>
                    </div>
                    <hr class="my-0 py-0">
                    <div class="form-group row">
                        <label for="cpf" class="col-md-4 col-form-label"><b>CPF</b></label>
                        <div class="col-md-8">
                            <span id="cpf"><?= $usuario->perfil_privado == 'f' ? $usuario->cpf : 'Privado' ?></span>
                        </div>
                    </div>
                    <hr class="my-4 bg-dark">
                    <div class="form-group row">
                        <span class="col-md-4"><b>Tipo de usuário</b></span>
                        <span class="col-md-8" id="tipo"><?= $usuario->nome_tipo ?></span>
                    </div>
                    <div class="form-group">
                        <b>Situacao</b>
                        <input onchange="alterarSituacaoUsuario(id_usuario)" type="checkbox" class="custom-switch hidden" id="situacao" <?= $usuario->ativo ? 'checked' : '' ?>>
                        <label class="custom-switch-label custom-switch-label-right" for="situacao"></label>
                    </div>
                    <hr class="my-4 bg-dark">
                    <a id="linkPerfil">Abrir perfil em uma nova guia &nearhk;</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?= base_url() ?>public/js/popper.min.js"></script>
<script src="<?= base_url() ?>public/js/snackbar.min.js"></script>
<script src="<?= base_url() ?>public/js/bootstrap-material-design.js"></script>
<script src="<?= base_url() ?>public/js/util.js"></script>
<script>
    const id_usuario = <?= $usuario->id ?>;

    $(document).ready(function() {
        
        $("#linkPerfil").attr('href', `${BASE_URL}usuario/${id_usuario}`)
        $("#linkPerfil").attr('target', '_blank')
        
        configurarDivConteudo()
        popularTabelaBicicletasUsuario()
    });

    function configurarDivConteudo() {
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
            type: "GET",
            dataType: 'json',
            url: BASE_URL + `usuario/${id_usuario}/bicicletas`,
            success: function(response) {
                let bikes = response['data'];

                bikes.forEach(bike => {
                    var linha = document.createElement('tr')

                    // Cria a coluna das cores
                    var colunaCores = document.createElement('td')
                    $(colunaCores).css('width', '30%')
                    var divCores = document.createElement('div') // Criando a div das cores
                    $(divCores).addClass('bike-color') // Adicionando a classe bike-color
                    $(divCores).css('background', bike.cores) // Formatando o background da div
                    $(divCores).html(`<img src="${BASE_URL}public/img/icons/bike-${bike.nome_modelo.toLowerCase()}.png">`)
                    $(colunaCores).html(divCores) // Colocando a div das cores na coluna

                    // Cria a coluna do modelo
                    var colunaModelo = document.createElement('td')
                    $(colunaModelo).css('width', '30%')
                    $(colunaModelo).html(bike.nome_modelo) // Preenche a coluna com o modelo da bike

                    // Cria a coluna da situação
                    var colunaSituacao = document.createElement('td')
                    $(colunaSituacao).css('width', '40%')

                    // Definindo se o switch estará ligado ou não
                    var checked = bike.situacao == 'Ativa' ? 'checked' : ''

                    // Criando o html do switch
                    let switchSituacao =
                        `<input onchange="alterarSituacaoBicicleta('${bike.id}','${bike.situacao}')" 
                                type="checkbox" class="custom-switch hidden" id="switchSituacao${bike.id}" ${checked}>
                            <label class="custom-switch-label" for="switchSituacao${bike.id}"></label>`

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

    function alterarSituacaoUsuario(user) {
        var ids_usuarios = [user];
        if (!$("#situacao").is(':checked'))
            enviarAjaxDesativarUsuarios(ids_usuarios)
        else
            enviarAjaxAtivarUsuarios(ids_usuarios)
    }

    function alterarSituacaoBicicleta(bike, situacao) {
        var ids_bicicletas = [bike];
        if (situacao == 'Ativa')
            enviarAjaxDesativarBicicletas(ids_bicicletas)
        else if (situacao == 'Inativa')
            enviarAjaxAtivarBicicletas(ids_bicicletas)
    }
</script>

</html>