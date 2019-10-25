<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/SituacaoUsuario.php');

class Relatorios extends CI_Controller
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
        if (!isset($this->session->userdata['permissions_level'])) show_404();
        elseif ($this->session->userdata['permissions_level'] != 'admin')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");

        $data = array(
            'scripts' => array(
                'util.js',
                'sweetalert2.all.min.js'
            )
        );

        $this->load->view('templates/header', $data);
        $this->load->view("relatorios/", $data);
        $this->load->view('templates/footer', $data);
    }
}
