<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/ModeloBike.php');
require_once(APPPATH . 'models/SituacaoBicicleta.php');
require_once(APPPATH . 'models/SituacaoUsuario.php');


class TagRFID extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('tagrfid_model');

        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level'])) header('location: ' . base_url('home/view/login'));
        elseif ($this->session->permissions_level != 'admin' && $this->session->permissions_level != 'funcionario')
            show_error("<h2 style='padding-left: 2rem;'><b>Acesso negado.</b></h2>");
    }


    /**
     * Função acessada por requisições AJAX para listagem de Tags RFID
     * 
     * Retorna um JSON de objetos
     */
    public function select_all()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Bicicleta
        $this->load->model('bicicleta_model');
        # Carrega o model Usuario
        $this->load->model('usuario_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        $tags = $this->tagrfid_model->listarTodos();
        $tagsFormatadas = array();

        $tags = !$tags ? array() : $tags;

        foreach ($tags as $tag) :

            ## Salva as informações interessantes sobre a bike associada à Tag RFID

            $bike = $this->bicicleta_model->carregarPorId($tag["id_bicicleta"]);
            $bikeInfo = array(
                'id' => $bike->id,
                'cores' => $bike->cores,
                'nome_modelo' => ModeloBike::getNomeModelo($bike->modelo),
                'marca' => (!trim($bike->marca) ? 'Não informado' : $bike->marca),
                'aro' => $bike->aro,
                'situacao' => SituacaoBicicleta::getTipoSituacao($bike->situacao),
                'foto_url' => trim($bike->foto_url) && file_exists(getcwd() . $bike->foto_url) ?
                base_url($bike->foto_url) : base_url('public/img/icons/bike-' . strtolower(ModeloBike::getNomeModelo($bike->modelo)) . '-colored.png')
            );

            ## Salva as informações importantes sobre o usuário (dono da bike)

            $user = $this->usuario_model->carregarPorId($bike->id_usuario);
            $userInfo = array(
                'id' => $user->id,
                'nome' => preg_split('/\s/', $user->nome)[0], // Retorna apenas o primeiro nome do usuário
                'situacao' => SituacaoUsuario::getTipoSituacao($user->situacao)
            );

            # salva as informações formatadas no objeto que contém a tag, a bicicleta e seu usuário
            $tagBikeAndUser['tags']  = $tag;            # salva as informações da tag
            $tagBikeAndUser['bikes'] = $bikeInfo;       # salva as informações da bike
            $tagBikeAndUser['users'] = $userInfo;       # salva as informações do usuário

            array_push($tagsFormatadas, $tagBikeAndUser); # adiciona ao array resultado um novo array de objetos
        endforeach;

        $response['data'] = $tagsFormatadas;

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

        # Carrega o model Bicicleta
        $this->load->model('bicicleta_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        $data['codigo'] = strtoupper($data['codigo']);

        if (empty(trim($data['codigo']))) :
            $response['error_list']['#divInputUid'] = 'O código UID não pode estar vazio.';
        else :
            $uidJaCadastrado = $this->tagrfid_model->listarPorCampos(array('codigo' => $data['codigo']));
            if ($uidJaCadastrado) :
                $response['error_list']['#divInputUid'] = 'Código UID já cadastrado.';
            else :
                $tagsDaBike = $this->tagrfid_model->listarPorChaveEstrangeira('id_bicicleta', $data['id_bicicleta']);
                if ($tagsDaBike)
                    $response['error_list']['#divSelectBicicleta'] = 'Já existe um código RFID cadastrado para esta bicicleta.';
            endif;
        endif;

        if (empty($data['id_bicicleta'])) :
            $response['error_list']['#divSelectBicicleta'] = 'Por favor, seleciona a bike que irá receber a Tag.';
        else :
            $bikeExiste = $this->bicicleta_model->carregarPorId($data['id_bicicleta']);
            if (!$bikeExiste)
                $response['error_list']['#divSelectBicicleta'] = 'Bike não cadastrada. Selecione um usuário da lista e então escolha uma entre suas bicicletas.';
        endif;

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            $this->tagrfid_model->inserir($data);
        endif;

        # Retorna o array de resposta à requisição AJAX
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

        $ids = $this->input->post('ids_tags');
        $this->tagrfid->excluir($ids);

        echo json_encode($response);
    }
}
