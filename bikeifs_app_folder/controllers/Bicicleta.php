<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/Tools.php');
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
        backup();
        $this->load->library('session');

        $this->load->model('bicicleta_model');

        # Define o fuso horário do sistema
        date_default_timezone_set('America/Maceio');

        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
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
            $bike['verificada'] = $bike['verificada'] == 't' ? true : false;
            $bike['foto_url'] = Tools::getBikeFoto($bike);


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

        $uid = Tools::formatarUid($uid);

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
                'foto_url' => Tools::getBikeFoto(json_decode(json_encode($bike), true))
            );

            # salva as informações interessantes sobre a o usuario (dono da bike)
            $userInfo = array(
                'nome' => preg_split('/\s/', $user->nome)[0],  // Retorna apenas o primeiro nome do usuário
                'matricula' => (!trim($user->matricula) ? "Não informado" : $user->matricula), // Verifica se há matrícula e formata
                'cpf' => ($user->perfil_privado == 't' ? "Privado" : $user->cpf),
                'foto_url' => Tools::getUsuarioFoto($user->foto_url)
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
            $bike['verificada'] = $bike['verificada'] == 't' ? true : false;
            $bike['foto_url'] = Tools::getBikeFoto($bike);

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
        } elseif ($this->session->permissions_level == 'usuario') {
            $data['id_usuario'] = $this->session->logged_user_id;
        }

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :

            # Verifica se deve salvar uma foto para a bike
            if (!empty($data['foto_url'])) :
                $arquivo = basename($data['foto_url']);
                $url_antiga = getcwd() . '/tmp/' . $arquivo;
                $nova_url = getcwd() . '/public/img/bikes/' . $arquivo;

                rename($url_antiga, $nova_url);
                $data['foto_url'] = '/public/img/bikes/' . $arquivo;
            else :
                unset($data['foto_url']); # Previne que salve uma foto vazia no banco de dados
            endif;

            # Verifica se a bike foi salva por um funcionário e, portanto, já se encontra verificada
            if ($this->session->permissions_level == 'funcionario')
                $data['verificada'] = 't'; // true
            else
                $data['verificada'] = 'f'; // false

            # Verifica se um ID foi passado por parâmetro (em caso de edição)
            if (empty($data['id'])) :   # Se não, insere um novo registro
                unset($data['id']);
                $id_bicicleta = $this->bicicleta_model->inserir($data);
            else :                      # Se sim, edita o registro referente ao ID
                $id_bicicleta = $data['id'];      # Armazena o ID em uma variável ...
                unset($data['id']);     # ... e remove o ID da lista de campos para editar
                $this->bicicleta_model->editar($id_bicicleta, $data);
            endif;

            # Se a bike não estiver verificada, cria uma nova requisição de verificação
            if ($data['verificada'] == 'f') {
                $this->load->model('requisicao_model');
                $this->requisicao_model->apagarRequisicoesEmAberto($id_bicicleta);
                $this->requisicao_model->inserir(
                    array(
                        'atendida' => 'f',
                        'data_hora' => date('Y-m-d H:i:s'),
                        'id_bicicleta' => $id_bicicleta
                    )
                );
            } else {
                $this->verificarRecompensaUsuario($data['id_usuario']);
            }
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para verificar Bicicletas
     */
    public function verificar()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $this->load->model('usuario_model');

        # Verifica se o usuário logado pode verificar bicicletas (apenas funcionários podem)
        if ($this->session->permissions_level == 'funcionario') {
            # Dados enviados via POST
            $id_bicicleta = $this->input->post('id_bicicleta');
            $this->bicicleta_model->verificar($id_bicicleta, $this->session->logged_user_id);

            $bike = $this->bicicleta_model->carregarPorId($id_bicicleta);
            $this->verificarRecompensaUsuario($bike->id_usuario);
        } else {
            $response['status'] = 0;
            $response['error_message'] = 'Você não possui permissão para verificar bicicletas.';
        }

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
                    $foto_url = Tools::getBikeFoto($bike);
                    $bike['marca'] = (!trim($bike['marca']) ? "Marca não informada" : $bike['marca']);
                    echo '<option 
                            value="' . $bike['id'] . '" ' .
                        'data-imagesrc="' . $foto_url . '">' .
                        ModeloBike::getNomeModelo($bike['modelo']) . ', ' .
                        $bike['marca'] . ', ' . $bike['aro'] .
                        '</option>';
                }
            } else
                echo '<option value="">Nenhuma bicicleta cadastrada.</option>';
        }
    }

    private function recompensarUsuario($id_usuario, $medalha)
    {
        # Carrega o model Recompensa
        $this->load->model('recompensa_model');
        $dados = array(
            'tipo_usuario' => 'usuario',
            'id_pessoa' => $id_usuario,
            'id_medalha' => $medalha['id'],
            'data_hora' =>  date('Y-m-d H:i:s')
        );
        $this->recompensa_model->inserir($dados);
    }

    /**
     * Confere se o usuário que cadastrou uma bike e/ou teve sua bike verificada recebeu alguma medalha
     */
    private function verificarRecompensaUsuario($id_usuario)
    {

        # Carrega o model Usuário
        $this->load->model('usuario_model');
        # Carrega o model Medalha
        $this->load->model('medalha_model');

        // Quanta a quantidade de bikes verificadas do usuário
        $quantidadeBikes = $this->bicicleta_model->getTotalDeBikesVerificadas($id_usuario);

        // Confere se bate com alguma medalha
        $medalhas = $this->medalha_model->listarPorCampos(
            array(
                'tipo_usuario' => 'usuario',
                'tipo_objetivo' => 'quantidade_bikes',
                'objetivo' => $quantidadeBikes
            )
        );

        // Se sim, irá cadastrar uma recompensa para o usuário
        if ($medalhas) {
            $medalha = $medalhas[0];
            $this->recompensarUsuario($id_usuario, $medalha);
            return $medalha;
        } else return false;
    }
}
