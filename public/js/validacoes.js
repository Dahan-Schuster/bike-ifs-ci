function validarDados() {
    if (!validarIgualdadeSenhas())
        return false;

    var inputCpf = document.getElementById('inputCpf');
    var cpf = document.getElementById('inputCpf').value;
    if (!validarCPF(cpf)) {
        alert('O CPF informado não é válido.')
        inputCpf.style.border = '1px solid red';
        inputCpf.focus();
        return false;
    }

    return true;
}

function validarIgualdadeSenhas(){

    var senha = document.getElementById('inputSenha');
    var resenha = document.getElementById('inputReSenha');

    if (senha.value !== resenha.value) {
        alert('As senhas não coincidem.')
        resenha.style.border = '1px solid red';
        resenha.focus();
        
        return false;
    }

    return true;
}

function validarCPF(strCPF) {
    var cpf = strCPF.replace(/\.*-*/g, '');
    var Soma;
    var Resto;
    Soma = 0;
    if (cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999" ) 
        return false;
     
    for (i=1; i<=9; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(cpf.substring(9, 10)) ) return false;
   
    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  
        Resto = 0;
    if (Resto != parseInt(cpf.substring(10, 11) ) )
        return false;
    
    return true;
}
