<?php @session_start(); ?>
<form id="informacoes-usuario">
    <div class="form-group row">
        <label for="nome" class="col-md-4 col-form-label">Nome</label>
        <div class="col-md-8">
            <input id="nome" name="nome" placeholder="Nome" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label">Email</label>
        <div class="col-md-8">
            <input id="email" class="form-control" type="text" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="cpf" class="col-md-4 col-form-label">CPF</label>
        <div class="col-md-8">
            <input id="cpf" class="form-control" type="text" readonly>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Atualizar</button>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        
    })

    $.ajax({
        type: "POST",
        url: '<?= base_url() ?>/app/src/controller/carregar/admin-por-id.php',
        data: {
            adm: "<?php echo $_SESSION['id'] ?>"
        },
        success: function(adm) {
            $("#nome").val(adm.nome);
            $("#email").val(adm.email);
            $("#cpf").val(adm.cpf);
        }
    });

    $("#informacoes-usuario").submit(function(form) {

        form.preventDefault();

        if (!this.checkValidity())
            return; // impede que o formulário utilize o botão submit para enviar informações

        var url = '<?= base_url() ?>/app/src/controller/editar/admin.php';
        var nome = $("#nome").val();
        var telefone = $("#telefone").val();

        $.ajax({
            type: "POST",
            url: url,
            data: {
                "id": "<?php echo $_SESSION['id'] ?>",
                "nome": nome
            },
            success: function(resultado) {
                if (resultado === 'success')
                    alertSnackBar($("#alertaSucesso"), 'Operação realizada com sucesso!')
            }
        });
    });
</script>