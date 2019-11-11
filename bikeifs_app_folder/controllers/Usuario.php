<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/Tools.php');
require_once(APPPATH . 'models/TipoUsuario.php');
require_once(APPPATH . 'models/SituacaoUsuario.php');

class Usuario extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('usuario_model');
    }

    /**
     * Carrega a página inicial do sistema para sessões não logadas
     */
    public function index()
    {
        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'usuario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'util.js'
            ),
            'nome' => $this->session->userdata('nome')
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("pages/home", $data);
        $this->load->view('templates/footer-usuario', $data);
    }

    public function home()
    {

        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'usuario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'util.js'
            ),
            'nome' => $this->session->userdata('nome')
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("pages/home", $data);
        $this->load->view('templates/footer-usuario', $data);
    }

    public function historico()
    {

        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'usuario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'datatables.min.js',
                'dataTables.responsive.min.js',
                'gijgo.min.js',
                'util.js',
                "pages/historico.usuario.js",
            ),
            'styles' => array(
                'datatables.min.css',
                'responsive.dataTables.min.css',
                'gijgo.min.css',
            ),
            'nome' => $this->session->userdata('nome'),
            'id_usuario' => $this->session->logged_user_id
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("pages/usuario/historico", $data);
        $this->load->view('templates/footer-usuario', $data);
    }

    public function bicicletas()
    {

        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'usuario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'datatables.min.js',
                'dataTables.responsive.min.js',
                'gijgo.min.js',
                'snackbar.min.js',
                'util.js',
                'escolher.cores.js',
                "pages/bicicletas.usuario.js",
            ),
            'styles' => array(
                'datatables.min.css',
                'responsive.dataTables.min.css',
                'gijgo.min.css',
                'snackbar.min.css'
            ),
            'nome' => $this->session->userdata('nome'),
            'id_usuario' => $this->session->logged_user_id
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("pages/usuario/bicicletas", $data);
        $this->load->view('templates/footer-usuario', $data);
    }

    public function perfil()
    {
        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'usuario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");


        $usuario = $this->usuario_model->carregarPorId($this->session->userdata['logged_user_id']);
        unset($usuario->senha);

        $data = array(
            'styles' => array(
                'perfil.css',
                'snackbar.min.css'
            ),
            'scripts' => array(
                'pages/perfil-user.js',
                'snackbar.min.js',
                'jquery.mask.min.js',
                'util.js'
            ),
            'nome' => $this->session->userdata('nome'),
            'usuario' => $usuario
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("pages/usuario/perfil", $data);
        $this->load->view('templates/footer-usuario', $data);
    }

    /**
     * Carrega o perfil público de um usuário
     */
    public function select($id = null)
    {
        if (
            $this->session->permissions_level != 'usuario' &&
            $this->session->permissions_level != 'funcionario' &&
            $this->session->permissions_level != 'admin'
        )
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $header = 'header-' . $this->session->permissions_level;
        $footer = 'footer-' . $this->session->permissions_level;


        $usuario = $this->usuario_model->carregarPorId($id);
        unset($usuario->senha);

        $data = array(
            'styles' => array(
                'datatables.min.css',
                'responsive.dataTables.min.css',
                'gijgo.min.css',
                'snackbar.min.css',
                'perfil.css'
            ),
            'scripts' => array(
                'datatables.min.js',
                'dataTables.responsive.min.js',
                'gijgo.min.js',
                'snackbar.min.js',
                'util.js',
                'escolher.cores.js',
                "pages/historico.usuario.js",
                "pages/bicicletas.usuario.js",
                'pages/perfil-publico-user.js'
            ),
            'nome' => $this->session->userdata('nome'),
            'usuario' => $usuario
        );

        $this->load->view("templates/$header", $data);
        $this->load->view("pages/usuario/perfil-publico", $data);
        $this->load->view("templates/$footer", $data);
    }

    /**
     * Função acessada por requisições AJAX para listagem de Usuários
     * 
     * Retorna um JSON de objetos
     */
    public function select_all()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        $usuarios = $this->usuario_model->listarTodos();
        $usuarios = !$usuarios ? array() : $usuarios;

        foreach ($usuarios as $key => $user) :

            $user['tipo'] = TipoUsuario::getNomeTipo($user['tipo']);
            $user['situacao'] = SituacaoUsuario::getTipoSituacao($user['situacao']);

            $user['telefone'] = ($user['perfil_privado'] == 't' ? "Privado" : (!trim($user['telefone']) ? 'Não informado' : $user['telefone']));

            $user['email'] = (!trim($user['email']) ? 'Não informado' : $user['email']);
            $user['cpf'] = ($user['perfil_privado'] == 't' ? "Privado" : $user['cpf']);
            $user['matricula'] = (!trim($user['matricula']) ? "Não informado" : $user['matricula']);

            $usuarios[$key] = $user;

        endforeach;

        $response['data'] = $usuarios;

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para verificar o código de confirmação
     * (salvo temporariamente na sessão após chamar o controlador de Emails) e editar
     * o atributo Email na tabela referente ao tipo de acesso do usuário logado (admin, funcionário, usuário)
     */
    public function updateEmail()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        $this->load->library('session');
        $tipoAcesso = $this->session->userdata('permissions_level');
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

            $this->usuario_model->editar($id, array('email' => $email));
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
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        $this->load->library('session');
        $tipoAcesso = $this->session->userdata('permissions_level');
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

                $user = $this->usuario_model->carregarPorId($id);
                if (password_verify($data['senhaAtual'], $user->senha))
                    $this->usuario_model->editar($id, array('senha' => $novaSenhaHash));
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

    public function updatePrivacy()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $usuario = $this->usuario_model->carregarPorId($this->session->logged_user_id);
        $this->usuario_model->editar(
            $usuario->id,
            array(
                'perfil_privado' => $usuario->perfil_privado == 'f' ? 't' : 'f'
            )
        );

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para ativar Usuários
     */
    public function activate()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Usuario
        $this->load->model('usuario_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_usuarios');
        $this->usuario_model->ativar($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para desativar Usuários
     */
    public function disable()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Carrega o model Usuario
        $this->load->model('usuario_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_usuarios');
        $this->usuario_model->desativar($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para salvar Usuários
     */
    public function insert()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
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
            if (isset($data['telefone']) && $this->usuario_model->estaCadastrado('telefone', $data['telefone'])) :
                $response['error_list']['#divInputTelefone'] = 'Este telefone já está cadastrado.';
            endif;
        }

        if (isset($data['email'])) {
            if (empty($data['email'])) :
                $response['error_list']['#divInputEmail'] = 'O email não pode estar vazio.';
            elseif ($this->usuario_model->estaCadastrado('email', $data['email'])) :
                $response['error_list']['#divInputEmail'] = 'O email informado já foi cadastrado.';
            endif;
        }

        if (isset($data['cpf'])) {
            if (empty($data['cpf'])) :
                $response['error_list']['#divInputCpf'] = 'O CPF não pode estar vazio.';
            elseif (!Tools::isCpfValido($data['cpf'])) :
                $response['error_list']['#divInputCpf'] = 'O CPF informado não é válido.';
            elseif ($this->usuario_model->estaCadastrado('cpf', Tools::formatCnpjCpf($data['cpf']))) :
                $response['error_list']['#divInputCpf'] = 'O CPF informado já foi cadastrado.';
            endif;
        }

        if (isset($data['tipo'])) {
            if (empty($data['tipo'])) :
                $response['error_list']['#divSelectTipo'] = 'O tipo de usuário não pode estar vazio.';
            elseif (
                $data['tipo'] != TipoUsuario::ALUNO &&
                $data['tipo'] != TipoUsuario::SERVIDOR &&
                $data['tipo'] != TipoUsuario::VISITANTE
            ) :
                $response['error_list']['#divSelectTipo'] = 'Tipo de usuário não reconhecido.';
            elseif ($data['tipo'] != TipoUsuario::VISITANTE) :
                if (isset($data['matricula']) && empty($data['matricula'])) :
                    $response['error_list']['#divInputMatricula'] = 'Matrícula requerida para alunos e servidores';
                endif;
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
                $this->usuario_model->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->usuario_model->editar($id, $data);
            endif;
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Destrói a sessão e redireciona para a página inicial
     */
    public function sair()
    {
        $this->session->sess_destroy();
        header('location: ' . base_url('home/view/login'));
    }
}
