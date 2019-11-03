<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

class Usuario extends CI_Controller
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
            'nome' => $this->session->userdata('nome')
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("pages/usuario/historico", $data);
        $this->load->view('templates/footer-usuario', $data);
    }

    public function bicicletas()
    {

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
            'nome' => $this->session->userdata('nome')
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("pages/usuario/bicicletas", $data);
        $this->load->view('templates/footer-usuario', $data);
    }

    public function perfil()
    {
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'usuario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $this->load->model('usuario_model');
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
     * Destrói a sessão e redireciona para a página inicial
     */
    public function sair()
    {
        $this->session->sess_destroy();
        header('location: ' . base_url('home/view/login'));
    }
}
