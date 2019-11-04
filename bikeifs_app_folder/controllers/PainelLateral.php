<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once APPPATH . 'models/SituacaoFuncionario.php';
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
     * Nada para ver aqui...
     */
    public function index()
    {
        show_404();
    }

    public function usuario($id = null)
    {
        if (null === $id)
            show_404();

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
        if (null === $id)
            show_404();

        $this->load->model('funcionario_model');
        $funcionario = $this->funcionario_model->carregarPorId($id);
        $funcionario->nome_situacao = SituacaoFuncionario::getTipoSituacao($funcionario->situacao);
        $funcionario->ativo = ($funcionario->situacao == SituacaoFuncionario::ATIVO);
        unset($funcionario->senha);

        $data = array(
            'funcionario' => $funcionario
        );

        $this->load->view("pages/painel-lateral/funcionario", $data);
    }
}
