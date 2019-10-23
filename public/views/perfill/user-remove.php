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
                    <h4 class="mt-0">Está certo de que deseja destivar sua conta?</h4>
                    <hr>
                    <p class="lead">Ela não será removida, apenas desativada, estando impedida de realizar registros de entrada e saída e de fazer login no sistema.</p>
                    <p class="lead">Algums de seus dados serão privados e impossibilitados de serem consultados por administradores, funcionários e outros usuários.</p>
                    <p class="lead">Os dados escondidos são:</p>
                    <ul>
                        <li>CPF</li>
                        <li>Telefone</li>
                    </ul>                 
                    <p>Para reativar, contate um funcionário.</p>
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
                url: 'http://bikeifs.com/app/src/controller/verificar/senha-usuario.php',
                data: {"user": "<?php echo $_SESSION['id'] ?>", "senha": senhaInserida},
                
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

        var url = 'http://bikeifs.com/app/src/controller/editar/usuario.php';
        var inativo = '1';
        var privado = 'n'; // 'y' e 'n' são caracteres aceitos pelo PostgreSQL para representar true e false

        $.ajax({
            type: "POST",
            url: url,
            data: {"user": "<?php echo $_SESSION['id'] ?>", "situacao":inativo, "perfil_privado":privado},
            success: function() { 
                alert('Sua conta foi desativada com sucesso! Você será redirecionado para a página de login.');
                window.location.replace('http://bikeifs.com/app/src/controller/logout.php');
            }
        });
    }

    function resetModal() {
        var modal = $("#modalDesativar");
        modal.find('#aviso-senha').css('display', 'none');
        modal.find("#inputSenha").val('');

    }


</script>