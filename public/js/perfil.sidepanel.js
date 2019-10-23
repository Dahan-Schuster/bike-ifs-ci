/* Define o tamanho do painel lateral como 250px ou 100%, dependendo da largura da tela */
function openNavPerfil() {

    // Não faz nada se o painel já estiver aberto
    if (document.getElementById("sidenav-perfil").style.width > 0) return

    if (innerWidth < 440) // se a largura da tela for pequena demais, o painel tomará todo o espaço (100%)
        document.getElementById("sidenav-perfil").style.width = "100%";
    else
        document.getElementById("sidenav-perfil").style.width = "350px";

}

/* Set the width of the side navigation to 0 */
function closeNavPerfil() {
    document.getElementById("sidenav-perfil").style.width = "0";
}

/* Método chamado ao clicar no nome de um usuário nas tabelas */
function abrirPerfilLateralUsuario(id) {
    document.getElementById("iframePerfilLateral").src = "http://bikeifs.com/public/view/usuario/perfil_lateral.php?user=" + id
    openNavPerfil()
}

/* Método chamado ao clicar no nome de um funcionário nas tabelas */
function abrirPerfilLateralFuncionario(id) {
    document.getElementById("iframePerfilLateral").src = "http://bikeifs.com/public/view/funcionario/perfil_lateral.php?fun=" + id
    openNavPerfil()
}