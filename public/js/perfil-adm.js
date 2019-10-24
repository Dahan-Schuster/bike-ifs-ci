$(document).ready(function() {

    $('#conteudo-perfil').load(BASE_URL + 'public/views/perfil/adm-info.php');

    $("#btn-info").click(function() {
        $('#conteudo-perfil').load(BASE_URL + 'public/views/perfil/adm-info.php');
    });

    $("#btn-config").click(function() {
        $('#conteudo-perfil').load(BASE_URL + 'public/views/perfil/adm-config.php');
    });

    $("#btn-remove").click(function() {
        $('#conteudo-perfil').load(BASE_URL + 'public/views/perfil/adm-remove.php');
    });
});