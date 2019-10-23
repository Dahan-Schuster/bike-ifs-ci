<div class="row">
    <span class="col-12 col-md-6">
        <h1>Menu de cadastro</h1>
    </span>
    <div class="col-md-3"></div>
    <a class="col-12 col-md-3 btn btn-success mu-0 mb-3" href="?pagina=restrita" role="button">
        Voltar para a área restrita
    </a>
</div>
<hr>
<div class="row">
    <div class="col-sm-12 col-lg-6 mb-2">
    	<div class="card h-100">
			<h5 class="card-header">Administradores</h5>
	    	<div class="card-body">
	    		<h5 class="card-title">Realizar cadastro de administradores do sistema.</h5>
	    		<p class="card-text">
	    			Administradores possuem acesso a grande parte do sistema, incluindo cadastros de outros administradores,
	    			geração de relatórios e listagem e edição de objetos (usuários, bicicletas, tags, funcionários e administradores).
	    		</p>
	    		<p class="card-text">Adms não podem realizar cadastros de registros, apenas funcionários.</p>
	    		<a href="?pagina=cadastrarAdmin" class="btn">Cadastrar administradores</a>
	  		</div>
		</div>
    </div>
    <div class="col-sm-12 col-lg-6 mb-2">
    	<div class="card h-100">
			<h5 class="card-header">Funcionários</h5>
	    	<div class="card-body">
	    		<h5 class="card-title">Realizar cadastro de funcionários.</h5>
	    		<p class="card-text">
	    			Funcionários <i>podem</i> listar, excluir e cadastrar novos <b>usuários</b>, <b>bicicletas</b>, 
	    			<b>etiquetas RFID</b> e <b>registros de entrada e saída</b>.
	    		</p>
	    		<p class="card-text">
	    			Funcionários <i>não podem</i> listar, excluir e cadastrar <b>administradores</b> e <b>funcionários</b>.
	    		</p>
	    		<a href="?pagina=cadastrarFuncionario" class="btn">Cadastrar funcionários</a>
	  		</div>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6 mb-2">
    	<div class="card h-100">
			<h5 class="card-header">Bicicletas</h5>
	    	<div class="card-body">
	    		<h5 class="card-title">Cadastrar novas bicicletas</h5>
	    		<p class="card-text">Bicicletas devem estar associadas a usuários previamente cadastrados no sistema.</p>
	    		<a href="?pagina=cadastrarBicicleta" class="btn">Cadastrar bicicletas</a>
	  		</div>
		</div>
   </div>
    <div class="col-sm-12 col-lg-6 mb-2">
    	<div class="card h-100">
			<h5 class="card-header">Tags RFID</h5>
	    	<div class="card-body">
	    		<h5 class="card-title">Cadastrar etiquetas RFID</h5>
	    		<p class="card-text">
	    			Etiquetas devem ser lidas com um leitor RFID antes do cadastro para que seu código hexadecimal (
					<i>UID</i>) seja salvo no sistema e associado a uma bicicleta previamente cadastrada. Esteja certo de que o
					leitor esteja ativo conectado à rede.
	    		</p>
	    		<a href="?pagina=cadastrarTag" class="btn">Cadastrar tags RFID</a>
			  </div>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6 mb-2">
    	<div class="card h-100">
			<h5 class="card-header">Usuários</h5>
	    	<div class="card-body">
	    		<h5 class="card-title">Cadastrar usuários do bicicletário</h5>
	    		<p class="card-text">
	    			Usuários podem ser <b>alunos</b>, <b>servidores</b> ou <b>visitantes</b> e podem fazer login no sistema
	    			para conferir sua lista de bicicletas cadastradas e seu histórico de registros de entrada/saída.
	    		</p>
	    		<a href="?pagina=cadastrarUsuario" class="btn">Cadastrar usuários</a>
	  		</div>
		</div>
   </div>
</div>
<br>