<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/Tools.php');
require_once(APPPATH . 'models/ModeloBike.php');
require_once(APPPATH . 'models/SituacaoBicicleta.php');

class Email extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->load->model('email_model');

        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level']))
            header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'admin')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
    }

    /**
     * Função acessada por requisições AJAX para listagem de emails enviados
     * 
     * Retorna um JSON de objetos
     */
    public function select_from_day($timestamp = 'time()')
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Email
        $this->load->model('email_model');
        # Carrega o model Funcionario
        $this->load->model('funcionario_model');
        # Carrega o model Usuario
        $this->load->model('usuario_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $emails = $this->email_model->listarEmailsPorDia($timestamp);
        $emailsFormatados = array();

        $emails = !$emails ? array() : $emails;

        foreach ($emails as $email) {

            # Formata a hora e a data do envio do email
            $email['hora'] = Tools::formatarTimestamp(strtotime($email['hora']));

            ## Salva as informações interessantes sobre o funcionário que enviou o email

            $fun = $this->funcionario_model->carregarPorId($email['id_funcionario']);
            $funcInfo = array(
                'id' => $fun->id,
                'nome' => $fun->nome
            );

            ## Salva as informações interessantes sobre a o usuario

            $user = $this->usuario_model->carregarPorId($email['id_usuario']);
            $userInfo = array(
                'id' => $user->id,
                'nome' => $user->nome
            );

            # Salva as informações formatadas em um array que contém todos os dados pertinentes sobre o registro
            $registro['emails'] = $email;
            $registro['funcionarios'] = $funcInfo;
            $registro['users'] = $userInfo;

            array_push($emailsFormatados, $registro); // adiciona ao array resultado um novo registro (array de objetos)
        }

        $response['data'] = $emailsFormatados;

        echo json_encode($response);
    }
}
