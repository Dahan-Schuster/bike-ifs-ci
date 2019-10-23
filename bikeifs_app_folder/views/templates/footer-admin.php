<!-- SnackBars -->
<div class="snackbar snackbar-invalido" id="alertaInvalido"></div>
<div class="snackbar snackbar-sucesso" id="alertaSucesso"></div>
<!-- Fim SnackBars -->
</div> <!-- fechamento da div "conteudo" -->

<footer>
  <div class="container">
    Bike IFS
  </div>
  <script language="JavaScript" src="http://bikeifs.com/public/lib/scripts/jquery.mask.min.js"></script>
  <script language="javascript" src="http://bikeifs.com/public/lib/scripts/bootstrap.bundle.min.js"></script>
  <script language="javascript" src="http://bikeifs.com/public/lib/scripts/validacoes.js"></script>
  <script language="javascript" src="http://bikeifs.com/public/lib/scripts/ler.tag.js"></script>
  <script language="javascript" src="http://bikeifs.com/public/lib/scripts/ferramentas.js"></script>
  <script language="javascript" src="http://bikeifs.com/public/lib/scripts/autocompletar.matricula.js"></script>
  <script language="javascript" src="http://bikeifs.com/public/lib/scripts/botao.topo.js"></script>
  <script language="javascript" src="http://bikeifs.com/public/lib/scripts/alterar.email.js"></script>
  <script language="javascript" src="http://bikeifs.com/public/lib/scripts/perfil.sidepanel.js"></script>
  <script language="javascript" src="http://bikeifs.com/public/lib/scripts/bike.sidepanel.js"></script>
  <!-- Mascaras -->
  <script type="text/javascript">
    $(document).ready(function () {
      // Esconder modais com ESC
      $(document).keyup(function (e) {
        if (e.which == 27 || e.keyCode == 27) { // 27 = Tecla ESC
          $('.modal').modal('hide');
        }
      })

      $("#inputTel").mask("(00) Z0000-0000", {
        translation: {
          'Z': {
            pattern: /[0-9]/,
            optional: true
          }
        }
      });
      $("#inputCpf").mask("000.000.000-00");
    })
  </script>
</footer>
</div> <!-- fechamento da div pagina -->

</body>

</html>