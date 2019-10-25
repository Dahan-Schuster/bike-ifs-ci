</div> <!-- fechamento da div "conteudo" -->

<footer>
  <div class="container">
    Bike IFS
  </div>
  <script language="javascript" src="<?= base_url() ?>public/js/popper.min.js"></script>
  <script language="javascript" src="<?= base_url() ?>public/js/bootstrap-material-design.js"></script>
  <script language="javascript" src="<?= base_url() ?>public/js/botao.topo.js"></script>
  <script language="javascript" src="<?= base_url() ?>public/js/sweetalert2.all.min.js"></script>
  <script>
    function avisoPerformance() {
      swal.fire({
        type: 'warning',
        title: 'Aviso de performance',
        text: 'Por dia, cerca de 200 registros são adicionados. Listar todos os registros pode gerar problemas de performance. Deseja mesmo continuar?',
        showCancelButton: true,
        focusConfirm: false,
        cancelButtonText: 'Não',
        cancelButtonColor: '#80bdff',
        confirmButtonText: 'Eu entendo e quero continuar',
        confirmButtonColor: '#fb0235'
      }).then((continuar) => {
        if (continuar.value)
          location = BASE_URL + 'admin/listar/registros'
      })
    }
  </script>
  <?php
  if (isset($scripts)) :
    foreach ($scripts as $script) :
      $src = base_url("public/js/$script") ?>
      <script src="<?= $src ?>"></script>
  <?php endforeach;
  endif;
  ?>
</footer>
</div> <!-- fechamento da div pagina -->

</body>

</html>