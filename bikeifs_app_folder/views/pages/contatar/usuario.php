<h4>Contatar usuário</h4>
<hr class="my-3">
<form id="formEnvioEmail" autocomplete="off">
    <div class="form-row">
        <div id="divInputNome" class="form-group col-6 col-md-4">
            <label class="bmd-label-floating" for="inputNome">Nome</label>
            <input type="text" class="form-control" id="inputNome" placeholder="Primeiro nome do rementente">
            <span class="invalid-feedback"></span>
        </div>
        <div id="divInputSobreome" class="form-group col-6 col-md-4">
            <label class="bmd-label-floating" for="inputSobrenome">Sobrenome</label>
            <input type="text" class="form-control" id="inputSobrenome" placeholder="Último nome do rementente">
            <span class="invalid-feedback"></span>
        </div>
        <div id="divInputAssunto" class="form-group col-12 col-md-4">
            <label class="bmd-label-floating" for="inputAssunto">
                Assunto
            </label>
            <input type="text" class="form-control" id="inputAssunto" placeholder="Assunto do email">
           <span class="invalid-feedback"></span>
        </div>
        <div id="divInputDestinatarios" class="form-group col-12">
            <label for="destinatarios">
                Destinatário(s)
            </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="button" class="btn" data-toggle="modal" data-target="#modalPesquisarUsuario">
                        <i class="material-icons">view_list</i>
                    </button>
                </div>
                <div class="form-control div-destinatarios" id="destinatarios">
                </div>
            </div>
           <span class="invalid-feedback"></span>
        </div>
        <div id="divInputCorpo" class="form-group col-12">
            <label for="inputCorpo">Corpo do email</label>
            <textarea maxlength="255" class="form-control" id="inputCorpo"></textarea>
           <span class="invalid-feedback"></span>
        </div>
    </div>

    <hr class="my-3">
    <button id="btnEnviar" type="submit" class="btn btn-raised btn-primary">Enviar</button>
    <button type="reset" class="btn btn-secondary">Limpar</button>
</form>
<br>
<?php include_once('public/views/modals/modalPesquisarUsuarioEmail.html'); ?>