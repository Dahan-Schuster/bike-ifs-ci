<a class="col-11 col-md-3 btn btn-success mu-0 mb-3 mx-auto" href="?pagina=login" role="button">
    Voltar para a tela de login
</a>
<div class="jumbotron jumbotron-fluid jumbotron-main">
    <div class="container">
        <div class="row">
            <h1 class="col-12 text-light">Esqueci a senha</h1>
        </div>
        <hr class="my-4 bg-light">
        <div class="row">
            <div class="col">
                <div>
                    <div class="dropdown-menu dropdown-menu-center text-light">
                        <div class="row mb-2 mx-1">
                            <h4 class="mb-0 text-light col-12">
                                Informe seu email
                            </h4>
                        </div>
                        <hr class="my-0 text-light bg-light">
                        <form class="px-4 py-3" autocomplete="off" id="formEsqueciSenha">
                            <div class="form-row">
                                <div class="input-group col mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <img src="<?=base_url()?>/public/img/icons/arroba.png" title="Email" alt="">
                                        </div>
                                    </div>
                                    <input id="inpEmail" class="form-control" type="text" name="email" placeholder="exemplo@email.com" autofocus>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <div class="custom-control custom-radio form-check-inline ">
                                        <input class="custom-control-input" type="radio" name="tipoAcesso" id="radioFuncionario" value="funcionario" checked>
                                        <label class="custom-control-label" for="radioFuncionario">
                                            Funcionário
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-radio form-check-inline ">
                                        <input class="custom-control-input" type="radio" name="tipoAcesso" id="radioUsuario" value="usuario">
                                        <label class="custom-control-label" for="radioUsuario">
                                            Usuário
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="custom-control custom-radio form-check-inline ">
                                        <input class="custom-control-input" type="radio" name="tipoAcesso" id="radioAdmin" value="admin">
                                        <label class="custom-control-label" for="radioAdmin">
                                            Administrador
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input id="btnSubmit" type="submit" value="Enviar" class="btn btn-success" style="width: 100%;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once('<?=base_url()?>/public/view/modals/modalSucessoEsqueciSenha.html');
include_once('<?=base_url()?>/public/view/modals/modalEmailInexistente.html');
?>
<script language="javascript">
    $("#formEsqueciSenha").submit(function(form) {
        form.preventDefault();

        let email = $("#inpEmail").val();
        let tipoAcesso = $("input[name=tipoAcesso]:checked").val();

        $("#btnSubmit").attr('disabled', 'true')
        $("#btnSubmit").css('cursor', 'not-allowed')

        $.ajax({
            type: 'post',
            url: '<?=base_url()?>/app/src/controller/phpmailer/esqueci-senha.php',
            data: {
                email,
                tipoAcesso
            },
            success: function(resultado) {
                console.log(resultado)
                if (resultado === 'error_1')
                    $("#modalEmailInexistente").modal('show');
                else if (resultado === 'success') {
                    $("#modalSucessoEsqueciSenha").modal('show');
                }
            },
            complete: function() {
                $("#btnSubmit").removeAttr('disabled')
                $("#btnSubmit").css('cursor', 'pointer')
            }
        })
    })
</script>