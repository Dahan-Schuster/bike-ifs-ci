/* Define o tamanho do painel lateral como 250px ou 100%, dependendo da largura da tela */
function openNavBike() {

    // Não faz nada se o painel já estiver aberto
    if (document.getElementById("sidenav-bike").style.width > 0) return

    if (innerWidth < 440) // se a largura da tela for pequena demais, o painel tomará todo o espaço (100%)
        document.getElementById("sidenav-bike").style.width = "100%";
    else
        document.getElementById("sidenav-bike").style.width = "300px";

    document.getElementById("sidenav-bike").style.top = 90 - scrollY > 0 ? `${90 - scrollY}px` : 0
    
    if (!document.onscroll) {
        document.onscroll = function() {
            document.getElementById("sidenav-perfil").style.top = 90 - scrollY > 0 ? `${90 - scrollY}px` : 0
            document.getElementById("sidenav-bike").style.top = 90 - scrollY > 0 ? `${90 - scrollY}px` : 0
        }
    }

}

/* Set the width of the side navigation to 0 */
function closeNavBike() {
    document.getElementById("sidenav-bike").style.width = "0";
    // Também fecha o perfil lateral do usuário, que abre automaticamente ao abrir o painel de bicicleta
    document.getElementById("sidenav-perfil").style.width = "0";
}

/* Método chamado ao clicar no íncone de uma bike nas tabelas */
function abrirPainelLateralBike(id) {
    document.getElementById("iframePainelBike").src = `${BASE_URL}/painelLateral/bicicleta/${id}`
    openNavBike()
}

/* Método chamado ao clicar em uma recompensa ná página de perfil */
function abrirPainelLateralRecompensa(id) {
    document.getElementById("iframePainelBike").src = `${BASE_URL}/painelLateral/recompensa/${id}`
    openNavBike()
}

/* Método chamado ao clicar em uma medalha ná página de perfil */
function abrirPainelLateralMedalha(id) {
    document.getElementById("iframePainelBike").src = `${BASE_URL}/painelLateral/medalha/${id}`
    openNavBike()
}