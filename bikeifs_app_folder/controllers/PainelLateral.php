<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once APPPATH . 'models/SituacaoBicicleta.php';
require_once APPPATH . 'models/ModeloBike.php';
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
        if (null === $id)
            show_404();

        $this->load->model('bicicleta_model');
        $this->load->model('usuario_model');
        
        $bicicleta = $this->bicicleta_model->carregarPorId($id);
        $bicicleta->nome_modelo = ModeloBike::getNomeModelo($bicicleta->modelo);
        $bicicleta->ativa = ($bicicleta->situacao == SituacaoBicicleta::ATIVA);
        $usuario = $this->usuario_model->carregarPorId($bicicleta->id_usuario);
        $bicicleta->dono = $usuario->nome;

        $data = array(
            'bicicleta' => $bicicleta
        );

        $this->load->view("pages/painel-lateral/bicicleta", $data);
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
