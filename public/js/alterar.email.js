$("#inputCodigo").mask("AAAAAAAA", {
    'translation': {
        A: {
            pattern: /[A-Za-z0-9]/
        }
    }
});

// o usuário não pode digitar este código e burlar a autenticação 
// pois a máscara do campo permite apenas números e digitos
var codigo = '!!!';

function enviarCodigoPorEmail(button) {
    $(button).attr('disabled', 'disabled')
    $(button).css('cursor', 'not-allowed')

    codigo = gerarNovoCodigo();
    var email = $("#email").val();
    salvarEmailDigitado(email);
    $.ajax({
        type: "POST",
        url: 'http://bikeifs.com/app/src/controller/phpmailer/enviar-codigo-por-email.php',
        data: { "email": email, "codigo": codigo },
        complete: function() {
            $(button).removeAttr('disabled')
            $(button).css('cursor', 'pointer')
        }
    });

    alert('Codigo enviado. Por favor, verifique seu email.');
};

function gerarNovoCodigo() {

    // gera um dígito de base 10 aleatório e o converte para inteiro
    var number = parseInt(Math.random() * (0xFFFFFFF - 10000) + 10000);

    // converte o inteiro para uma string de base 64 e limita o tamanho a 8 caracteres
    var string = btoa(number).substring(0, 8);

    // substitui sinais de '=' (devido ao base64) por um inteiro aleatório entre 0 e 9
    var codigo = string.replace(/\=/g, Math.floor(Math.random() * 10));

    return codigo;
}

function salvarEmailDigitado(email) {
    $("#submitEmail").val(email);
}

function informarCodigoIncorreto() {
    $("#inputCodigo").css('border', '1px solid red');
    $("#aviso-codigo").css('display', 'inline-block');
}