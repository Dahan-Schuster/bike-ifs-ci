<div class="row">
    <span class="col-12 col-md-6">
        <h1>Menu de listagem</h1>
    </span>
    <div class="col-md-3"></div>
    <a class="col-12 col-md-3 btn btn-success mu-0 mb-3" href="<?= base_url('admin/view/restrita') ?>" role="button">
        Voltar para a área restrita
    </a>
</div>
<hr>
<div class="row">
    <div class="col-sm-12 col-lg-6 mb-2">
        <div class="card h-100">
            <h5 class="card-header">Administradores</h5>
            <div class="card-body">
                <h5 class="card-title">Listar os administradores do sistema</h5>
                <a href="<?= base_url('admin/listar/admins') ?>" class="btn">Listar administradores</a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mb-2">
        <div class="card h-100">
            <h5 class="card-header">Funcionários</h5>
            <div class="card-body">
                <h5 class="card-title">Listar os funcionários do bicicletário</h5>
                <a href="<?= base_url('admin/listar/funcionarios') ?>" class="btn">Listar funcionários</a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mb-2">
        <div class="card h-100">
            <h5 class="card-header">Bicicletas</h5>
            <div class="card-body">
                <h5 class="card-title">Listar as bicicletas dos usuários</h5>
                <a href="<?= base_url('admin/listar/bicicletas') ?>" class="btn">Listar bicicletas</a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mb-2">
        <div class="card h-100">
            <h5 class="card-header">Tags RFID</h5>
            <div class="card-body">
                <h5 class="card-title">Listar as etiquetas RFID cadastradas</h5>
                <a href="<?= base_url('admin/listar/tags') ?>" class="btn">Listar tags RFID</a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mb-2">
        <div class="card h-100">
            <h5 class="card-header">Usuários</h5>
            <div class="card-body">
                <h5 class="card-title">Listar os usuários do bicicletário</h5>
                <a href="<?= base_url('admin/listar/usuarios') ?>" class="btn">Listar usuários</a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mb-2">
        <div class="card h-100">
            <h5 class="card-header">Emails</h5>
            <div class="card-body">
                <h5 class="card-title">Listar os emails enviados por funcionários aos usuários</h5>
                <a href="<?= base_url('admin/listar/emails') ?>" class="btn">Listar emails</a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mb-2">
        <div class="card h-100">
            <h5 class="card-header">Registros do dia</h5>
            <div class="card-body">
                <h5 class="card-title">Listar os registros de entrada e saída de um dia específico (por padrão, hoje)</h5>
                <a href="<?= base_url('admin/listar/registros-do-dia') ?>" class="btn">Listar registros</a>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6 mb-2">
        <div class="card h-100">
            <h5 class="card-header">Todos os registros</h5>
            <div class="card-body">
                <h5 class="card-title">Listar TODOS os registros de entrada e saída</h5>
                <button class="btn btn-card" type="button" onclick="swal.fire({
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
                    })">
                    Listar registros
                </button>
            </div>
        </div>
    </div>
</div>
<br>