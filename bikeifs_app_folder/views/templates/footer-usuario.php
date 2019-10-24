<!-- SnackBars -->
<div class="snackbar snackbar-invalido" id="alertaInvalido"></div>
<div class="snackbar snackbar-sucesso" id="alertaSucesso"></div>
<!-- Fim SnackBars -->
</div> <!-- fechamento da div "conteudo" -->

<footer>
  <div class="container">
    Bike IFS
  </div>
  <script language="javascript" src="<?= base_url() ?>/public/js/bootstrap.bundle.min.js"></script>
  <script language="javascript" src="<?= base_url() ?>/public/js/botao.topo.js"></script>
  
  <?php
  if (isset($scripts)) :
    foreach ($scripts as $script) :
      $src = base_url("public/js/$script") ?>
      <script src="<?= $src ?>"></script>
  <?php endforeach;
  endif;
  ?>
</footer>
</body>

</html>