<?php
@session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['tipoAcesso'] == 'admin' || $_SESSION['tipoAcesso'] == 'funcionario') { ?>
        <a class="col-sm-12 col-md-6 col-lg-4 btn btn-success mu-0 mb-3" href="?pagina=restrita" role="button">
            Voltar para a área restrita
        </a>
        <div class="jumbotron jumbotron-cadastro">
            <div class="col-md-12 col-md-offset-2">
                <h2>Contatar usuário</h2>
                <div class="alert alert-info" role="alert">
                    Campos marcados com <span class="text-danger"><b>*</b></span> são obrigatórios
                </div>
                <hr class="my-3">
                <form id="formEnvioEmail" autocomplete="off" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="form-group col-6 col-md-4">
                            <label for="inputNome">Nome <span class="text-danger"><b>*</b></span></label>
                            <input type="text" class="form-control" id="inputNome" placeholder="Primeiro nome do rementente" required>
                            <div class="invalid-feedback">
                                Por favor, informe seu nome.
                            </div>
                        </div>
                        <div class="form-group col-6 col-md-4">
                            <label for="inputSobrenome">Sobrenome <span class="text-danger"><b>*</b></span></label>
                            <input type="text" class="form-control" id="inputSobrenome" placeholder="Último nome do rementente" required>
                            <div class="invalid-feedback">
                                Por favor, informe seu sobrenome.
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="inputAssunto">
                                Assunto <span class="text-danger"><b>*</b></span>
                            </label>
                            <input type="text" class="form-control" id="inputAssunto" placeholder="Assunto do email" required>
                            <div class="invalid-feedback">
                                Por favor, informe o assunto do email.
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="destinatarios">
                                Destinatário(s) <span class="text-danger"><b>*</b></span>
                                (Selecione um ou mais clicando no botão azul)
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPesquisarUsuario" style="outline: none; box-shadow: none; padding: 0 .75rem;">
                                        <img src="<?= base_url() ?>/public/img/icons/ativar.png" title="Pesquisar usuário" alt="Pesquisar">
                                    </button>
                                </div>
                                <div class="form-control div-destinatarios" id="destinatarios">
                                </div>
                                <div id="sem-destinatario" class="invalid-feedback">
                                    Informe ao menos um destinatário
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label for="inputCorpo">Corpo do email <span class="text-danger"><b>*</b></span></label>
                            <textarea style="font-size: 16pt; min-height: 120px;" maxlength="255" class="form-control" id="inputCorpo" required></textarea>
                            <div class="invalid-feedback">
                                Por favor, insira um corpo para o email.
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">
                    <button id="btnEnviar" type="submit" class="btn btn-lg btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Você não tem permissão para acessar esta página.
        </div>
    <?php }
    } else { ?>
    <div class="alert alert-danger" role="alert">
        É necessário fazer login para acessar esta página.
    </div>
<?php } ?>
<br>
<?php
include_once('../modals/modalPesquisarUsuarioEmail.html');
?>
<script language="JavaScript" src="<?= base_url() ?>/public/js/select.usuario.email.js"></script>
<script type="text/javascript">
    var tabelaUsuarios;

    $(document).ready(function() {
        tabelaUsuarios = popularTabelaPesquisarUsuario();

        $("#inputAssunto").on('change', function() {
            if (!$(this).val().includes("Sistema Bike IFS"))
                $(this).val($(this).val() + " - Sistema Bike IFS")
        })

        $("#btnSelecionar").on('click', function() {
            selecionarTodos(this, tabelaUsuarios)
        })

        $("#inputNome").focus()
    });


    $("#formEnvioEmail").submit(function(form) {
        form.preventDefault();

        var destinatarios = recuperarEmailsSelecionados();
        if (!this.checkValidity())
            return false;
        if (destinatarios.length == 0)
            return avisarSelecionarDestinatario();

        let remetente = $("#inputNome").val().trim().toUpperCase() + ' ' + $("#inputSobrenome").val().trim().toUpperCase()
        let assunto = $("#inputAssunto").val().trim()
        let corpo = $("#inputCorpo").val().trim()


        $("#btnEnviar").attr('disabled', 'true')
        $("#btnEnviar").html('Enviando...')
        $("#btnEnviar").css('cursor', 'not-allowed')
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/phpmailer/contatar-usuario.php',
            data: {
                remetente,
                destinatarios,
                assunto,
                corpo
            },
            success: function(res) {
                if (res == 'success') {
                    registrarEnvio(remetente, assunto, corpo);
                    alertSnackBar($('#alertaSucesso'), 'Enviado com sucesso!')
                    //limparFormulario();
                } else {
                    alertSnackBar($('#alertaInvalido'), 'Ocorreu um erro.<br>Tente novamente mais tarde.')
                }
            },
            complete: function() {
                $("#btnEnviar").removeAttr('disabled')
                $("#btnEnviar").html('Enviar')
                $("#btnEnviar").css('cursor', 'pointer')
            }

        })

    })

    function registrarEnvio(remetente, assunto, corpo) {
        let usuarios = recuperarIdsUsuarios()
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/app/src/controller/inserir/email.php',
            data: {
                remetente,
                assunto,
                corpo,
                usuarios
            },
            success: function(res) {
                if (res == 'success') {
                    window.location.href = '?pagina=contatarOutro'
                }
            }
        })
    }

    function limparFormulario() {
        $("#formEnvioEmail").trigger('reset')
        $(".bloco-destinatario").remove()
        $("#destinatarios").css('border-color', '#ced4da');
    }

    function recuperarIdsUsuarios() {
        var ids = Array()
        let spansDestinatario = $('span.span-destinatario').toArray()
        spansDestinatario.forEach(destinatario => {
            ids.push($(destinatario).data('id'))
        })

        return ids
    }

    function recuperarEmailsSelecionados() {
        var destinatarios = Array()
        let spansDestinatario = $('span.span-destinatario').toArray()
        spansDestinatario.forEach(destinatario => {
            destinatarios.push($(destinatario).data('email'))
        })

        return destinatarios
    }

    function avisarSelecionarDestinatario() {
        $("#destinatarios").css('border-color', 'red');
        $("#sem-destinatario").css('display', 'block')

        return false;
    }
</script>
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Recupera os formulários que estão sujeitos a validação via JS
            var forms = document.getElementsByClassName('needs-validation');
            // Faz um loop por todos os forms para previnir a submissão e adicionar
            // as classes CSS que indicarão os campos não preenchidos
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>