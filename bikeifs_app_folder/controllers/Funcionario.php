<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

class Funcionario extends CI_Controller
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
        elseif ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'util.js'
            )
        );

        $this->load->view('templates/header', $data);
        $this->load->view("pages/view/registros-do-dia", $data);
        $this->load->view('templates/footer', $data);
    }

    public function view($page = 'restrita')
    {
        $page_dir = 'pages' . ($page == 'home' ? '' : '/funcionario');

        if (!isset($this->session->userdata['permissions_level'])) show_404();
        elseif ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2><b>Acesso negado.</b></h2>");
        elseif (!$page || !file_exists(APPPATH . "views/$page_dir/$page.php"))
            show_404();

        $data = array(
            'scripts' => array(
                'util.js'
            )
        );

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("$page_dir/$page", $data);
        $this->load->view('templates/footer-funcionario', $data);
    }

    public function listar($page = NULL)
    {
        if ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2><b>Acesso negado.</b></h2>");
        elseif (!$page || !file_exists(APPPATH . "views/pages/listar/$page.php"))
            show_404();

        $data = array(
            'scripts' => array(
                'util.js'
            )
        );

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("pages/listar/$page", $data);
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
}
