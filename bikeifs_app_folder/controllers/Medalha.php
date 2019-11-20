<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/Tools.php');

class Medalha extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        backup();
        $this->load->library('session');

        $this->load->model('medalha_model');

        # Define o fuso horário do sistema
        date_default_timezone_set('America/Maceio');

        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level']))
            header('location: ' . base_url('home/view/login'));
    }

    /**
     * Função acessada por requisições AJAX para buscar uma medalha a partir do ID da
     *  
     * Retorna um JSON de objetos
     */
    public function select($id = 0)
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $medalha = $this->medalha_model->carregarPorId($id);

        if ($medalha) :
            $response['data'] = $medalha;
        else :
            $response['status'] = 0;
            $response['error_message'] = 'Recompensa não encontrada';
        endif;

        echo json_encode($response);
    }
}
