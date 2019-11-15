<h4>Perfil de funcionario</h4>
<hr class="bg-dark">
<div class="jumbotron jumbotron-cadastro pt-3 pl-2">
    <div class="col-md-12">
        <div class="row perfil">
            <div class="col-lg-3 col-md-5">
                <div class="perfil-sidebar">
                    <div class="perfil-foto foto-upload">
                        <label for="upload_foto">
                            <img width="128px" id="foto_perfil" src="<?= $funcionario->foto_url ?>" title="Alterar foto de perfil" class="img-responsive" alt="Funcionário">
                        </label>
                        <input id="upload_foto" accept="image/*" type="file" />
                        <input type="hidden" id="foto_path" name="foto_url">
                        <span id="erro_upload" class="invalid-feedback"></span>
                    </div>
                    <div class="perfil-titulo">
                        <div id="perfil-nome" class="perfil-titulo-nome">
                            <?= $funcionario->nome ?>
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
                                <button id="btn-registros">
                                    <i class="material-icons mr-3">query_builder</i>
                                    <span>Registros feitos por mim</span>
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
                            <span id="spanNome" class="form-control"><?= $funcionario->nome ?></span>
                        </div>
                        <div class="col-6 col-md-2">
                            <button onclick="atualizarNome('<?= $funcionario->id ?>', $('#spanNome').html())" class="btn btn-primary" type="button">Editar</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Email</label>
                        <div class="col-6">
                            <span id="spanEmail" class="form-control"><?= $funcionario->email ?></span>
                        </div>
                        <div class="col-6 col-md-2">
                            <button onclick="atualizarEmail($('#spanEmail').html())" class="btn btn-primary" type="button">Editar</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Telefone</label>
                        <div class="col-6">
                            <span id="spanTelefone" class="form-control"><?= $funcionario->telefone ?></span>
                        </div>
                        <div class="col-6 col-md-2">
                            <button onclick="atualizarTelefone('<?= $funcionario->id ?>', $('#spanTelefone').html())" class="btn btn-primary" type="button">Editar</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cpf" class="col-md-4 col-form-label">CPF</label>
                        <div class="col-md-8">
                            <span class="form-control"><?= $funcionario->cpf ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-sm-2 ml-auto mr-5">
                            <button onclick="alterarSenha()" class="btn btn-warning" type="button">Alterar Senha</button>
                        </div>
                    </div>
                </div>
                <div id="registros" class="hidden">
                    <div class="table-responsive">
                        <table class="table table-sm responsive table-striped table-hover table-datepicker" id="tableRegistros" style="width: 100%;">
                            <caption style="caption-side: top;">
                                <div class="div-datepicker"></div>
                            </caption>
                            <thead class="bg-default-primary">
                                <tr>
                                    <th></th>
                                    <th class="all">Hora entrada</th>
                                    <th class="desktop">Obs entrada</th>
                                    <th class="none">Nº trava:</th>
                                    <th class="all">Bicicleta</th>
                                    <th class="min-tablet">Usuário</th>
                                    <th class="none">Hora saída:</th>
                                    <th class="none">Obs saída:</th>
                                    <th class="none">Funcionário saída:</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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