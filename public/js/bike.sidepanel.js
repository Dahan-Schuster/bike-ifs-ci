/* Define o tamanho do painel lateral como 250px ou 100%, dependendo da largura da tela */
function openNavBike() {

    // Não faz nada se o painel já estiver aberto
    if (document.getElementById("sidenav-bike").style.width > 0) return

    if (innerWidth < 440) // se a largura da tela for pequena demais, o painel tomará todo o espaço (100%)
        document.getElementById("sidenav-bike").style.width = "100%";
    else
        document.getElementById("sidenav-bike").style.width = "350px";

}

/* Set the width of the side navigation to 0 */
function closeNavBike() {
    document.getElementById("sidenav-bike").style.width = "0";
    // Também fecha o perfil lateral do usuário, que abre automaticamente ao abrir o painel de bicicleta
    document.getElementById("sidenav-perfil").style.width = "0";
}

/* Método chamado ao clicar no nome de um usuário nas tabelas */
function abrirPainelLateralBike(id) {
    document.getElementById("iframePainelBike").src = "http://bikeifs.com/public/view/painel_lateral_bike.php?bike=" + id
    openNavBike()
}