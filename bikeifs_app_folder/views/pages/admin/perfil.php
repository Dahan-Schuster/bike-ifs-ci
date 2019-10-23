<?php
 @session_start();
    if (isset($_SESSION['login']) and $_SESSION['tipoAcesso'] == 'admin') { ?>
        <head>
            <link rel="stylesheet" type="text/css" href="./../../lib/css/perfil.css">
        </head>
        <h2>Perfil de administrador</h2>
        <hr>
        <div class="jumbotron jumbotron-cadastro pt-3 pl-2">
            <div class="col-md-12 col-md-offset-2">
                <div class="row perfil">
                    <div class="col-lg-3 col-md-5">
                        <div class="perfil-sidebar">
                            <div class="perfil-foto">
                                <img src="http://bikeifs.com/public/img/icons/admin.png" title="Administrador" class="img-responsive" alt="Admin">
                            </div>
                            <div class="perfil-titulo">
                                <div id="perfil-nome" class="perfil-titulo-nome">
                                </div>
                                <div id="perfil-tipo" class="perfil-titulo-tipo">
                                </div>
                            </div>
                            <div class="perfil-menu">
                                <ul class="nav">
                                    <li>
                                        <button id="btn-info">
                                            <img src="http://bikeifs.com/public/img/icons/info.png" title="Informações da Conta" alt="Informações">
                                            <span>Informações</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button id="btn-config">
                                            <img src="http://bikeifs.com/public/img/icons/management.png" title="Configurações da Conta" alt="Configurações">
                                            <span>Configurações da conta</span>
                                        </button>
                                    </li>
                                    <li class="remover">
                                        <button class="text-danger" id="btn-remove">
                                            <img src="http://bikeifs.com/public/img/icons/delete-account.png" title="Desativar Conta" alt="Desativar">
                                            <span>Desativar conta</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-9 col-md-7 conteudo-perfil" id="conteudo-perfil">
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            É necessário fazer login como administrador para acessar esta página.
        </div>
    <?php } ?>
<br>
<script>
    $(document).ready(function(){
        
        $('#conteudo-perfil').load('adm-info.php');

        $("#btn-info").click(function(){  
           $('#conteudo-perfil').load('adm-info.php');
        });
        
        $("#btn-config").click(function(){  
           $('#conteudo-perfil').load('adm-config.php');
        });

        $("#btn-remove").click(function(){  
           $('#conteudo-perfil').load('adm-remove.php');
        });

       $.ajax({
            type: "POST",
            url: 'http://bikeifs.com/app/src/controller/carregar/admin-por-id.php',
            data: {adm : "<?php echo $_SESSION['id'] ?>"},
            success: function(adm) 
            {
                $("#perfil-nome").html(adm.nome.split(" ")[0]);
                $("#perfil-tipo").html(adm.documento);
            }
        });
    });
</script>