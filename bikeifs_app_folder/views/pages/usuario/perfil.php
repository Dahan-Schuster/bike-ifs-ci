<?php require_once APPPATH . 'models/TipoUsuario.php'; ?>
<h4>Perfil de usuário</h4>
<hr class="bg-dark">
<div class="jumbotron jumbotron-cadastro pt-3 pl-2">
    <div class="col-md-12">
        <div class="row perfil">
            <div class="col-lg-3 col-md-5">
                <div class="perfil-sidebar">
                    <div class="perfil-foto foto-upload">
                        <label for="upload_foto">
                            <img id="foto_perfil" src="<?= $usuario->foto_url ?>" title="Alterar foto de perfil" class="img-responsive img-thumbnail" alt="Usuário">
                        </label>
                        <input id="upload_foto" accept="image/*" type="file" />
                        <input type="hidden" id="foto_path" name="foto_url">
                        <span id="erro_upload" class="invalid-feedback"></span>
                    </div>
                    <div class="perfil-titulo">
                        <div id="perfil-nome" class="perfil-titulo-nome">
                            <?= $usuario->nome ?>
                        </div>
                        <div class="perfil-titulo-tipo">
                            <?= TipoUsuario::getNomeTipo($usuario->tipo) ?>
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
                            <li>
                                <button id="btn-medalhas">
                                    <i class="material-icons mr-3">grade</i>
                                    <span>Minhas medalhas</span>
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
                            <span id="spanNome" class="form-control"><?= $usuario->nome ?></span>
                        </div>
                        <div class="col-6 col-md-2">
                            <button onclick="atualizarNome('<?= $usuario->id ?>', $('#spanNome').html())" class="btn btn-primary" type="button">Editar</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Email</label>
                        <div class="col-6">
                            <span id="spanEmail" class="form-control"><?= $usuario->email ?></span>
                        </div>
                        <div class="col-6 col-md-2">
                            <button onclick="atualizarEmail($('#spanEmail').html())" class="btn btn-primary" type="button">Editar</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Telefone</label>
                        <div class="col-6">
                            <span id="spanTelefone" class="form-control"><?= (trim($usuario->telefone) ? $usuario->telefone : 'Não informado') ?></span>
                        </div>
                        <div class="col-6 col-md-2">
                            <button onclick="atualizarTelefone('<?= $usuario->id ?>', $('#spanTelefone').html())" class="btn btn-primary" type="button">Editar</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cpf" class="col-md-4 col-form-label">CPF</label>
                        <div class="col-md-8">
                            <span class="form-control"><?= $usuario->cpf ?></span>
                        </div>
                    </div>
                    <?php if ($usuario->tipo != TipoUsuario::VISITANTE) : ?>
                        <div class="form-group row">
                            <label for="matricula" class="col-md-4 col-form-label">Matrícula</label>
                            <div class="col-md-8">
                                <span class="form-control"><?= (trim($usuario->matricula) ? $usuario->matricula : 'Não informada') ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-sm-2 ml-auto">
                            <button onclick="alterarPrivacidade()" class="btn btn-primary" type="button">Privacidade</button>
                        </div>
                        <div class="col-12 col-sm-2 mr-5">
                            <button onclick="alterarSenha()" class="btn btn-warning" type="button">Alterar Senha</button>
                        </div>
                    </div>
                </div>
                <div id="medalhas" class="hidden">
                    Minhas medalhas
                </div>
            </div>
        </div>
    </div>
</div>
<br>