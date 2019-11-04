$(document).ready(function() {
    $("#btn-info").click(function() {
        $("#btn-info").parent().addClass('active')
        $("#informacoes").removeClass('hidden')
        $("#btn-registros, #btn-bicicletas").parent().removeClass('active')
        $("#registros, #bicicletas").addClass('hidden')
    })

    $("#btn-registros").click(function() {
        $("#btn-registros").parent().addClass('active')
        $("#registros").removeClass('hidden')
        $("#btn-info, #btn-bicicletas").parent().removeClass('active')
        $("#informacoes, #bicicletas").addClass('hidden')
    })

    $("#btn-bicicletas").click(function() {
        $("#btn-bicicletas").parent().addClass('active')
        $("#bicicletas").removeClass('hidden')
        $("#btn-info, #btn-registros").parent().removeClass('active')
        $("#informacoes, #registros").addClass('hidden')
    })
})