</div> <!-- fechamento da div "conteudo" -->

<footer>
  <div class="container">
    Bike IFS
  </div>
  <script language="javascript" src="<?= base_url() ?>public/js/popper.min.js"></script>
  <script language="javascript" src="<?= base_url() ?>public/js/bootstrap-material-design.js"></script>
  <script language="javascript" src="<?= base_url() ?>public/js/botao.topo.js"></script>
  <script language="javascript" src="<?= base_url() ?>public/js/sweetalert2.all.min.js"></script>
  <script language="javascript" src="<?= base_url() ?>public/js/perfil.sidepanel.js"></script>
  <script language="javascript" src="<?= base_url() ?>public/js/bike.sidepanel.js"></script>
  
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