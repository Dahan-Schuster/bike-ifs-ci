<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once('../models/Tools.php');
require_once('../models/ModeloBike.php');
require_once('../models/TipoUsuario.php');
require_once('../models/SituacaoUsuario.php');
require_once('../models/SituacaoBicicleta.php');
require_once('../models/SituacaoFuncionario.php');

class CrudAjax extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

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
            $json['error_list']['#divInputSenha'] = 'A senha é obrigatória.';
        else :
            if (strval($data['senha']) != strval($data['confirmar_senha'])) :
                $json['error_list']['#divInputConfirmarSenha'] = 'As senhas não coincidem.';
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

        if (isset($data['telefone']) && $this->funcionario->estaCadastrado('telefone', $data['telefone'])) :
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
            $json['error_list']['#divInputSenha'] = 'A senha é obrigatória.';
        else :
            if (strval($data['senha']) != strval($data['confirmar_senha'])) :
                $json['error_list']['#divInputConfirmarSenha'] = 'As senhas não coincidem.';
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
            $json['error_list']['#divInputSenha'] = 'A senha é obrigatória.';
        else :
            if (strval($data['senha']) != strval($data['confirmar_senha'])) :
                $json['error_list']['#divInputConfirmarSenha'] = 'As senhas não coincidem.';
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

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        if (empty(trim($data['UID']))) :
            $response['error_list']['#divInputUid'] = 'O código UID não pode estar vazio.';
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
            # Verifica se um ID foi passado por parâmetro (em caso de edição)
            if (empty($data['id'])) :   # Se não, insere um novo registro
                $this->tagrfid->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->tagrfid->editar($id, $data);
            endif;
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
        elseif ($this->session->userdata['permissions_level'] != 'funcionario') :
            echo array(
                'status' => -1,
                'error_message' => 'Apenas funcionários possuem permissão para realizar checkins.'
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
            $data['hora'] = date(DATE_RSS);
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
        $data['hora'] = date(DATE_RSS);
        # Recupera o ID do funcionário logado
        $data['id_funcionario'] = $this->session->userdata['logged_user_id'];

        # Registra uma saída...
        $response['id_saida'] = $this->saida->inserir($data);
        # ... e a associa ao registro de entrada que possui o ID recebido via POST 
        $response['id_registro'] = $this->registro->editar($data['id_registro'], array('id_saida' => $response['id_saida']));

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }


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

        return $response;
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

        return $response;
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

        return $response;
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

        return $response;
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

        return $response;
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
    
            return $response;
    }
}
