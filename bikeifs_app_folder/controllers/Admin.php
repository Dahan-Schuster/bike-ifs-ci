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
        if ($this->session->userdata['permissions_level'] != 'admin')
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
        if ($this->session->userdata['permissions_level'] != 'admin')
            show_error("<h2><b>Acesso negado.</b></h2>");
        elseif (!$page || !file_exists(APPPATH . "views/pages/admin/$page.php"))
            show_404();

        $data = array(
            'scripts' => array(
                'util.js'
            )
        );

        $this->load->view('templates/header-admin', $data);
        $this->load->view("pages/admin/$page", $data);
        $this->load->view('templates/footer-admin', $data);
    }

    public function listar($page = NULL)
    {
        if ($this->session->userdata['permissions_level'] != 'admin')
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

    /**
     * Destrói a sessão e redireciona para a página inicial
     */
    public function sair()
    {
        $this->session->sess_destroy();
        header('location: ' . base_url('home/login'));
    }
}
