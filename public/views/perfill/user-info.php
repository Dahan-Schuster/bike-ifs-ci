<?php @session_start(); ?>
<form id="informacoes-usuario">
    <div class="form-group row">
        <label for="nome" class="col-md-4 col-form-label">Nome</label>
        <div class="col-md-8">
            <input id="nome" name="nome" placeholder="Nome" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="telefone" class="col-md-4 col-form-label">Telefone</label>
        <div class="col-md-8">
            <input id="telefone" name="telefone" placeholder="Telefone" class="form-control" type="text">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label">Email</label>
        <div class="col-md-8">
            <input id="email" class="form-control" type="text" readonly>
        </div>
    </div>
    <hr class="my-4">
    <div class="form-group row">
        <label for="tipo" class="col-md-4 col-form-label">Tipo de usuário</label>
        <div class="col-md-8">
            <input id="tipo" class="form-control" type="text" readonly>

        </div>
    </div>
    <div class="form-group row">
        <label for="situacao" class="col-md-4 col-form-label">Situação</label>
        <div class="col-md-8">
            <input id="situacao" class="form-control" type="text" readonly>

        </div>
    </div>
    <div class="form-group row">
        <label for="cpf" class="col-md-4 col-form-label">
            CPF
        </label>
        <div class="col-md-8">
            <input id="cpf" class="form-control" type="text" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="matricula" class="col-md-4 col-form-label">
            Matricula
        </label>
        <div class="col-md-8">
            <input id="matricula" class="form-control" type="text" readonly>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
<?php
include_once('../modals/modalUsuarioJaCadastrado.html');
?>
<script type="text/javascript">
    $(document).ready(function() {
        
    })

    $.ajax({
        type: "POST",
        url: 'http://bikeifs.com/app/src/controller/carregar/usuario-por-id.php',
        data: {
            user: "<?php echo $_SESSION['id'] ?>"
        },
        success: function(user) {
            $("#nome").val(user.nome);
            $("#telefone").val(user.telefone);
            $("#email").val(user.email);
            $("#tipo").val(user.tipo);
            $("#situacao").val(user.situacao);
            $("#cpf").val(user.cpf);
            $("#matricula").val(user.matricula);
        }
    });

    $("#informacoes-usuario").submit(function(form) {

        form.preventDefault();

        if (!this.checkValidity())
            return; // impede que o formulário utilize o botão submit para enviar informações

        var url = 'http://bikeifs.com/app/src/controller/editar/usuario.php';
        var nome = $("#nome").val();
        var telefone = $("#telefone").val();

        $.ajax({
            type: "POST",
            url: url,
            data: {
                "user": "<?php echo $_SESSION['id'] ?>",
                "nome": nome,
                "telefone": telefone
            },
            success: function(resultado) {
                if (resultado === 'error_1')
                    $("#modalUsuarioJaCadastrado").modal('show');
                else if (resultado === 'success')
                    alertSnackBar($("#alertaSucesso"), 'Operação realizada com sucesso!')

            }
        });
    });

    $("#telefone").mask("(00) Z0000-0000", {
        translation: {
            'Z': {
                pattern: /[0-9]/,
                optional: true
            }
        }
    });
</script>