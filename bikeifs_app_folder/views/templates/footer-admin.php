
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
</div> <!-- fechamento da div pagina -->

</body>

</html>