<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/SituacaoUsuario.php');

class Relatorio extends CI_Controller
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
     * Carrega a página inicial do sistema para sessões não logadas
     */
    public function index()
    {
        show_404();
    }


    /**
     * Função acessada via requisiçãoes AJAX para geração de relatórios
     */
    public function ajaxContarTiposDeUsuarios()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        $this->load->model('usuario_model');

        $dados = $this->usuario_model->contarTipos();

        echo json_encode($dados);
    }

    /**
     * Função acessada via requisiçãoes AJAX para geração de relatórios
     */
    public function ajaxContarModelosDeBikes()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        $this->load->model('bicicleta_model');

        $dados = $this->bicicleta_model->contarModelos();

        echo json_encode($dados);
    }

    /**
     * Função acessada via requisiçãoes AJAX para geração de relatórios
     */
    public function ajaxContarBikesComRFID()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        $this->load->model('bicicleta_model');
        $this->load->model('tagrfid_model');

        $response['com'] = $this->tagrfid_model->getTotalDeLinhas();
        $response['sem'] = $this->bicicleta_model->getTotalDeLinhas() - $response['com'];

        echo json_encode($response);
    }


    /**
     * Função acessada via requisiçãoes AJAX para geração de relatórios
     */
    public function ajaxContarRegistrosPorDia()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        $this->load->model('registro_model');

        $response = $this->registro_model->contarRegistrosDosUltimos14Dias();

        echo json_encode($response);
    }

    /**
     * Função acessada via requisiçãoes AJAX para geração de relatórios
     */
    public function ajaxContarRegistrosPorMes()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        $this->load->model('registro_model');

        $response = $this->registro_model->contarRegistrosDosUltimos12Meses();

        echo json_encode($response);
    }

    /**
     * Função acessada via requisiçãoes AJAX para geração de relatórios
     */
    public function ajaxContarRegistrosPorSemana()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        $this->load->model('registro_model');

        $response = $this->registro_model->contarRegistrosDasUltimas8Semanas();

        echo json_encode($response);
    }
}
