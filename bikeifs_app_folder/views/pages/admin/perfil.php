<h4>Perfil de administrador</h4>
<hr class="bg-dark">
<div class="jumbotron jumbotron-cadastro pt-3 pl-2">
    <div class="col-md-12">
        <div class="row perfil">
            <div class="col-lg-3 col-md-5">
                <div class="perfil-sidebar">
                    <div class="perfil-foto">
                        <img src="<?= base_url() ?>/public/img/icons/admin.png" title="Administrador" class="img-responsive" alt="Admin">
                    </div>
                    <div class="perfil-titulo">
                        <div id="perfil-nome" class="perfil-titulo-nome">
                            <?= $admin->nome ?>
                        </div>
                    </div>
                    <div class="perfil-menu">
                        <ul class="nav">
                            <li class="active">
                                <button id="btn-info">
                                    <i class="material-icons mr-3">info</i>
                                    <span>Informações</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7 conteudo-perfil" id="conteudo-perfil">
                <div id="informacoes">
                    <div class="form-group row">
                        <label for="nome" class="col-md-4 col-form-label">Nome</label>
                        <div class="col-6">
                            <span id="spanNome" class="form-control"><?= $admin->nome ?></span>
                        </div>
                        <div class="col-6 col-md-2">
                            <button onclick="atualizarNome('<?= $admin->id ?>', $('#spanNome').html())" class="btn btn-primary" type="button">Editar</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Email</label>
                        <div class="col-6">
                            <span id="spanEmail" class="form-control"><?= $admin->email ?></span>
                        </div>
                        <div class="col-6 col-md-2">
                            <button onclick="atualizarEmail('<?= $admin->id ?>', $('#spanEmail').html())" class="btn btn-primary" type="button">Editar</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cpf" class="col-md-4 col-form-label">CPF</label>
                        <div class="col-md-8">
                            <span class="form-control"><?= $admin->cpf ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-sm-2 ml-auto mr-5">
                            <button onclick="alterarSenha('<?= $admin->id ?>')" class="btn btn-warning" type="button">Alterar Senha</button>
                        </div>
                        <div class="col-12 col-sm-2 mr-5">
                            <button onclick="removerConta('<?= $admin->id ?>')" class="btn btn-danger" type="button">Remover Conta</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>