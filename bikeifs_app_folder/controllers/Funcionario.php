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
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'funcionario')
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

    public function view($page = 'home')
    {
        $page_dir = 'pages' . ($page == 'home' ? '' : '/funcionario');

        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
        elseif (!$page || !file_exists(APPPATH . "views/$page_dir/$page.php"))
            show_404();
        elseif ($page == 'perfil')
            header('location: ' . base_url('admin/perfil/'));

        $data = array(
            'scripts' => array(
                'util.js'
            ),
            'nome' => $this->session->userdata('nome')
        );

        $this->load->view('templates/header-funcionario', $data);
        $this->load->view("$page_dir/$page", $data);
        $this->load->view('templates/footer-funcionario', $data);
    }

    public function listar($page = NULL)
    {
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'funcionario')
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

    public function perfil()
    {
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $this->load->model('funcionario_model');
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
}
