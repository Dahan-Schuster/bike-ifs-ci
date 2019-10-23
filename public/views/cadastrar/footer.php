<script>
// Método JavaScript para desabilitar a submissão de formulários caso hajam 
//campos não preenchidos e para informar a invalidez dos dados
// Fonte: BootStrap
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Recupera os formulários que estão sujeitos a validação via JS
    var forms = document.getElementsByClassName('needs-validation');
    // Faz um loop por todos os forms para previnir a submissão e adicionar
    // as classes CSS que indicarão os campos não preenchidos
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>