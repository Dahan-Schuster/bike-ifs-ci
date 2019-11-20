<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/Tools.php');

class Recompensa extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        backup();
        $this->load->library('session');

        $this->load->model('recompensa_model');
        $this->load->model('medalha_model');

        # Define o fuso horário do sistema
        date_default_timezone_set('America/Maceio');

        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level']))
            header('location: ' . base_url('home/view/login'));
    }

    /**
     * Função acessada por requisições AJAX para buscar uma recompensa a partir do ID da
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

        $recompensa = $this->recompensa_model->carregarPorId($id);

        if ($recompensa) :
            $response['data'] = $recompensa;
        else :
            $response['status'] = 0;
            $response['error_message'] = 'Recompensa não encontrada';
        endif;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de
     * recompensas de um usuário específico
     * 
     * Retorna um JSON de objetos
     */
    public function select_from_user()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Usuario
        $this->load->model('usuario_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $medalhas = $this->medalha_model->listarPorCampos(
            array(
                'tipo_usuario' => $this->session->permissions_level
            )
        );

        $medalhas = !$medalhas ? array() : $medalhas;
        $medalhasFormatadas = array();

        foreach ($medalhas as $medalha) :
            
            $recompensa = $this->recompensa_model->listarPorCampos(
                array(
                    'id_medalha' => $medalha['id'],
                    'id_pessoa' => $this->session->logged_user_id,
                    'tipo_usuario' => $this->session->permissions_level
                )
            );

            $medalha['recompensa'] = $recompensa ? $recompensa[0] : false ;
            
            array_push($medalhasFormatadas, $medalha); # adiciona ao array resultado um novo array de objetos
        endforeach;

        $response['data'] = $medalhasFormatadas;

        echo json_encode($response);
    }
}
