function popularTabelaHistoricoUsuario(user) {
    return $('#tableRegistros').DataTable({
        "columnDefs": [
            {
                // Altera a coluna referente à cor da bike para uma div com a respectiva cor.
                // O correto funcionamento depende de que a cor esteja em formado hexadecimal (#000000 -
                // - #ffffff), o que é garantido pelo formulário de cadastro de bicicletas. 
                "render" : function(cores) {
                    atualizarArrayCores(cores);
                    cssBackground = criarCssBackground();
                    return '<div class="bike-color" style="background: ' + cssBackground + ';"><img src="http://bikeifs.com/public/img/icons/bycicle.png" title="Bike" alt=""></div>'; 
                },
                "targets": 5 // Coluna referente à cor.
            },
            {
                // Agrupa as informações da bike em uma coluna
                "render": function(modelo, type, row) {
                    return modelo + ', ' + row.bikes.marca + ', ' + row.bikes.aro;
                },
                "targets" : 6 // Aplica o agrupamento na coluna 'Modelo'
            },
            { "width": "10%", "targets": 5 }, // Garante que a coluna da cor terá um tamanho adequado
        ],
        "language": {
            "url": "http://bikeifs.com/public/lib/scripts/Portuguese.json"
        },
        ajax: {
            type: "POST",
            url: "http://bikeifs.com/app/src/controller/carregar/historico-usuario.php",
            data: {id : user}
        },
        'processing': true,
        "columns": [
            {data : "registros.id"},
            {data : "registros.hora"},
            {data : "registros.obs"},
            {data : "funcionarios_entrada.nome"},
            {data : "registros.num_trava"},
            {data : "bikes.cores"},
            {data : "bikes.modelo"},
            {data : "bikes.marca"},
            {data : "bikes.aro"},
            {data : "saidas.hora"},
            {data : "saidas.obs"},
            {data : "funcionarios_saida.nome"}
        ]
    });
 }
 
 function configurarModalHistoricoUsuarios(tabelaHistorico) {
     $('#modalHistoricoUsuario').on('show.bs.modal', async function(){
        await tabelaHistorico.ajax.reload(); // atualiza a tabelaHistorico ao abrir o modal
        tabelaHistorico.search( '' ).columns().search( '' ).draw(); // limpa o filtro de pesquisa
     })
 }