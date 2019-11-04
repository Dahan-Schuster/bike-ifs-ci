<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/Tools.php');
require_once(APPPATH . 'models/SituacaoFuncionario.php');

class Funcionario extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->load->model('funcionario_model');

        if (!isset($this->session->userdata['permissions_level']))
            header('location: ' . base_url('home/view/login'));
    }

    /**
     * Carrega a página de registros do dia
     */
    public function index()
    {
        if ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'datatables.min.js',
                'dataTables.responsive.min.js',
                'jquery.mask.min.js',
                'snackbar.min.js',
                'util.js',
                'gijgo.min.js',
                "pages/registros-do-dia.js",
                'pesquisar.usuario.js',
            ),
            'styles' => array(
                'datatables.min.css',
                'responsive.dataTables.min.css',
                'gijgo.min.css',
                'snackbar.min.css'
            ),
            'pode_registrar' => TRUE,
            'nome' => $this->session->userdata('nome')
        );

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("pages/listar/registros-do-dia", $data);
        $this->load->view('templates/footer-funcionario', $data);
    }

    public function home()
    {
        if ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'util.js'
            ),
            'nome' => $this->session->userdata('nome')
        );

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("pages/home", $data);
        $this->load->view('templates/footer-funcionario', $data);
    }

    /**
     * Carrega o perfil público de um funcionário
     */
    public function funcionarios($id = null)
    {

        if ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $funcionario = $this->funcionario_model->carregarPorId($id);
        unset($funcionario->senha);

        $data = array(
            'styles' => array(
                'perfil.css',
                'snackbar.min.css'
            ),
            'scripts' => array(
                //'pages/perfil-adm.js',
                'snackbar.min.js',
                'util.js'
            ),
            'nome' => $this->session->userdata('nome'),
            'funcionario' => $funcionario
        );

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("pages/funcionario/perfil-publico", $data);
        $this->load->view('templates/footer-funcionario', $data);
    }

    /**
     * Carrega o perfil público de um usuário
     */
    public function usuarios($id = null)
    {

        if ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $this->load->model('usuario_model');
        $usuario = $this->usuario_model->carregarPorId($id);
        unset($usuario->senha);

        $data = array(
            'styles' => array(
                'perfil.css',
                'snackbar.min.css'
            ),
            'scripts' => array(
                //'pages/perfil-adm.js',
                'snackbar.min.js',
                'util.js'
            ),
            'nome' => $this->session->userdata('nome'),
            'usuario' => $usuario
        );

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("pages/usuario/perfil-publico", $data);
        $this->load->view('templates/footer-funcionario', $data);
    }

    public function listar($page = NULL)
    {

        if ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        elseif (!$page || !file_exists(APPPATH . "views/pages/listar/$page.php"))
            show_404();

        if (
            $page == 'admins' ||
            $page == 'emails' ||
            $page == 'funcionarios'
        ) {
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        }

        $data = array(
            'scripts' => array(
                'datatables.min.js',
                'dataTables.responsive.min.js',
                'jquery.mask.min.js',
                'snackbar.min.js',
                'util.js',
                'gijgo.min.js',
                "pages/$page.js"
            ),
            'styles' => array(
                'datatables.min.css',
                'responsive.dataTables.min.css',
                'gijgo.min.css',
                'snackbar.min.css'
            ),
            'nome' => $this->session->userdata('nome')
        );


        if ($page == 'bicicletas' || $page == 'tags' || $page == 'registros-do-dia') {
            array_push($data['scripts'], 'pesquisar.usuario.js');
            if ($page == 'bicicletas') :
                array_push($data['scripts'], 'escolher.cores.js');
            else :
                array_push($data['scripts'], 'ler.tag.js');
                if ($page == 'registros-do-dia') :
                    $data['pode_registrar'] = TRUE;
                endif;
            endif;
        }

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("pages/listar/$page", $data);
        $this->load->view('templates/footer-funcionario', $data);
    }

    public function contatar()
    {

        if ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'datatables.min.js',
                'dataTables.responsive.min.js',
                'snackbar.min.js',
                'util.js',
                'gijgo.min.js',
                'pesquisar.usuario.email.js',
                "pages/contatar.usuarios.js"
            ),
            'styles' => array(
                'datatables.min.css',
                'responsive.dataTables.min.css',
                'gijgo.min.css',
                'snackbar.min.css'
            ),
            'nome' => $this->session->userdata('nome')
        );

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("pages/contatar/usuario", $data);
        $this->load->view('templates/footer-funcionario', $data);
    }

    public function perfil()
    {

        if ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $funcionario = $this->funcionario_model->carregarPorId($this->session->userdata['logged_user_id']);
        unset($funcionario->senha);

        $data = array(
            'styles' => array(
                'datatables.min.css',
                'responsive.dataTables.min.css',
                'gijgo.min.css',
                'perfil.css',
                'snackbar.min.css'
            ),
            'scripts' => array(
                'datatables.min.js',
                'dataTables.responsive.min.js',
                'gijgo.min.js',
                'pages/perfil-fun.js',
                'snackbar.min.js',
                'jquery.mask.min.js',
                'util.js'
            ),
            'nome' => $this->session->userdata('nome'),
            'funcionario' => $funcionario
        );

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("pages/funcionario/perfil", $data);
        $this->load->view('templates/footer-funcionario', $data);
    }

    /**
     * Destrói a sessão e redireciona para a página inicial
     */
    public function sair()
    {
        $this->session->sess_destroy();
        header('location: ' . base_url('home/view/login'));
    }

    /**
     * Função acessada por requisições AJAX para listagem de Funcionários
     * 
     * Retorna um JSON de objetos
     */
    public function select_all()
    {

        if ($this->session->permissions_level != 'funcionario' && $this->session->permissions_level != 'admin')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        elseif (!$this->input->is_ajax_request())
            header('location: ' . base_url('funcionario/me'));


        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        $funcionarios = $this->funcionario_model->listarTodos();
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

    /**
     * Função acessada via requisições AJAX para salvar Funcionários
     */
    public function insert()
    {
        if ($this->session->permissions_level != 'funcionario' && $this->session->permissions_level != 'admin')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        # Verifica se o método está sendo acessado por uma requisição AJAX
        elseif (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        if (isset($data['nome'])) {
            if (empty(trim($data['nome']))) :
                $response['error_list']['#divInputNome'] = 'O nome não pode estar vazio.';
            endif;
        }

        if (isset($data['telefone'])) {
            if (!empty($data['telefone']) && $this->funcionario_model->estaCadastrado('telefone', $data['telefone'])) :
                $response['error_list']['#divInputTelefone'] = 'Este telefone já está cadastrado.';
            endif;
        }

        if (isset($data['email'])) {
            if (empty($data['email'])) :
                $response['error_list']['#divInputEmail'] = 'O email não pode estar vazio.';
            elseif ($this->funcionario_model->estaCadastrado('email', $data['email'])) :
                $response['error_list']['#divInputEmail'] = 'O email informado já foi cadastrado.';
            endif;
        }

        if (isset($data['cpf'])) {
            if (empty($data['cpf'])) :
                $response['error_list']['#divInputCpf'] = 'O CPF não pode estar vazio.';
            elseif (!Tools::isCpfValido($data['cpf'])) :
                $response['error_list']['#divInputCpf'] = 'O CPF informado não é válido.';
            elseif ($this->funcionario_model->estaCadastrado('cpf', Tools::formatCnpjCpf($data['cpf']))) :
                $response['error_list']['#divInputCpf'] = 'O CPF informado já foi cadastrado.';
            endif;
        }

        if (isset($data['senha'])) {
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
        }
        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            # Verifica se um ID foi passado por parâmetro (em caso de edição)
            if (empty($data['id'])) :   # Se não, insere um novo registro
                unset($data['id']);
                $this->funcionario_model->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->funcionario_model->editar($id, $data);
            endif;
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para verificar o código de confirmação
     * (salvo temporariamente na sessão após chamar o controlador de Emails) e editar
     * o atributo Email na tabela referente ao tipo de acesso do usuário logado (admin, funcionário, usuário)
     */
    public function updateEmail()
    {
        if ($this->session->permissions_level != 'funcionario' && $this->session->permissions_level != 'admin')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        # Verifica se o método está sendo acessado por uma requisição AJAX
        elseif (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        $id =  $this->session->userdata('logged_user_id');
        $codigo = $this->session->tempdata('codigo_confirmacao_email');
        $email = $this->session->tempdata('novo_email');

        $response = array();
        $response['status'] = 1;

        $data = $this->input->post();

        if ($data['codigo'] == $codigo) {

            $this->session->unset_tempdata('codigo_confirmacao_email');
            $this->session->unset_tempdata('novo_email');

            $response['novo_email'] = $email;
            $this->funcionario_model->editar($id, array('email' => $email));
        } else {
            $response['status'] = 0;
            $response['error_message'] = 'Código incorreto ou expirado. Se enviou mais de uma vez, utilize o último código e tente novamente.';
        }

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para editar senhas de usuários
     */
    public function updatePassword()
    {
        if ($this->session->permissions_level != 'funcionario' && $this->session->permissions_level != 'admin')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        # Verifica se o método está sendo acessado por uma requisição AJAX
        elseif (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        $id =  $this->session->userdata('logged_user_id');

        # Array de resposta à requisição ajax
        $response = array();
        $response['status'] = 1;

        # Dados recebidos via POST
        $data = $this->input->post();

        # Verifica se a nova senha não é vazia
        if (!empty($data['novaSenha'])) :
            # Verifica se o usuário confirmou a nova senha
            if ($data['novaSenha'] == $data['confirmarNovaSenha']) {

                # Cria o HASH da nova senha
                $novaSenhaHash = password_hash($data['novaSenha'], PASSWORD_DEFAULT);

                $fun = $this->funcionario_model->carregarPorId($id);
                if (password_verify($data['senhaAtual'], $fun->senha))
                    $this->funcionario_model->editar($id, array('senha' => $novaSenhaHash));
                else
                    $response['error_list']['#divInputSenhaAtual'] = 'Senha incorreta.';
            } else
                $response['error_list']['#divInputConfirmarNovaSenha'] = 'As senhas não coincidem.';
        else :
            $response['error_list']['#divInputNovaSenha'] = 'A senha não pode ser vazia.';
        endif;

        # Se houverem erros na lista, altera o status da resposta para 0 (algo deu errado)
        if (!empty($response['error_list']))
            $response['status'] = 0;

        echo json_encode($response);
    }


    /**
     * Função acessada via requisições AJAX para ativar Funcionários
     */
    public function ativar()
    {

        if ($this->session->permissions_level != 'admin')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        # Verifica se o método está sendo acessado por uma requisição AJAX
        elseif (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Funcionário
        $this->load->model('funcionario_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_funcionarios');
        $this->funcionario_model->ativar($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para desativar Funcionários
     */
    public function desativar()
    {
        if ($this->session->permissions_level != 'admin')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        # Verifica se o método está sendo acessado por uma requisição AJAX
        elseif (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Funcionário
        $this->load->model('funcionario_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_funcionarios');
        $this->funcionario_model->desativar($ids);

        echo json_encode($response);
    }
}
