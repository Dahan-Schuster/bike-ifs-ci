<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');


class Image extends CI_Controller
{

    /** Construtor
     */
    public function __construct()
    {
        parent::__construct();
        backup();
    }

    /**
     * Nada para ver aqui...
     */
    public function index()
    {
        show_404();
    }

    public function upload()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        $config['upload_path'] = './tmp/';
        $config['allowed_types'] = "gif|png|jpg";
        $config['overwrite'] = FALSE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $response = array();
        $response['status'] = 1;

        if (!$this->upload->do_upload("image_file")) :
            $response['status'] = 0;
            $response['error_message'] = $this->upload->display_errors("", "");
        else :
            if ($this->upload->data()['file_size'] <= 1024) :
                $file_name = $this->upload->data()['file_name'];
                $response['img_path'] = base_url("tmp/$file_name");
            else :
                $response['status'] = 0;
                $response['error_message'] = "Arquivo não deve ser maior que 1 MB";
            endif;
        endif;

        echo json_encode($response);
    }
}
