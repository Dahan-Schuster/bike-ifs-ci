<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/SituacaoUsuario.php');
require_once(APPPATH . 'models/Tools.php');

class Home extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        backup();
        $this->load->library('session');
    }

    /**
     * Carrega a página inicial do sistema para sessões não logadas
     */
    public function index()
    {
        $data = array(
            'scripts' => array(
                'util.js',
                'sweetalert2.all.min.js'
            )
        );

        $this->load->view('templates/header', $data);
        $this->load->view("pages/home", $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Carrega uma página enviada por parâmetro
     */
    public function view($page = 'home')
    {
        $data = array(
            'scripts' => array(
                'util.js',
                'sweetalert2.all.min.js'
            )
        );

        if ($page == 'esqueciSenha') {
            array_push($data['scripts'], 'pages/esqueciSenha.js');
        }

        $this->load->view('templates/header', $data);
        $this->load->view("pages/$page", $data);
        $this->load->view('templates/footer', $data);
    }

    /**
     * Carrega uma página enviada por parâmetro
     */
    public function login($tipoAcesso = 'usuario')
    {
        $data = array(
            'scripts' => array(
                'util.js',
                'sweetalert2.all.min.js',
                'parallax.min.js',
                "pages/login.js",
                "pages/login.$tipoAcesso.js"
            )
        );


        $this->load->view('templates/header-login', $data);
        $this->load->view("pages/login-$tipoAcesso", $data);
        $this->load->view('templates/footer-login', $data);
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
     * Confirma os dados de login e indica a URL correspondente
     */
    public function ajaxLoginUsuario()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta à requisição AJAX
        $json = array();
        # status == 0: algo deu errado | status == 1: login realizado com sucesso
        $json['status'] = 1;

        # Recupera os dados enviados via POST
        $login = $this->input->post('login');
        $senha = $this->input->post('senha');


        if (empty($login)) :
            $json['status'] = 0;
            $json['error_message'] = "Usuário não pode ser vazio.";
        else :
            # Chama o método de verificação de dados correspondente para o tipo de acesso selecionado na tela de login
            $this->load->model('usuario_model');
            $usuario = $this->usuario_model->verificarLogin($login, $senha);

            # Verifica se a pesquisa por login e senha retornou um registro
            if ($usuario) :
                # Define a página inicial como o perfil do usuário
                $json['location'] = base_url('usuario/me');

                # Mesmo que os dados de login e senha estejam corretos, é necessário verificar se a conta está desativada
                if ($usuario->situacao == SituacaoUsuario::INATIVO) :
                    $json['status'] = 0;
                    $json['error_message'] = 'Prezado usuário, sua conta encontra-se inativa e está impossibilidata de realizar logins. Contate um administrador do sistema para obter ajudar.';

                # Se não estiver...
                else :
                    # ... salva o nome, o ID do usuário e o tipo de acesso (nível de permissão) no array de sessão
                    $this->session->set_userdata(
                        array(
                            "logged_user_id" => $usuario->id,
                            "nome" => $usuario->nome,
                            "foto_url" => Tools::getUsuarioFoto($usuario->foto_url),
                            "permissions_level" => 'usuario'
                        )
                    );

                endif;
            else :
                $json['status'] = 0;
                $json['error_message'] = 'Usuário e/ou senha inválidos!';
            endif;

        endif;

        echo json_encode($json);
    }

    /**
     * Confirma os dados de login e indica a URL correspondente
     */
    public function ajaxLoginFuncionario()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta à requisição AJAX
        $json = array();
        # status == 0: algo deu errado | status == 1: login realizado com sucesso
        $json['status'] = 1;

        # Recupera os dados enviados via POST
        $login = $this->input->post('login');
        $senha = $this->input->post('senha');


        if (empty($login)) :
            $json['status'] = 0;
            $json['error_message'] = "Email ou CPF não pode estar vazio.";
        else :
            # Chama o método de verificação de dados correspondente para o tipo de acesso selecionado na tela de login
            $this->load->model('funcionario_model');
            $funcionario = $this->funcionario_model->verificarLogin($login, $senha);

            # Verifica se a pesquisa por login e senha retornou um registro
            if ($funcionario) :
                # Define a página inicial como a página de registros
                $json['location'] = base_url('funcionario/listar/registros-do-dia');

                # Mesmo que os dados de login e senha estejam corretos, é necessário verificar se a conta está desativada
                if ($funcionario->situacao == SituacaoUsuario::INATIVO) :
                    $json['status'] = 0;
                    $json['error_message'] = 'Prezado funcionário, sua conta encontra-se inativa e está impossibilidata de realizar logins. Contate um administrador do sistema para obter ajudar.';

                # Se não estiver...
                else :
                    # ... salva o nome, o ID do usuário e o tipo de acesso (nível de permissão) no array de sessão
                    $this->session->set_userdata(
                        array(
                            "logged_user_id" => $funcionario->id,
                            "nome" => $funcionario->nome,
                            "foto_url" => Tools::getUsuarioFoto($funcionario->foto_url),
                            "permissions_level" => 'funcionario'
                        )
                    );

                endif;
            else :
                $json['status'] = 0;
                $json['error_message'] = 'Email/CPF e/ou senha inválidos!';
            endif;

        endif;

        echo json_encode($json);
    }

    /**
     * Confirma os dados de login e indica a URL correspondente
     */
    public function ajaxLoginAdmin()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta à requisição AJAX
        $json = array();
        # status == 0: algo deu errado | status == 1: login realizado com sucesso
        $json['status'] = 1;

        # Recupera os dados enviados via POST
        $login = $this->input->post('login');
        $senha = $this->input->post('senha');


        if (empty($login)) :
            $json['status'] = 0;
            $json['error_message'] = "Email ou CPF não pode estar vazio.";
        else :
            # Chama o método de verificação de dados correspondente para o tipo de acesso selecionado na tela de login
            $this->load->model('administrador_model');
            $admin = $this->administrador_model->verificarLogin($login, $senha);

            # Verifica se a pesquisa por login e senha retornou um registro
            if ($admin) :
                # Define a página inicial como a página de relatórios
                $json['location'] = base_url('admin/view/relatorios');

                # ... salva o nome, o ID do usuário e o tipo de acesso (nível de permissão) no array de sessão
                $this->session->set_userdata(
                    array(
                        "logged_user_id" => $admin->id,
                        "nome" => $admin->nome,
                        "permissions_level" => 'admin'
                    )
                );

            else :
                $json['status'] = 0;
                $json['error_message'] = 'Usuário e/ou senha inválidos!';
            endif;

        endif;

        echo json_encode($json);
    }
}
