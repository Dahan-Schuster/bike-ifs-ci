<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/Tools.php');
require_once(APPPATH . 'models/ModeloBike.php');
require_once(APPPATH . 'models/TipoUsuario.php');
require_once(APPPATH . 'models/SituacaoUsuario.php');
require_once(APPPATH . 'models/SituacaoBicicleta.php');
require_once(APPPATH . 'models/SituacaoFuncionario.php');

class CrudAjax extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        date_default_timezone_set('America/Maceio');
    }

    /******************************\
    |* MÉTODOS DE CADASTRO/EDIÇÃO *|
    \******************************/

    /**
     * Função acessada via requisições AJAX para salvar Administradores
     */
    public function ajaxSalvarAdmin()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Administrador
        $this->load->model("administrador");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        if (empty(trim($data['nome']))) :
            $response['error_list']['#divInputNome'] = 'O nome não pode estar vazio.';
        endif;

        if (empty($data['email'])) :
            $response['error_list']['#divInputEmail'] = 'O email não pode estar vazio.';
        elseif ($this->administrador->estaCadastrado('email', $data['email'])) :
            $response['error_list']['#divInputEmail'] = 'O email informado já foi cadastrado.';
        endif;

        if (empty($data['cpf'])) :
            $response['error_list']['#divInputCpf'] = 'O CPF não pode estar vazio.';
        elseif (!Tools::isCpfValido($data['cpf'])) :
            $response['error_list']['#divInputCpf'] = 'O CPF informado não é válido.';
        elseif ($this->administrador->estaCadastrado('cpf', Tools::formatCnpjCpf($data['cpf']))) :
            $response['error_list']['#divInputCpf'] = 'O CPF informado já foi cadastrado.';
        endif;

        if (empty($data['senha'])) :
            $response['error_list']['#divInputSenha'] = 'A senha é obrigatória.';
        else :
            if (strval($data['senha']) != strval($data['confirmar_senha'])) :
                $response['error_list']['#divInputConfirmarSenha'] = 'As senhas não coincidem.';
            else :
                $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
                unset($data['confirmar_senha']);
            endif;
        endif;

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            # Verifica se um ID foi passado por parâmetro (em caso de edição)
            if (empty($data['id'])) :   # Se não, insere um novo registro
                unset($data['id']);
                $this->administrador->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->administrador->editar($id, $data);
            endif;
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para salvar Funcionários
     */
    public function ajaxSalvarFuncionario()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Funcionário
        $this->load->model("funcionario");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        if (empty(trim($data['nome']))) :
            $response['error_list']['#divInputNome'] = 'O nome não pode estar vazio.';
        endif;

        if (!empty($data['telefone']) && $this->funcionario->estaCadastrado('telefone', $data['telefone'])) :
            $response['error_list']['#divInputTelefone'] = 'Este telefone já está cadastrado.';
        endif;

        if (empty($data['email'])) :
            $response['error_list']['#divInputEmail'] = 'O email não pode estar vazio.';
        elseif ($this->funcionario->estaCadastrado('email', $data['email'])) :
            $response['error_list']['#divInputEmail'] = 'O email informado já foi cadastrado.';
        endif;

        if (empty($data['cpf'])) :
            $response['error_list']['#divInputCpf'] = 'O CPF não pode estar vazio.';
        elseif (!Tools::isCpfValido($data['cpf'])) :
            $response['error_list']['#divInputCpf'] = 'O CPF informado não é válido.';
        elseif ($this->funcionario->estaCadastrado('cpf', Tools::formatCnpjCpf($data['cpf']))) :
            $response['error_list']['#divInputCpf'] = 'O CPF informado já foi cadastrado.';
        endif;

        if (empty($data['senha'])) :
            $response['error_list']['#divInputSenha'] = 'A senha é obrigatória.';
        else :
            if (strval($data['senha']) != strval($data['confirmar_senha'])) :
                $response['error_list']['#divInputConfirmarSenha'] = 'As senhas não coincidem.';
            else :
                $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
                unset($data['confirmar_senha']);
            endif;
        endif;

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            # Verifica se um ID foi passado por parâmetro (em caso de edição)
            if (empty($data['id'])) :   # Se não, insere um novo registro
                unset($data['id']);
                $this->funcionario->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->funcionario->editar($id, $data);
            endif;
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para salvar Usuários
     */
    public function ajaxSalvarUsuario()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Usuário
        $this->load->model("usuario");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        if (empty(trim($data['nome']))) :
            $response['error_list']['#divInputNome'] = 'O nome não pode estar vazio.';
        endif;

        if (isset($data['telefone']) && $this->usuario->estaCadastrado('telefone', $data['telefone'])) :
            $response['error_list']['#divInputTelefone'] = 'Este telefone já está cadastrado.';
        endif;

        if (empty($data['email'])) :
            $response['error_list']['#divInputEmail'] = 'O email não pode estar vazio.';
        elseif ($this->usuario->estaCadastrado('email', $data['email'])) :
            $response['error_list']['#divInputEmail'] = 'O email informado já foi cadastrado.';
        endif;

        if (empty($data['cpf'])) :
            $response['error_list']['#divInputCpf'] = 'O CPF não pode estar vazio.';
        elseif (!Tools::isCpfValido($data['cpf'])) :
            $response['error_list']['#divInputCpf'] = 'O CPF informado não é válido.';
        elseif ($this->usuario->estaCadastrado('cpf', Tools::formatCnpjCpf($data['cpf']))) :
            $response['error_list']['#divInputCpf'] = 'O CPF informado já foi cadastrado.';
        endif;

        if (empty($data['tipo'])) :
            $response['error_list']['#divSelectTipo'] = 'O tipo de usuário não pode estar vazio.';
        elseif (
            $data['tipo'] != TipoUsuario::ALUNO &&
            $data['tipo'] != TipoUsuario::SERVIDOR &&
            $data['tipo'] != TipoUsuario::VISITANTE
        ) :
            $response['error_list']['#divSelectTipo'] = 'Tipo de usuário não reconhecido.';
        endif;

        if (isset($data['tipo']) && $data['tipo'] != TipoUsuario::VISITANTE) :
            if (empty($data['matricula'])) :
                $response['error_list']['#divInputMatricula'] = 'Matrícula requerida para alunos e servidores';
            endif;
        endif;

        if (empty($data['senha'])) :
            $response['error_list']['#divInputSenha'] = 'A senha é obrigatória.';
        else :
            if (strval($data['senha']) != strval($data['confirmar_senha'])) :
                $response['error_list']['#divInputConfirmarSenha'] = 'As senhas não coincidem.';
            else :
                $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
                unset($data['confirmar_senha']);
            endif;
        endif;

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            # Verifica se um ID foi passado por parâmetro (em caso de edição)
            if (empty($data['id'])) :   # Se não, insere um novo registro
                unset($data['id']);
                $this->usuario->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->usuario->editar($id, $data);
            endif;
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para salvar Bicicletas
     */
    public function ajaxSalvarBicicleta()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Bicicleta
        $this->load->model("bicicleta");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        if (empty($data['cores'])) :
            $response['error_list']['#divInputCores'] = 'A cor da bike é obrigatória';
        endif;

        if (empty($data['modelo'])) :
            $response['error_list']['#divSelectModelo'] = 'Selecione um modelo para a bike.';
        elseif (
            $data['modelo'] != ModeloBike::URBANA &&
            $data['modelo'] != ModeloBike::DOBRAVEL &&
            $data['modelo'] != ModeloBike::FIXA &&
            $data['modelo'] != ModeloBike::MOUNTAIN &&
            $data['modelo'] != ModeloBike::SPEED &&
            $data['modelo'] != ModeloBike::BMX &&
            $data['modelo'] != ModeloBike::DOWNHILL &&
            $data['modelo'] != ModeloBike::ELETRICA
        ) :
            $response['error_list']['#divSelectModelo'] = 'Modelo não reconhecido.';

        endif;

        if (empty($data['aro'])) :
            $response['error_list']['#divInputAro'] = 'Por favor, informe o aro da bike.';
        endif;

        if (empty($data['id_usuario'])) :
            $response['error_list']['#divSelectUsuario'] = 'Por favor, informe o dono da bike.';
        else :
            $this->load->model('usuario');
            $usuarioExiste = $this->usuario->carregarPorId($data['id_usuario']);
            if (!$usuarioExiste)
                $response['error_list']['#divSelectUsuario'] = 'Usuário não cadastrado. Selecione um usuário da lista.';
        endif;

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            # Verifica se um ID foi passado por parâmetro (em caso de edição)
            if (empty($data['id'])) :   # Se não, insere um novo registro
                unset($data['id']);
                $this->bicicleta->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->bicicleta->editar($id, $data);
            endif;
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para salvar Tags RFID
     */
    public function ajaxSalvarTagRFID()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model TagRFID
        $this->load->model("tagrfid");
        # Carrega o model Bicicleta
        $this->load->model('bicicleta');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        $data['codigo'] = strtoupper($data['codigo']);

        if (empty(trim($data['codigo']))) :
            $response['error_list']['#divInputUid'] = 'O código UID não pode estar vazio.';
        else :
            $uidJaCadastrado = $this->tagrfid->listarPorCampos(array('codigo' => $data['codigo']));
            if ($uidJaCadastrado) :
                $response['error_list']['#divInputUid'] = 'Código UID já cadastrado.';
            else :
                $tagsDaBike = $this->tagrfid->listarPorChaveEstrangeira('id_bicicleta', $data['id_bicicleta']);
                if ($tagsDaBike)
                    $response['error_list']['#divSelectBicicleta'] = 'Já existe um código RFID cadastrado para esta bicicleta.';
            endif;
        endif;

        if (empty($data['id_bicicleta'])) :
            $response['error_list']['#divSelectBicicleta'] = 'Por favor, seleciona a bike que irá receber a Tag.';
        else :
            $bikeExiste = $this->bicicleta->carregarPorId($data['id_bicicleta']);
            if (!$bikeExiste)
                $response['error_list']['#divSelectBicicleta'] = 'Bike não cadastrada. Selecione um usuário da lista e então escolha uma entre suas bicicletas.';
        endif;

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            $this->tagrfid->inserir($data);
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para salvar Registros de entrada
     */
    public function ajaxInserirRegistro()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request()) :
            exit("Não é permitido acesso direto aos scripts.");
        elseif ($this->session->userdata['permissions_level'] != 'admin') : // TODO: consertar permissão de checkin
            echo json_encode(
                array(
                    'status' => -1,
                    'error_message' => 'Apenas funcionários possuem permissão para realizar checkins.'
                )
            );
            exit();
        endif;

        # Carrega o model Registro
        $this->load->model("registro");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        if (empty($data['num_trava'])) :
            $data['num_trava'] = 0;
        elseif ($data['num_trava'] != 0) :
            if ($this->registro->listarPorCampos(array('id_saida' => 'IS NULL', 'num_trava', $data['num_trava'])))
                $response['error_list']['#divInputNumTrava'] = 'Um usuário está utilizando esta trava no momento. Tente utilizar outra.';
        endif;

        if (empty($data['id_bicicleta'])) :
            $response['error_list']['#divSelectBicicleta'] = 'Por favor, seleciona a bike que irá receber a Tag.';
        else :
            $this->load->model('bicicleta');
            $bikeExiste = $this->bicicleta->carregarPorId($data['id_bicicleta']);
            if (!$bikeExiste)
                $response['error_list']['#divSelectBicicleta'] = 'Bike não cadastrada. Selecione um usuário da lista e então escolha uma entre suas bicicletas.';
        
        endif;

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            $data['data_hora'] = date('Y-m-d H:i:s');
            $data['id_funcionario'] = $this->session->userdata['logged_user_id'];
            $this->registro->inserir($data);
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para realizar checkouts dos registros de entrada
     */
    public function ajaxCheckoutRegistro()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request()) :
            exit("Não é permitido acesso direto aos scripts.");
        elseif ($this->session->userdata['permissions_level'] != 'funcionario') :
            echo array(
                'status' => -1,
                'error_message' => 'Apenas funcionários possuem permissão para realizar checkouts.'
            );
            exit();
        endif;

        # Carrega o model Saida
        $this->load->model("saida");
        # Carrega o model Registro
        $this->load->model("Registro");

        # Dados enviados via POST
        $data = $this->input->post();

        # Recupera a hora atual
        $data['data_hora'] = date('Y-m-d H:i:s');
        # Recupera o ID do funcionário logado
        $data['id_funcionario'] = $this->session->userdata['logged_user_id'];

        # Registra uma saída...
        $response['id_saida'] = $this->saida->inserir($data);
        # ... e a associa ao registro de entrada que possui o ID recebido via POST 
        $response['id_registro'] = $this->registro->editar($data['id_registro'], array('id_saida' => $response['id_saida']));

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /*********************************\
    |* MÉTODOS PARA ATIVAR/DESATIVAR *|
    \*********************************/


    /**
     * Função acessada via requisições AJAX para ativar Bicicletas
     */
    public function ajaxAtivarBicicletas()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Bicicleta
        $this->load->model("bicicleta");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_bicicletas');
        $this->bicicleta->ativar($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para desativar Bicicletas
     */
    public function ajaxDesativarBicicletas()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Bicicleta
        $this->load->model("bicicleta");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_bicicletas');
        $this->bicicleta->desativar($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para ativar Usuários
     */
    public function ajaxAtivarUsuarios()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Usuario
        $this->load->model("usuario");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_usuarios');
        $this->usuario->ativar($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para desativar Usuários
     */
    public function ajaxDesativarUsuarios()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Usuario
        $this->load->model("usuario");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_usuarios');
        $this->usuario->desativar($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para ativar Funcionários
     */
    public function ajaxAtivarFuncionarios()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Funcionário
        $this->load->model("funcionario");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_funcionarios');
        $this->funcionario->ativar($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para desativar Funcionários
     */
    public function ajaxDesativarFuncionarios()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Funcionário
        $this->load->model("funcionario");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_funcionarios');
        $this->funcionario->desativar($ids);

        echo json_encode($response);
    }

    /***********************\
    |* MÉTODOS DE EXCLUSÃO *|
    \***********************/

    /**
     * Função acessada via requisições AJAX para deleção de Administradores
     */
    public function ajaxDeletarAdmins()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Administrador
        $this->load->model('administrador');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $ids = $this->input->post('ids_admins');
        $this->administrador->excluir($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para deleção de Tags RFID
     */
    public function ajaxDeletarTagsRFID()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model 
        $this->load->model('tagrfid');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $ids = $this->input->post('ids_tags');
        $this->tagrfid->excluir($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para deleção de registros de entrada/saída
     */
    public function ajaxDeletarRegistros()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Registro
        $this->load->model('registro');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $ids = $this->input->post('ids_registros');
        $this->registro->excluir($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para deleção de registros de entrada/saída
     */
    public function ajaxDesfazerCheckout()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Saida
        $this->load->model('saida');
        # Carrega o model Registro
        $this->load->model('registro');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $data = $this->input->post();

        # Remove o ID da saída da tabela Registro
        $this->registro->editar($data['id_registro'], array('id_saida' => NULL));

        # Deleta a saída
        $this->saida->excluir(array($data['id_saida']));

        echo json_encode($response);
    }

    /***********************\
    |* MÉTODOS DE LISTAGEM *|
    \***********************/


    /**
     * Função acessada por requisições AJAX para listagem de Administradores
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarAdmins()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Administrador
        $this->load->model('administrador');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        $admins = $this->administrador->listarTodos();

        $admins = !$admins ? array() : $admins;

        $response['data'] = $admins;


        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de 
     * registros de entrada e saída de um dia específico
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarRegistrosDoDia()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Registro
        $this->load->model('registro');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $timestamp = $this->input->post('timestamp');

        $registros = $this->registro->listarRegistrosPorDia($timestamp);
        $registrosFormatados = $this->formatarRegistros($registros);

        $response['data'] = $registrosFormatados;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de registros de entrada/saída
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarTodosRegistros()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Registro
        $this->load->model('registro');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $registros = $this->registro->listarTodos();
        $registrosFormatados = $this->formatarRegistros($registros);

        $response['data'] = $registrosFormatados;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de registros selecionados via filtro
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarRegistrosFiltrados()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Registro
        $this->load->model('registro');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $filtro = $this->input->post('filtro');
        $registros = $this->registro->filtrarRegistros($filtro);
        $registrosFormatados = $this->formatarRegistros($registros);

        $response['data'] = $registrosFormatados;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem do histórico de um usuário
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarRegistrosDoUsuario()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Registro
        $this->load->model('registro');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $id_usuario = $this->input->post('id_usuario');
        $registros = $this->registro->listarHistoricoUsuario($id_usuario);
        $registros = !$registros ? array() : $registros;
        $registrosFormatados = $this->formatarRegistros($registros);

        $response['data'] = $registrosFormatados;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de bikes
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarBicicletas()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Bicicleta
        $this->load->model('bicicleta');
        # Carrega o model Usuario
        $this->load->model('usuario');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        $bicicletas = $this->bicicleta->listarTodos();
        $bicicletas = !$bicicletas ? array() : $bicicletas;
        $bicicletasFormatadas = array();

        foreach ($bicicletas as $bike) :
            ## Salva as informações interessantes sobre o usuário em um array

            $user = $this->usuario->carregarPorId($bike["id_usuario"]);
            $userInfo = array(
                'id' => $user->id,
                'nome' => $user->nome
            );

            # Formata as informações da bicicleta
            $bike['marca'] = (!trim($bike['marca']) ? 'Não informado' : $bike['marca']);
            $bike['obs'] = (!trim($bike['obs']) ? 'Nenhuma observação' : $bike['obs']);
            $bike['nome_modelo'] = ModeloBike::getNomeModelo($bike['modelo']);
            $bike['situacao'] = SituacaoBicicleta::getTipoSituacao($bike['situacao']);

            $bikeAndUser['bikes'] = $bike;      # salva as informações da bike no objeto que contém a bicicleta e seu usuário
            $bikeAndUser['users'] = $userInfo;  # salva as informações do usuário no objeto que contém a bicicleta e seu usuário

            array_push($bicicletasFormatadas, $bikeAndUser); # adiciona ao array resultado um novo array de objetos
        endforeach;

        $response['data'] = $bicicletasFormatadas;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de
     * bicicletas de um usuário específico
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarBicicletasDoUsuario()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Bicicleta
        $this->load->model('bicicleta');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $id_usuario = $this->input->post('id_usuario');
        $bicicletas = $this->bicicleta->listarPorChaveEstrangeira('id_usuario', $id_usuario);
        $bicicletas = !$bicicletas ? array() : $bicicletas;
        $bicicletasFormatadas = array();

        foreach ($bicicletas as $bike) :
            # Formata as informações da bicicleta
            $bike['marca'] = (!trim($bike['marca']) ? 'Não informado' : $bike['marca']);
            $bike['obs'] = (!trim($bike['obs']) ? 'Nenhuma observação' : $bike['obs']);
            $bike['modelo'] = ModeloBike::getNomeModelo($bike['modelo']);
            $bike['situacao'] = SituacaoBicicleta::getTipoSituacao($bike['situacao']);

            array_push($bicicletasFormatadas, $bike); # adiciona ao array resultado um novo array de objetos
        endforeach;

        $response['data'] = $bicicletasFormatadas;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para buscar uma
     * bicicleta a partir do UID da Tag RFID associada a ela
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxBuscarBicicletaPorUID()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Tag RFID
        $this->load->model('tagrfid');
        # Carrega o model Bicicleta
        $this->load->model('bicicleta');
        # Carrega o model Usuario
        $this->load->model('usuario');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $uid = $this->input->post('uid');

        $tags = $this->tagrfid->listarPorCampos(array('codigo' => $uid));

        if ($tags) :
            $tag = $tags[0];
            $bike = $this->bicicleta->carregarPorId($tag['id_bicicleta']);
            $user = $this->usuario->carregarPorId($bike->id_usuario);

            # salva as informações interessantes sobre a bike
            $bikeInfo = array(
                'id' => $bike->id,
                'cores' => $bike->cores,
                # Recupera o nome referente ao número do modelo
                'modelo' => ModeloBike::getNomeModelo($bike->modelo),
                # Verifica se há marca e formata
                'marca' => (!trim($bike->marca) ? 'Não informado' : $bike->marca),
                'aro' => $bike->aro,
                'situacao' => SituacaoBicicleta::getTipoSituacao($bike->situacao)
            );

            # salva as informações interessantes sobre a o usuario (dono da bike)
            $userInfo = array(
                'id' => $user->id,
                'nome' => preg_split('/\s/', $user->nome)[0],  // Retorna apenas o primeiro nome do usuário
                'matricula' => (!trim($user->matricula) ? "Não informado" : $user->matricula) // Verifica se há matrícula e formata
            );

            $response['data']['bike'] = $bikeInfo;
            $response['data']['user'] = $userInfo;
        else :
            $response['status'] = 0;
            $response['error_message'] = 'Código UID não cadastrado';
        endif;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de emails enviados
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarEmailsDoDia()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Email
        $this->load->model('email');
        # Carrega o model Funcionario
        $this->load->model('funcionario');
        # Carrega o model Usuario
        $this->load->model('usuario');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $timestamp = $this->input->post('timestamp');

        $emails = $this->email->listarEmailsPorDia($timestamp);
        $emailsFormatados = array();

        $emails = !$emails ? array() : $emails;

        foreach ($emails as $email) {

            # Formata a hora e a data do envio do email
            $email['hora'] = Tools::formatarTimestamp(strtotime($email['hora']));

            ## Salva as informações interessantes sobre o funcionário que enviou o email

            $fun = $this->funcionario->carregarPorId($email['id_funcionario']);
            $funcInfo = array(
                'id' => $fun->id,
                'nome' => $fun->nome
            );

            ## Salva as informações interessantes sobre a o usuario

            $user = $this->usuario->carregarPorId($email['id_usuario']);
            $userInfo = array(
                'id' => $user->id,
                'nome' => $user->nome
            );

            # Salva as informações formatadas em um array que contém todos os dados pertinentes sobre o registro
            $registro['emails'] = $email;
            $registro['funcionarios'] = $funcInfo;
            $registro['users'] = $userInfo;

            array_push($emailsFormatados, $registro); // adiciona ao array resultado um novo registro (array de objetos)
        }

        $response['data'] = $emailsFormatados;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de Tags RFID
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarTagsRFID()
    {
        //if (!$this->input->is_ajax_request())
        //    exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Tag RFID
        $this->load->model('tagrfid');
        # Carrega o model Bicicleta
        $this->load->model('bicicleta');
        # Carrega o model Usuario
        $this->load->model('usuario');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        $tags = $this->tagrfid->listarTodos();
        $tagsFormatadas = array();

        $tags = !$tags ? array() : $tags;

        foreach ($tags as $tag) :

            ## Salva as informações interessantes sobre a bike associada à Tag RFID

            $bike = $this->bicicleta->carregarPorId($tag["id_bicicleta"]);
            $bikeInfo = array(
                'id' => $bike->id,
                'cores' => $bike->cores,
                'nome_modelo' => ModeloBike::getNomeModelo($bike->modelo),
                'marca' => (!trim($bike->marca) ? 'Não informado' : $bike->marca),
                'aro' => $bike->aro,
                'situacao' => SituacaoBicicleta::getTipoSituacao($bike->situacao)
            );

            ## Salva as informações importantes sobre o usuário (dono da bike)

            $user = $this->usuario->carregarPorId($bike->id_usuario);
            $userInfo = array(
                'id' => $user->id,
                'nome' => preg_split('/\s/', $user->nome)[0], // Retorna apenas o primeiro nome do usuário
                'situacao' => SituacaoUsuario::getTipoSituacao($user->situacao)
            );

            # salva as informações formatadas no objeto que contém a tag, a bicicleta e seu usuário
            $tagBikeAndUser['tags']  = $tag;            # salva as informações da tag
            $tagBikeAndUser['bikes'] = $bikeInfo;       # salva as informações da bike
            $tagBikeAndUser['users'] = $userInfo;       # salva as informações do usuário

            array_push($tagsFormatadas, $tagBikeAndUser); # adiciona ao array resultado um novo array de objetos
        endforeach;

        $response['data'] = $tagsFormatadas;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de Usuários
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarUsuarios()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Usuario
        $this->load->model('usuario');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        $usuarios = $this->usuario->listarTodos();
        $usuarios = !$usuarios ? array() : $usuarios;

        foreach ($usuarios as $key => $user) :

            $user['tipo'] = TipoUsuario::getNomeTipo($user['tipo']);
            $user['situacao'] = SituacaoUsuario::getTipoSituacao($user['situacao']);

            $user['telefone'] = ($user['perfil_privado'] ? "Privado" : (!trim($user['telefone']) ? 'Não informado' : $user['telefone']));

            $user['email'] = (!trim($user['email']) ? 'Não informado' : $user['email']);
            $user['cpf'] = ($user['perfil_privado'] ? "Privado" : $user['cpf']);
            $user['matricula'] = (!trim($user['matricula']) ? "Não informado" : $user['matricula']);

            $usuarios[$key] = $user;

        endforeach;

        $response['data'] = $usuarios;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de Funcionários
     * 
     * Retorna um JSON de objetos
     */
    public function ajaxListarFuncionarios()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Funcionario
        $this->load->model('funcionario');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        $funcionarios = $this->funcionario->listarTodos();
        $funcionarios = !$funcionarios ? array() : $funcionarios;

        foreach ($funcionarios as $key => $fun) {

            $fun['telefone'] = (!trim($fun['telefone']) ? 'Não informado' : $fun['telefone']);
            $fun['email'] = (!trim($fun['email']) ? 'Não informado' : $fun['email']);
            $fun['situacao'] = SituacaoFuncionario::getTipoSituacao($fun['situacao']);

            $funcionarios[$key] = $fun;
        }

        $response['data'] = $funcionarios;

        echo json_encode($response);
    }

    public function gerarOpcoesDeBikesPorUsuario()
    {
        $id_usuario = $this->input->post('id_usuario');

        # Carrega o model Bicicleta
        $this->load->model('bicicleta');

        if (!empty($id_usuario)) {
            // Carregar os dados referentes ao usuário selecionado
            $foreingKey = 'id_usuario';
            $bicicletas = $this->bicicleta->listarPorChaveEstrangeira($foreingKey, $id_usuario);

            // Gera um HTML de acordo com o resultado da query
            if (sizeof($bicicletas) > 0) {
                echo '<option value="">Selecione uma bicicleta</option>';
                foreach ($bicicletas as $bike) {
                    $bike['marca'] = (!trim($bike['marca']) ? "Marca não informada" : $bike['marca']);
                    echo '<option value="' . $bike['id'] . '" data-color="' . $bike['cores'] . '">' .
                        ModeloBike::getNomeModelo($bike['modelo']) . ', ' .
                        $bike['marca'] . ', ' . $bike['aro'] .
                        '</option>';
                }
            } else
                echo '<option value="">Nenhuma bicicleta cadastrada.</option>';
        }
    }


    /**
     * Método utilizado pelas funções ajax de listagem de registros
     * Formata os dados de cada registro
     */
    private function formatarRegistros($registros)
    {

        # Carrega o model Bicicleta
        $this->load->model('bicicleta');
        # Carrega o model Usuario
        $this->load->model('usuario');
        # Carrega o model Saida
        $this->load->model('saida');
        # Carrega o model Funcionario
        $this->load->model('funcionario');

        $registrosFormatados = array();

        if (!$registros) $registros = array();

        foreach ($registros as $reg) :

            ## Formata algumas informações sobre o registro de entrada (checkin)

            # Verifica se há informações sobre o cadeado e formata
            $reg['num_trava'] = (!trim($reg['num_trava']) ? 'Nenhum cadeado utilizado' : $reg['num_trava']);
            # Formata a hora e a data
            $reg['data_hora'] = Tools::formatarTimestamp(strtotime($reg['data_hora']));
            # Verifica se há observações e formata
            $reg['obs'] = (!trim($reg['obs']) ? 'Nenhuma observação' : $reg['obs']);

            ## Formata as informações importantes sobre o funcionário que realizou o checkin

            $fun_entrada = $this->funcionario->carregarPorId($reg['id_funcionario']);
            $funcEntradaInfo = array(
                'id' => $fun_entrada->id,
                'nome' => $fun_entrada->nome,
                'cpf' => $fun_entrada->cpf
            );

            ## Formata as informações importantes sobre a bicicleta

            $bike = $this->bicicleta->carregarPorId($reg['id_bicicleta']);
            $bikeInfo = array(
                'id' => $bike->id,
                'cores' => $bike->cores,
                'modelo' => ModeloBike::getNomeModelo($bike->modelo),
                'marca' => (!trim($bike->marca) ? 'Não informado' : $bike->marca),
                'aro' => $bike->aro
            );

            ## Formata as informações importantes sobre o usuário (dono da bike)

            $user = $this->usuario->carregarPorId($bike->id_usuario);
            $userInfo = array(
                'id' => $user->id,
                'nome' => $user->nome, // Retorna apenas o primeiro nome do usuário
                'matricula' => (!trim($user->matricula) ? "Não informado" : $user->matricula),
                'cpf' => ($user->perfil_privado ? 'Privado' : $user->cpf)
            );

            ## Formata as informãoes importantes sobre o registro de saída (checkout)

            # Verifica se há um registro de saída relacionado ao registro de entrada ...
            if ($reg['id_saida']) :

                ## Salva as informações da saída
                $saida = $this->saida->carregarPorId($reg['id_saida']);
                $saidaInfo = array(
                    'id' => $saida->id,
                    // Formata a hora e a data
                    'data_hora' => Tools::formatarTimestamp(strtotime($saida->data_hora)),
                    // Verifica se há observações e formata
                    'obs' => (!trim($saida->obs) ? 'Nenhuma observação' : $saida->obs),
                );

                ## Formata as informações importantes sobre o funcionário que realizou o checkin

                $fun_saida = $this->funcionario->carregarPorId($saida->id_funcionario);
                $funcSaidaInfo = array(
                    'id' => $fun_saida->id,
                    'nome' => $fun_saida->nome,
                    'cpf' => $fun_saida->cpf
                );
            # ... se não houver, preenche os dados com 'Pendente'
            else :
                $saidaInfo = array(
                    'id' => null,
                    'data_hora' => 'Pendente',
                    'obs' => 'Pendente'
                );

                $funcSaidaInfo = array(
                    'id' => null,
                    'nome' => 'Pendente',
                );
            endif;

            # Salva as informações formatadas em um array que contém todos os dados pertinentes sobre o registro
            $registro['registros'] = $reg;                          # info. sobre o registro de entrada
            $registro['funcionarios_entrada'] = $funcEntradaInfo;   # info. sobre o fun. que registrou a entrada
            $registro['bikes'] = $bikeInfo;                         # info. sobre a bicicleta
            $registro['users'] = $userInfo;                         # info. sobre o dono da bicicleta
            $registro['saidas'] = $saidaInfo;                       # info. sobre o registro de saída
            $registro['funcionarios_saida'] = $funcSaidaInfo;       # info. sobre o fun. que registrou a saída

            array_push($registrosFormatados, $registro); // adiciona à lista de registros um novo registro (array de objetos)
        endforeach;

        return $registrosFormatados;
    }
}
