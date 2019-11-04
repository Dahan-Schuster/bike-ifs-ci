/* Define o tamanho do painel lateral como 250px ou 100%, dependendo da largura da tela */
function openNavPerfil() {

    // Não faz nada se o painel já estiver aberto
    if (document.getElementById("sidenav-perfil").style.width > 0) return

    if (innerWidth < 440) // se a largura da tela for pequena demais, o painel tomará todo o espaço (100%)
        document.getElementById("sidenav-perfil").style.width = "100%";
    else
        document.getElementById("sidenav-perfil").style.width = "300px";

    document.getElementById("sidenav-perfil").style.top = `${90 - scrollY}px`

    if (!document.onscroll) {
        document.onscroll = function() {
            document.getElementById("sidenav-perfil").style.top = `${90 - scrollY}px`
            document.getElementById("sidenav-bike").style.top = `${90 - scrollY}px`
        }
    }

}

/* Set the width of the side navigation to 0 */
function closeNavPerfil() {
    document.getElementById("sidenav-perfil").style.width = "0";
}

/* Método chamado ao clicar no nome de um usuário nas tabelas */
function abrirPerfilLateralUsuario(id) {
    document.getElementById("iframePerfilLateral").src = `${BASE_URL}/painelLateral/usuario/${id}`
    openNavPerfil()
}

/* Método chamado ao clicar no nome de um funcionário nas tabelas */
function abrirPerfilLateralFuncionario(id) {
    document.getElementById("iframePerfilLateral").src = `${BASE_URL}/painelLateral/funcionario/${id}`
    openNavPerfil()
}