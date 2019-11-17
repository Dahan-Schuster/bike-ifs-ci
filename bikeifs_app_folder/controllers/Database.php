<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');


class Database extends CI_Controller
{

    /** Construtor
     */
    public function __construct()
    {
        parent::__construct();
        backup();
        $this->load->library('session');
        $this->load->library('zip');
    }

    /**
     * Nada para ver aqui...
     */
    public function index()
    {
        show_404();
    }

    public function download()
    {
        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'admin')
            show_404();

        // Verifica qual backup foi escolhido para download
        if ($this->input->post('current') != NULL) {
            backup(true);
        }

        $this->comprimirEBaixarBackup();
    }

    private function comprimirEBaixarBackup()
    {
        $arquivo = 'backup.zip';
        $this->zip->read_file(
            APPPATH . 'core' .
                DIRECTORY_SEPARATOR . 'database' .
                DIRECTORY_SEPARATOR . 'database_backup.backup'
        );
        $this->zip->download($arquivo);
    }
}
