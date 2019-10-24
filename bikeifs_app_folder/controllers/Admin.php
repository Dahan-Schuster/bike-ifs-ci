<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

class Admin extends CI_Controller
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
        if (!isset($this->session->userdata['permissions_level'])) show_404();
        elseif ($this->session->userdata['permissions_level'] != 'admin')
            show_error("<h2><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'util.js'
            )
        );

        $this->load->view('templates/header-admin', $data);
        $this->load->view("pages/admin/restrita", $data);
        $this->load->view('templates/footer-admin', $data);
    }

    public function view($page = 'restrita')
    {
        $page_dir = 'pages' . ($page == 'home' ? '' : '/admin');

        if (!isset($this->session->userdata['permissions_level'])) show_404();
        elseif ($this->session->userdata['permissions_level'] != 'admin')
            show_error("<h2><b>Acesso negado.</b></h2>");
        elseif (!$page || !file_exists(APPPATH . "views/$page_dir/$page.php"))
            show_404();
        elseif ($page == 'perfil')
            header('location: ' . base_url('admin/perfil/') . $this->session->userdata['user_id']);

        $data = array(
            'scripts' => array(
                'util.js',
                'sweetalert2.all.min.js'
            )
        );

        $this->load->view('templates/header-admin', $data);
        $this->load->view("$page_dir/$page", $data);
        $this->load->view('templates/footer-admin', $data);
    }

    public function listar($page = NULL)
    {
        if (!isset($this->session->userdata['permissions_level'])) show_404();
        elseif ($this->session->userdata['permissions_level'] != 'admin')
            show_error("<h2><b>Acesso negado.</b></h2>");
        elseif (!$page || !file_exists(APPPATH . "views/pages/listar/$page.php"))
            show_404();

        $data = array(
            'scripts' => array(
                'util.js'
            )
        );

        $this->load->view('templates/header-admin', $data);
        $this->load->view("pages/listar/$page", $data);
        $this->load->view('templates/footer-admin', $data);
    }

    public function excluir($page = NULL)
    {
        if (!isset($this->session->userdata['permissions_level'])) show_404();
        elseif ($this->session->userdata['permissions_level'] != 'admin')
            show_error("<h2><b>Acesso negado.</b></h2>");
        elseif (!$page || !file_exists(APPPATH . "views/pages/excluir/$page.php"))
            show_404();

        $data = array(
            'scripts' => array(
                'util.js'
            )
        );

        $this->load->view('templates/header-admin', $data);
        $this->load->view("pages/excluir/$page", $data);
        $this->load->view('templates/footer-admin', $data);

    }

    public function perfil()
    {
        if (!isset($this->session->userdata['permissions_level'])) show_404();
        elseif ($this->session->userdata['permissions_level'] != 'admin')
            show_error("<h2><b>Acesso negado.</b></h2>");

        $this->load->model('administrador');
        $admin = $this->administrador->carregarPorId($this->session->userdata['logged_user_id']);

        $data = array(
            'styles' => array(
                'perfil.css'
            ),
            'scripts' => array(
                'perfil-adm.js',
                'util.js'
            ),
            'admin' => $admin
        );

        $this->load->view('templates/header-admin', $data);
        $this->load->view("pages/admin/perfil", $data);
        $this->load->view('templates/footer-admin', $data);
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
