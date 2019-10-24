<?php @session_start(); ?>
<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modalDesativar">
    Desativar
</button>

<!-- Modal -->
<div id="modalDesativar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header alert alert-danger" >
                <h3 class="modal-title">Desativar conta</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="desativarConta">
                <div class="modal-body">
                    <h4 class="mt-0">Está certo de que deseja excluir sua conta?</h4>
                </div>
                <hr>
                <div class="form-group row px-3">
                    <label for="inputSenha" class="col-md-4 col-form-label">Senha</label>
                    <div class="col-md-8">
                       <input type="password" class="form-control" id="inputSenha" autofocus>
                    </div>
                    <div id="aviso-senha" class="invalid-feedback col-md-10">
                        Senha incorreta.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Sim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){    
        
    })

    $("#desativarConta").submit(function(form) {

        form.preventDefault(); // impede que o formulário utilize o botão submit para enviar informações
        
        // Dá início às validações, cuja primeira função (validarSenhaAtual) é assíncrona e, 
        // por isso, deve ser responsável por chamar as demais funções após seu término
        validarSenha(); 
    });

    function validarSenha() {
        // Função assincrona que dará continuidade às validações após o término
        var senhaInserida = $("#modalDesativar").find('#inputSenha').val();
        $.ajax({
                type: "POST",
                url: '<?= base_url() ?>/app/src/controller/verificar/senha-admin.php',
                data: {"adm": "<?php echo $_SESSION['id'] ?>", "senha": senhaInserida},
                
                // Após o término da função assíncrona, as funções necessárias são chamadas
                success: function(resultado) 
                {
                    if (resultado === true) {
                        enviarFormulario();
                        resetModal();
                    } else {
                        $("#aviso-senha").css('display', 'inline-block');
                        $("#inputSenha").focus();
                    }
                }
        });
    }

    function enviarFormulario(senha){

        var url = '<?= base_url() ?>/app/src/controller/excluir/admin.php';

        $.ajax({
            type: "POST",
            url,
            data: {"id": "<?php echo $_SESSION['id'] ?>"},
            success: function() { 
                alert('Sua conta foi desativada com sucesso! Você será redirecionado para a página de login.');
                window.location.replace('<?= base_url() ?>/app/src/controller/logout.php');
            }
        });
    }

    function resetModal() {
        var modal = $("#modalDesativar");
        modal.find('#aviso-senha').css('display', 'none');
        modal.find("#inputSenha").val('');

    }


</script>