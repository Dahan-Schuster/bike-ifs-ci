<div class="form-group row">
    <label for="nome" class="col-md-4 col-form-label"><b>Nome</b></label>
    <div class="col-md-8">
        <span id="nome" name="nome"></span>
    </div>
</div>
<hr class="my-0 py-0">
<div class="form-group row">
    <label for="telefone" class="col-md-4 col-form-label"><b>Telefone</b></label>
    <div class="col-md-8">
        <span id="telefone"></span>
    </div>
</div>
<hr class="my-0 py-0">
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label"><b>Email</b></label>
    <div class="col-md-8">
        <span id="email"></span>
    </div>
</div>
<hr class="my-4 bg-dark">
<div class="form-group row">
    <label for="tipo" class="col-md-4 col-form-label"><b>Tipo de usuário</b></label>
    <div class="col-md-8">
        <span id="tipo"></span>
    </div>
</div>
<div class="form-group row">
    <label for="situacao" class="col-4 col-form-label"><b>Situação</b></label>
    <div class="col-4 pt-2">
        <div class="custom-control custom-switch">
            <input onchange="alterarSituacaoUsuario()" type="checkbox" class="custom-control-input" id="switchSituacao">
            <label id="situacao" class="custom-control-label" for="switchSituacao"></label>
        </div>
    </div>
</div>
<hr class="my-4 bg-dark">
<a href="javascript:void(0)" onclick="abrirPaginaPerfil()">Abrir perfil em uma nova guia &nearhk;</a>