<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/SituacaoUsuario.php');

class Home extends CI_Controller
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

        if ($page == 'login') array_push($data['scripts'], 'login.js');
        elseif ($page == 'esqueciSenha') array_push($data['scripts'], 'esqueciSenha.js');

        $this->load->view('templates/header', $data);
        $this->load->view("pages/$page", $data);
        $this->load->view('templates/footer', $data);
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
    public function ajaxLogin()
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
        $tipoAcesso = $this->input->post('tipoAcesso');


        if (empty($login)) :
            $json['status'] = 0;
            $json['error_message'] = "Usuário não pode ser vazio.";
        else :
            # Chama o método de verificação de dados correspondente para o tipo de acesso selecionado na tela de login
            switch ($tipoAcesso) {
                case 'funcionario':
                    $this->load->model("funcionario");
                    $result = $this->funcionario->verificarLogin($login, $senha);
                    if ($result) $json['location'] = base_url('funcionario');    # Rota para redirecionamento após o login
                    break;
                case 'usuario':
                    $this->load->model("usuario");
                    $result = $this->usuario->verificarLogin($login, $senha);
                    if ($result) $json['location'] = base_url('usuario');
                    break;
                case 'admin':
                    $this->load->model("administrador");
                    $result = $this->administrador->verificarLogin($login, $senha);
                    if ($result) $json['location'] = base_url('admin');
                    break;
                default:
                    $json['status'] = 0;
                    $json['error_message'] = 'Tipo de acesso não reconhecido.';
                    break;
            }

            # Verifica se a pesquisa por login e senha retornou um registro
            if ($result) :
                # Mesmo que os dados de login e senha estejam corretos, é necessário verificar se a conta está desativada
                if (isset($result->situacao) && $result->situacao == SituacaoUsuario::INATIVO) :
                    $json['status'] = 0;
                    $json['error_message'] = 'Prezado usuário, sua conta encontra-se inativa e está impossibilidata de realizar logins. Contate um administrador do sistema para obter ajudar.';

                # Se não estiver...
                else :
                    # ... salva o ID do usuário e o tipo de acesso (nível de permissão) no array de sessão
                    $this->session->set_userdata("logged_user_id", $result->id);
                    $this->session->set_userdata("permissions_level", strtolower($tipoAcesso));
                endif;
            else :
                $json['status'] = 0;
                $json['error_message'] = 'Usuário e/ou senha inválidos!';
            endif;

        endif;

        echo json_encode($json);
    }
}
