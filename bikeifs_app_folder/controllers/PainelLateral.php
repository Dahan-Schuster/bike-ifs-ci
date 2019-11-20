<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once APPPATH . 'models/Tools.php';
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
        backup();
        $this->load->library('session');
    }

    /**
     * Nada para ver aqui...
     */
    public function index()
    {
        show_404();
    }

    public function recompensa($id = null)
    {
        if (null === $id)
            show_404();

        $this->load->model('recompensa_model');
        $recompensa = $this->recompensa_model->carregarPorId($id);
        $recompensa->data_hora = Tools::formatarTimestamp(strtotime($recompensa->data_hora));

        $this->load->model('medalha_model');
        $medalha = $this->medalha_model->carregarPorId($recompensa->id_medalha);

        $data = array(
            'recompensa' => $recompensa,
            'medalha' => $medalha
        );

        $this->load->view("pages/painel-lateral/recompensa", $data);
    }

    public function medalha($id = null)
    {
        if (null === $id)
            show_404();

        $this->load->model('medalha_model');
        $medalha = $this->medalha_model->carregarPorId($id);

        $data = array(
            'medalha' => $medalha
        );

        $this->load->view("pages/painel-lateral/medalha", $data);
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
        $usuario->foto_url = Tools::getUsuarioFoto($usuario->foto_url);
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
        $bicicleta->foto = trim($bicicleta->foto_url) && file_exists(getcwd() . $bicicleta->foto_url) ?
            base_url($bicicleta->foto_url) : base_url('public/img/icons/bike-' . mb_strtolower($bicicleta->nome_modelo) . '-colored.png');

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
        $funcionario->foto_url = Tools::getFuncionarioFoto($funcionario->foto_url);
        unset($funcionario->senha);

        $data = array(
            'funcionario' => $funcionario
        );

        $this->load->view("pages/painel-lateral/funcionario", $data);
    }
}
