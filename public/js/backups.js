function ajaxEnviarBackupAtual() {
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'database/backup/enviar',
        dataType: 'json',
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire('Sucesso!',
                    `Backup enviado para o seu email com sucesso! 
            Verifique sua caixa de mensagem e/ou de span.
            Caso não encontre o email, certifique-se de ter um email válido cadastrado no seu perfil e tente novamente 😉`,
                    'success')
            } else {
                swal.fire('Ah não!', 'Ocorreu um erro ao recuperar o backup 😢 Tente novamente mais tarde!', 'error')
            }
        },
        error: error => console.log(error)
    })
}

function ajaxEnviarUltimoBackup() {
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'database/backup/enviar/ultimo',
        dataType: 'json',
        success: function(response) {
            if (response['status'] == 1) {
                swal.fire('Sucesso!',
                    `Backup enviado para o seu email com sucesso! 
            Verifique sua caixa de mensagem e/ou de span.
            Caso não encontre o email, certifique-se de ter um email válido cadastrado no seu perfil e tente novamente 😉`,
                    'success')
            } else {
                swal.fire('Ah não!', 'Ocorreu um erro ao recuperar o backup 😢 Tente novamente mais tarde!', 'error')
            }
        },
        error: error => console.log(error)
    })
}