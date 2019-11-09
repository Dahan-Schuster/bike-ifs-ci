<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

class Admin extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('administrador_model');

        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->userdata['permissions_level'] != 'admin')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
    }

    /**
     * Carrega a o perfil do admin logado
     */
    public function index()
    {
        $admin = $this->administrador_model->carregarPorId($this->session->logged_user_id);
        unset($admin->senha);

        $data = array(
            'styles' => array(
                'perfil.css',
                'snackbar.min.css'
            ),
            'scripts' => array(
                'pages/perfil-adm.js',
                'snackbar.min.js',
                'util.js'
            ),
            'nome' => $this->session->userdata('nome'),
            'admin' => $admin
        );

        $this->load->view('templates/header-admin', $data);
        $this->load->view("pages/admin/perfil", $data);
        $this->load->view('templates/footer-admin', $data);
    }


    public function view($page = 'home')
    {
        if ($page == 'relatorios') {
            $data = array(
                'scripts' => array(
                    'chart.min.js',
                    'chartjs-plugin-datalabels.min.js',
                    'jspdf.min.js',
                    'pages/relatorios.js',
                    'util.js'
                ),
                'styles' => array(
                    'chart.min.css'
                )
            );

            $page_dir = 'pages/admin';
        } elseif ($page == 'excluir-registros') {
            $data = array(
                'scripts' => array(
                    'datatables.min.js',
                    'dataTables.responsive.min.js',
                    'jquery.mask.min.js',
                    'snackbar.min.js',
                    'gijgo.min.js',
                    'util.js',
                    'pages/excluir.registros.js'
                ),
                'styles' => array(
                    'datatables.min.css',
                    'responsive.dataTables.min.css',
                    'gijgo.min.css',
                    'snackbar.min.css'
                )
            );

            $page = 'registros';
            $page_dir = "pages/excluir/";
        } else {
            $page = 'home';
            $page_dir = 'pages/';
            $data = array(
                'scripts' => array(
                    'util.js'
                )
            );
        }

        $data['nome'] = $this->session->userdata('nome');

        if (!$page || !file_exists(APPPATH . "views/$page_dir/$page.php"))
            show_404();

        $this->load->view('templates/header-admin', $data);
        $this->load->view("$page_dir/$page", $data);
        $this->load->view('templates/footer-admin', $data);
    }

    public function listar($page = NULL)
    {

        if (!$page || !file_exists(APPPATH . "views/pages/listar/$page.php"))
            show_404();

        $data = array(
            'scripts' => array(
                'datatables.min.js',
                'dataTables.responsive.min.js',
                'jquery.mask.min.js',
                'snackbar.min.js',
                'util.js',
                'gijgo.min.js',
                "pages/$page.js"
            ),
            'styles' => array(
                'datatables.min.css',
                'responsive.dataTables.min.css',
                'gijgo.min.css',
                'snackbar.min.css'
            ),
            'nome' => $this->session->userdata('nome')
        );

        if ($page == 'bicicletas' || $page == 'tags' || $page == 'registros-do-dia') {
            array_push($data['scripts'], 'pesquisar.usuario.js');

            if ($page == 'bicicletas') :
                array_push($data['scripts'], 'escolher.cores.js');

            else :
                array_push($data['scripts'], 'ler.tag.js');

                if ($page == 'registros-do-dia') :
                    $data['pode_registrar'] = FALSE;
                endif;
            endif;
        }

        $this->load->view('templates/header-admin', $data);
        $this->load->view("pages/listar/$page", $data);
        $this->load->view('templates/footer-admin', $data);
    }

    /**
     * Destrói a sessão e redireciona para a página inicial
     */
    public function sair()
    {
        $this->session->sess_destroy();
        header('location: ' . base_url('home/view/login'));
    }

    /**
     * Função acessada por requisições AJAX para listagem de Administradores
     * 
     * Retorna um JSON de objetos
     */
    public function select_all()
    {
        if (!$this->input->is_ajax_request())
            header('location: ' . base_url('admin/me'));

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        $admins = $this->administrador_model->listarTodos();

        $admins = !$admins ? array() : $admins;

        $response['data'] = $admins;

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para salvar Administradores
     */
    public function insert()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");


        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        if (isset($data['nome'])) {
            if (empty(trim($data['nome']))) :
                $response['error_list']['#divInputNome'] = 'O nome não pode estar vazio.';
            endif;
        }

        if (isset($data['email'])) {
            if (empty($data['email'])) :
                $response['error_list']['#divInputEmail'] = 'O email não pode estar vazio.';
            elseif ($this->administrador_model->estaCadastrado('email', $data['email'])) :
                $response['error_list']['#divInputEmail'] = 'O email informado já foi cadastrado.';
            endif;
        }

        if (isset($data['cpf'])) {
            if (empty($data['cpf'])) :
                $response['error_list']['#divInputCpf'] = 'O CPF não pode estar vazio.';
            elseif (!Tools::isCpfValido($data['cpf'])) :
                $response['error_list']['#divInputCpf'] = 'O CPF informado não é válido.';
            elseif ($this->administrador_model->estaCadastrado('cpf', Tools::formatCnpjCpf($data['cpf']))) :
                $response['error_list']['#divInputCpf'] = 'O CPF informado já foi cadastrado.';
            endif;
        }

        if (isset($data['senha'])) {
            if (empty($data['senha'])) :
                $response['error_list']['#divInputSenha'] = 'A senha é obrigatória.';
            else :
                if (strval($data['senha']) != strval($data['confirmar_senha'])) :
                    $response['error_list']['#divInputConfirmarSenha'] = 'As senhas não coincidem.';
                else :
                    $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);
                    unset($data['confirmar_senha']);
                endif;
            endif;
        }

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            # Verifica se um ID foi passado por parâmetro (em caso de edição)
            if (empty($data['id'])) :   # Se não, insere um novo registro
                unset($data['id']);
                $this->administrador_model->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->administrador_model->editar($id, $data);
            endif;
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para editar senhas de usuários
     */
    public function updatePassword()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        $id =  $this->session->userdata('logged_user_id');

        # Array de resposta à requisição ajax
        $response = array();
        $response['status'] = 1;

        # Dados recebidos via POST
        $data = $this->input->post();

        # Verifica se a nova senha não é vazia
        if (!empty($data['novaSenha'])) :
            # Verifica se o usuário confirmou a nova senha
            if ($data['novaSenha'] == $data['confirmarNovaSenha']) {

                # Cria o HASH da nova senha
                $novaSenhaHash = password_hash($data['novaSenha'], PASSWORD_DEFAULT);

                $admin = $this->administrador_model->carregarPorId($id);
                # Verifica se a senha atual inserida está correta
                if (password_verify($data['senhaAtual'], $admin->senha))
                    # Se estiver, edita a senha
                    $this->administrador_model->editar($id, array('senha' => $novaSenhaHash));
                else    # Se não, informa o erro
                    $response['error_list']['#divInputSenhaAtual'] = 'Senha incorreta.';
            } else
                $response['error_list']['#divInputConfirmarNovaSenha'] = 'As senhas não coincidem.';
        else :
            $response['error_list']['#divInputNovaSenha'] = 'A senha não pode ser vazia.';
        endif;

        # Se houverem erros na lista, altera o status da resposta para 0 (algo deu errado)
        if (!empty($response['error_list']))
            $response['status'] = 0;

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para verificar o código de confirmação
     * (salvo temporariamente na sessão após chamar o controlador de Emails) e editar
     * o atributo Email na tabela referente ao tipo de acesso do usuário logado (admin, funcionário, usuário)
     */
    public function updateEmail()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        $id =  $this->session->userdata('logged_user_id');
        $codigo = $this->session->tempdata('codigo_confirmacao_email');
        $email = $this->session->tempdata('novo_email');

        $response = array();
        $response['status'] = 1;

        $data = $this->input->post();

        if ($data['codigo'] == $codigo) {

            $this->session->unset_tempdata('codigo_confirmacao_email');
            $this->session->unset_tempdata('novo_email');

            $response['novo_email'] = $email;
            $this->administrador_model->editar($id, array('email' => $email));
        } else {
            $response['status'] = 0;
            $response['error_message'] = 'Código incorreto ou expirado. Se enviou mais de uma vez, utilize o último código e tente novamente.';
        }

        echo json_encode($response);
    }


    /**
     * Função acessada via requisições AJAX para deleção de Administradores
     */
    public function delete()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $senha = $this->input->post('senha');
        $admin = $this->administrador_model->carregarPorId($this->session->userdata('logged_user_id'));

        // Verifica se deve excluir os admins com IDs enviados via post ou o admin logado
        $ids = null !== $this->input->post('ids_admins') ? $this->input->post('ids_admins') : array($admin->id);

        if (password_verify($senha, $admin->senha)) {
            $this->administrador_model->excluir($ids);
            foreach ($ids as $id)
                if ($id == $admin->id)
                    $response['status'] = -1;
        } else {
            $response['status'] = 0;
            $response['error_list']['#divInputSenhaExcluir'] = 'Senha incorreta.';
        }

        echo json_encode($response);
    }
}
