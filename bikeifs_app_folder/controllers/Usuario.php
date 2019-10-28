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
            )
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("pages/usuario/bicicletas", $data);
        $this->load->view('templates/footer-usuario', $data);
    }

    public function view($page = 'home')
    {
        $page_dir = 'pages' . ($page == 'home' ? '' : '/usuario');

        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'usuario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        elseif (!$page || !file_exists(APPPATH . "views/$page_dir/$page.php"))
            show_404();

        $data = array(
            'scripts' => array(
                'util.js'
            )
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("$page_dir/$page", $data);
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
