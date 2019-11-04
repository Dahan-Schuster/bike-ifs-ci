<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once APPPATH . 'models/SituacaoUsuario.php';
require_once APPPATH . 'models/TipoUsuario.php';

class PainelLateral extends CI_Controller
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
                'util.js'
            ),
            'nome' => $this->session->userdata('nome')
        );

        $this->load->view('templates/header-usuario', $data);
        $this->load->view("pages/home", $data);
        $this->load->view('templates/footer-usuario', $data);
    }

    public function usuario($id = null)
    {
        if (null === $id)
            header('location: ' . base_url('painelLateral'));

        $this->load->model('usuario_model');
        $usuario = $this->usuario_model->carregarPorId($id);
        $usuario->nome_tipo = TipoUsuario::getNomeTipo($usuario->tipo);
        $usuario->nome_situacao = SituacaoUsuario::getTipoSituacao($usuario->situacao);
        $usuario->ativo = ($usuario->situacao == SituacaoUsuario::ATIVO);
        unset($usuario->senha);

        $data = array(
            'usuario' => $usuario
        );

        $this->load->view("pages/painel-lateral/usuario", $data);
    }

    public function bicicleta($id = null)
    {
        
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

    public function funcionario($id = null)
    {

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
}
