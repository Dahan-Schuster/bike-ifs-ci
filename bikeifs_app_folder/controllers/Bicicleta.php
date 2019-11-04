<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/ModeloBike.php');
require_once(APPPATH . 'models/SituacaoBicicleta.php');

class Bicicleta extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->load->model('bicicleta_model');

        if (!isset($this->session->userdata['permissions_level']))
            header('location: ' . base_url('home/view/login'));
    }

    /**
     * Função acessada por requisições AJAX para listagem de
     * bicicletas de um usuário específico
     * 
     * Retorna um JSON de objetos
     */
    public function select_from_user($id_usuario = 0)
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Bicicleta
        $this->load->model('bicicleta_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $bicicletas = $this->bicicleta_model->listarPorChaveEstrangeira('id_usuario', $id_usuario);
        $bicicletas = !$bicicletas ? array() : $bicicletas;
        $bicicletasFormatadas = array();

        foreach ($bicicletas as $bike) :
            # Formata as informações da bicicleta
            $bike['marca'] = (!trim($bike['marca']) ? 'Não informado' : $bike['marca']);
            $bike['obs'] = (!trim($bike['obs']) ? 'Nenhuma observação' : $bike['obs']);
            $bike['nome_modelo'] = ModeloBike::getNomeModelo($bike['modelo']);
            $bike['situacao'] = SituacaoBicicleta::getTipoSituacao($bike['situacao']);

            array_push($bicicletasFormatadas, $bike); # adiciona ao array resultado um novo array de objetos
        endforeach;

        $response['data'] = $bicicletasFormatadas;

        echo json_encode($response);
    }
    
    /**
     * Função acessada por requisições AJAX para buscar uma
     * bicicleta a partir do UID da Tag RFID associada a ela
     * 
     * Retorna um JSON de objetos
     */
    public function select_from_uid($uid = 0)
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Tag RFID
        $this->load->model('tagrfid_model');
        # Carrega o model Bicicleta
        $this->load->model('bicicleta_model');
        # Carrega o model Usuario
        $this->load->model('usuario_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $uid = $this->input->post('uid');

        $tags = $this->tagrfid_model->listarPorCampos(array('codigo' => $uid));

        if ($tags) :
            $tag = $tags[0];
            $bike = $this->bicicleta_model->carregarPorId($tag['id_bicicleta']);
            $user = $this->usuario_model->carregarPorId($bike->id_usuario);

            # salva as informações interessantes sobre a bike
            $bikeInfo = array(
                'id' => $bike->id,
                'cores' => $bike->cores,
                # Recupera o nome referente ao número do modelo
                'modelo' => ModeloBike::getNomeModelo($bike->modelo),
                # Verifica se há marca e formata
                'marca' => (!trim($bike->marca) ? 'Não informado' : $bike->marca),
                'aro' => $bike->aro,
                'situacao' => SituacaoBicicleta::getTipoSituacao($bike->situacao)
            );

            # salva as informações interessantes sobre a o usuario (dono da bike)
            $userInfo = array(
                'id' => $user->id,
                'nome' => preg_split('/\s/', $user->nome)[0],  // Retorna apenas o primeiro nome do usuário
                'matricula' => (!trim($user->matricula) ? "Não informado" : $user->matricula) // Verifica se há matrícula e formata
            );

            $response['data']['bike'] = $bikeInfo;
            $response['data']['user'] = $userInfo;
        else :
            $response['status'] = 0;
            $response['error_message'] = 'Código UID não cadastrado';
        endif;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de bikes
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
        $bicicletas = $this->bicicleta_model->listarTodos();
        $bicicletas = !$bicicletas ? array() : $bicicletas;
        $bicicletasFormatadas = array();

        foreach ($bicicletas as $bike) :
            ## Salva as informações interessantes sobre o usuário em um array

            $user = $this->usuario_model->carregarPorId($bike["id_usuario"]);
            $userInfo = array(
                'id' => $user->id,
                'nome' => $user->nome
            );

            # Formata as informações da bicicleta
            $bike['marca'] = (!trim($bike['marca']) ? 'Não informado' : $bike['marca']);
            $bike['obs'] = (!trim($bike['obs']) ? 'Nenhuma observação' : $bike['obs']);
            $bike['nome_modelo'] = ModeloBike::getNomeModelo($bike['modelo']);
            $bike['situacao'] = SituacaoBicicleta::getTipoSituacao($bike['situacao']);

            $bikeAndUser['bikes'] = $bike;      # salva as informações da bike no objeto que contém a bicicleta e seu usuário
            $bikeAndUser['users'] = $userInfo;  # salva as informações do usuário no objeto que contém a bicicleta e seu usuário

            array_push($bicicletasFormatadas, $bikeAndUser); # adiciona ao array resultado um novo array de objetos
        endforeach;

        $response['data'] = $bicicletasFormatadas;

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para salvar Bicicletas
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

        if (empty($data['cores'])) :
            $response['error_list']['#divInputCores'] = 'A cor da bike é obrigatória';
        endif;

        if (empty($data['modelo'])) :
            $response['error_list']['#divSelectModelo'] = 'Selecione um modelo para a bike.';
        elseif (
            $data['modelo'] != ModeloBike::URBANA &&
            $data['modelo'] != ModeloBike::DOBRAVEL &&
            $data['modelo'] != ModeloBike::FIXA &&
            $data['modelo'] != ModeloBike::MOUNTAIN &&
            $data['modelo'] != ModeloBike::SPEED &&
            $data['modelo'] != ModeloBike::BMX &&
            $data['modelo'] != ModeloBike::DOWNHILL &&
            $data['modelo'] != ModeloBike::ELETRICA
        ) :
            $response['error_list']['#divSelectModelo'] = 'Modelo não reconhecido.';

        endif;

        if (empty($data['aro'])) :
            $response['error_list']['#divInputAro'] = 'Por favor, informe o aro da bike.';
        endif;

        if (isset($data['id_usuario'])) {
            if (empty($data['id_usuario'])) :
                $response['error_list']['#divSelectUsuario'] = 'Por favor, informe o dono da bike.';
            else :
                $this->load->model('usuario_model');
                $usuarioExiste = $this->usuario_model->carregarPorId($data['id_usuario']);
                if (!$usuarioExiste)
                    $response['error_list']['#divSelectUsuario'] = 'Usuário não cadastrado. Selecione um usuário da lista.';
            endif;
        } else {
            $data['id_usuario'] = $this->session->logged_user_id;
        }

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            # Verifica se um ID foi passado por parâmetro (em caso de edição)
            if (empty($data['id'])) :   # Se não, insere um novo registro
                unset($data['id']);
                $this->bicicleta_model->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->bicicleta_model->editar($id, $data);
            endif;
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para ativar Bicicletas
     */
    public function ativar()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_bicicletas');
        $this->bicicleta_model->ativar($ids);

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para desativar Bicicletas
     */
    public function desativar()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Dados enviados via POST
        $ids = $this->input->post('ids_bicicletas');
        $this->bicicleta_model->desativar($ids);

        echo json_encode($response);
    }

    public function gerarOpcoesDeBikesPorUsuario()
    {
        $id_usuario = $this->input->post('id_usuario');

        # Carrega o model Bicicleta
        $this->load->model('bicicleta_model');

        if (!empty($id_usuario)) {
            // Carregar os dados referentes ao usuário selecionado
            $foreingKey = 'id_usuario';
            $bicicletas = $this->bicicleta_model->listarPorChaveEstrangeira($foreingKey, $id_usuario);

            // Gera um HTML de acordo com o resultado da query
            if (sizeof($bicicletas) > 0) {
                echo '<option value="">Selecione uma bicicleta</option>';
                foreach ($bicicletas as $bike) {
                    $bike['marca'] = (!trim($bike['marca']) ? "Marca não informada" : $bike['marca']);
                    echo '<option value="' . $bike['id'] . '" data-color="' . $bike['cores'] . '">' .
                        ModeloBike::getNomeModelo($bike['modelo']) . ', ' .
                        $bike['marca'] . ', ' . $bike['aro'] .
                        '</option>';
                }
            } else
                echo '<option value="">Nenhuma bicicleta cadastrada.</option>';
        }
    }
}
