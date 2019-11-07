<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/Tools.php');
require_once(APPPATH . 'models/ModeloBike.php');
require_once(APPPATH . 'models/SituacaoBicicleta.php');
require_once(APPPATH . 'models/SituacaoUsuario.php');

class Registro extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->load->model('registro_model');
        $this->load->model('saida_model');
        
        # Define o fuso horário do sistema
        date_default_timezone_set('America/Maceio');

        if (!isset($this->session->userdata['permissions_level']))
            header('location: ' . base_url('home/view/login'));
    }

    /**
     * Função acessada via requisições AJAX para salvar Registros de entrada
     */
    public function insert()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request()) :
            exit("Não é permitido acesso direto aos scripts.");
        elseif ($this->session->userdata['permissions_level'] != 'funcionario') :
            echo json_encode(
                array(
                    'status' => -1,
                    'error_message' => 'Apenas funcionários possuem permissão para realizar checkins.'
                )
            );
            exit();
        endif;

        # Carrega o model Bicicleta
        $this->load->model('bicicleta_model');
        # Carrega o model Usuário
        $this->load->model('usuario_model');

        # Array de resposta
        $response = array();
        # status == -2: bike/dono inativos (retorna objetos para edição rápida)
        # status == -1: mensagem de erro
        # status == 1: tudo certo
        # status == 0: lista de erros
        $response['status'] = 1;
        # Array de listagem dos erros
        $response['error_list'] = array();

        # Dados enviados via POST
        $data = $this->input->post();

        ## Validação dos dados enviados

        if (empty($data['num_trava'])) :
            $data['num_trava'] = 0;
        elseif ($data['num_trava'] != 0) :
            if ($this->registro_model->verificarSeCadeadoEstaEmUso($data['num_trava']))
                $response['error_list']['#divInputNumTrava'] = 'Um usuário está utilizando esta trava no momento. Tente utilizar outra.';
        endif;

        if (empty($data['id_bicicleta'])) :
            $response['error_list']['#divSelectBicicleta'] = 'Por favor, seleciona a bike que irá receber a Tag.';
        else :
            $bike = $this->bicicleta_model->carregarPorId($data['id_bicicleta']);
            $user = $this->usuario_model->carregarPorId($bike->id_usuario);
            if (!$bike) :
                $response['error_list']['#divSelectBicicleta'] = 'Bike não cadastrada. Selecione um usuário da lista e então escolha uma entre suas bicicletas.';
            elseif ($bike->situacao == SituacaoBicicleta::INATIVA || $user->situacao == SituacaoUsuario::INATIVO) : // TODO: Bike verificada/não verificada
                $response['objetos']['bicicleta'] = $bike;
                $response['objetos']['usuario'] = $user;
            elseif ($this->registro_model->listarRegistrosEmAberto($data['id_bicicleta'])) :
                $response['status'] = -1;
                $response['error_message'] =
                    'Existem registros de entrada em aberto para esta bicicleta. ' .
                    'Confira se selecionou a bicicleta correta e, caso positivo, ' .
                    'se foi realizado o registro de saída da mesma.';
            endif;
        endif;



        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        elseif (!empty($response['objetos'])) :
            $response['status'] = -2;
        elseif ($response['status'] != -1) :
            $data['data_hora'] = date('Y-m-d H:i:s');
            $data['id_funcionario'] = $this->session->userdata['logged_user_id'];
            $this->registro_model->inserir($data);
        endif;

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para realizar checkouts dos registros de entrada
     */
    public function checkout()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request()) :
            exit("Não é permitido acesso direto aos scripts.");
        elseif ($this->session->userdata['permissions_level'] != 'funcionario') :
            echo json_encode(
                array(
                    'status' => -1,
                    'error_message' => 'Apenas funcionários possuem permissão para realizar checkouts.'
                )
            );
            exit();
        endif;

        $response = array();
        $response['status'] = 1;

        # Dados enviados via POST
        $data = $this->input->post();
        $response['id_registro'] = $data['id_registro'];

        # Recupera a hora atual
        $checkoutData['data_hora'] = date('Y-m-d H:i:s');
        # Recupera o ID do funcionário logado
        $checkoutData['id_funcionario'] = $this->session->userdata['logged_user_id'];
        # Recupera as observações enviadas via POST
        $checkoutData['obs'] = $data['obs'];

        # Registra uma saída...
        $response['id_saida'] = $this->saida_model->inserir($checkoutData);
        # ... e a associa ao registro de entrada que possui o ID recebido via POST 
        $this->registro_model->editar($data['id_registro'], array('id_saida' => $response['id_saida']));

        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para deleção de registros de entrada/saída
     */
    public function undo_checkout()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");


        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $data = $this->input->post();

        # Remove o ID da saída da tabela Registro
        $this->registro_model->editar($data['id_registro'], array('id_saida' => NULL));

        # Deleta a saída
        $this->saida_model->excluir(array($data['id_saida']));

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de 
     * registros de entrada e saída de um dia específico
     * 
     * Retorna um JSON de objetos
     */
    public function select_from_day($timestamp = 'time()', $from_logged_user = false, $user_id = null)
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;


        $foreingKey = NULL;
        $foreingKeyValue = NULL;

        if ($from_logged_user == 'true') {
            if ($this->session->userdata('permissions_level') == 'funcionario') {
                $foreingKey = 'id_funcionario';
            } elseif ($this->session->userdata('permissions_level') == 'usuario') {
                $foreingKey = 'id_usuario';
            }

            $foreingKeyValue = $this->session->userdata('logged_user_id');
        } elseif ($user_id) {
            $foreingKey = 'id_usuario';
            $foreingKeyValue = $user_id;
        }

        $registros = $this->registro_model->listarRegistrosPorDia($timestamp, $foreingKey, $foreingKeyValue);
        $registrosFormatados = $this->formatarRegistros($registros);

        $response['data'] = $registrosFormatados;

        echo json_encode($response);
    }

    /**
     * Função acessada por requisições AJAX para listagem de registros selecionados via filtro
     * 
     * Retorna um JSON de objetos
     */
    public function select_from_filter()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Registro
        $this->load->model('registro_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $filtro = $this->input->post('filtro');
        $registros = $this->registro_model->filtrarRegistros($filtro);
        $registrosFormatados = $this->formatarRegistros($registros);

        $response['data'] = $registrosFormatados;

        echo json_encode($response);
    }

    /**
     * Função acessada via requisições AJAX para deleção de registros de entrada/saída
     */
    public function delete()
    {
        if (!$this->input->is_ajax_request())
            exit("Não é permitido aceso direto aos scripts.");

        # Carrega o model Registro
        $this->load->model('registro_model');

        # Carrega o model Administrador
        $this->load->model('administrador_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $senha = $this->input->post('senha');
        $ids = $this->input->post('ids_registros');
        $admin = $this->administrador_model->carregarPorId($this->session->userdata('logged_user_id'));

        if (password_verify($senha, $admin->senha)) {
            $this->registro_model->excluir($ids);
        } else {
            $response['status'] = 0;
            $response['error_list']['#divInputSenhaExcluir'] = 'Senha incorreta.';
        }


        echo json_encode($response);
    }

    /**
     * Método utilizado pelas funções ajax de listagem de registros
     * Formata os dados de cada registro
     */
    private function formatarRegistros($registros)
    {

        # Carrega o model Bicicleta
        $this->load->model('bicicleta_model');
        # Carrega o model Usuario
        $this->load->model('usuario_model');
        # Carrega o model Saida
        $this->load->model('saida_model');
        # Carrega o model Funcionario
        $this->load->model('funcionario_model');

        $registrosFormatados = array();

        if (!$registros) $registros = array();

        foreach ($registros as $reg) :

            ## Formata algumas informações sobre o registro de entrada (checkin)

            # Verifica se há informações sobre o cadeado e formata
            $reg['num_trava'] = (!trim($reg['num_trava']) ? 'Nenhum cadeado utilizado' : $reg['num_trava']);
            # Formata a hora e a data
            $reg['data_hora'] = Tools::formatarTimestamp(strtotime($reg['data_hora']));
            # Verifica se há observações e formata
            $reg['obs'] = (!trim($reg['obs']) ? 'Nenhuma observação' : $reg['obs']);

            ## Formata as informações importantes sobre o funcionário que realizou o checkin

            $fun_entrada = $this->funcionario_model->carregarPorId($reg['id_funcionario']);
            $funcEntradaInfo = array(
                'id' => $fun_entrada->id,
                'nome' => $fun_entrada->nome,
                'cpf' => $fun_entrada->cpf
            );

            ## Formata as informações importantes sobre a bicicleta

            $bike = $this->bicicleta_model->carregarPorId($reg['id_bicicleta']);
            $bikeInfo = array(
                'id' => $bike->id,
                'cores' => $bike->cores,
                'modelo' => ModeloBike::getNomeModelo($bike->modelo),
                'marca' => (!trim($bike->marca) ? 'Não informado' : $bike->marca),
                'aro' => $bike->aro
            );

            ## Formata as informações importantes sobre o usuário (dono da bike)

            $user = $this->usuario_model->carregarPorId($bike->id_usuario);
            $userInfo = array(
                'id' => $user->id,
                'nome' => $user->nome, // Retorna apenas o primeiro nome do usuário
                'matricula' => (!trim($user->matricula) ? "Não informado" : $user->matricula),
                'cpf' => ($user->perfil_privado == 't' ? 'Privado' : $user->cpf)
            );

            ## Formata as informãoes importantes sobre o registro de saída (checkout)

            # Verifica se há um registro de saída relacionado ao registro de entrada ...
            if ($reg['id_saida']) :

                ## Salva as informações da saída
                $saida = $this->saida_model->carregarPorId($reg['id_saida']);
                $saidaInfo = array(
                    'id' => $saida->id,
                    // Formata a hora e a data
                    'data_hora' => Tools::formatarTimestamp(strtotime($saida->data_hora)),
                    // Verifica se há observações e formata
                    'obs' => (!trim($saida->obs) ? 'Nenhuma observação' : $saida->obs),
                );

                ## Formata as informações importantes sobre o funcionário que realizou o checkin

                $fun_saida = $this->funcionario_model->carregarPorId($saida->id_funcionario);
                $funcSaidaInfo = array(
                    'id' => $fun_saida->id,
                    'nome' => $fun_saida->nome,
                    'cpf' => $fun_saida->cpf
                );
            # ... se não houver, preenche os dados com 'Pendente'
            else :
                $saidaInfo = array(
                    'id' => null,
                    'data_hora' => 'Pendente',
                    'obs' => 'Pendente'
                );

                $funcSaidaInfo = array(
                    'id' => null,
                    'nome' => 'Pendente',
                );
            endif;

            # Salva as informações formatadas em um array que contém todos os dados pertinentes sobre o registro
            $registro['registros'] = $reg;                          # info. sobre o registro de entrada
            $registro['funcionarios_entrada'] = $funcEntradaInfo;   # info. sobre o fun. que registrou a entrada
            $registro['bikes'] = $bikeInfo;                         # info. sobre a bicicleta
            $registro['users'] = $userInfo;                         # info. sobre o dono da bicicleta
            $registro['saidas'] = $saidaInfo;                       # info. sobre o registro de saída
            $registro['funcionarios_saida'] = $funcSaidaInfo;       # info. sobre o fun. que registrou a saída

            array_push($registrosFormatados, $registro); // adiciona à lista de registros um novo registro (array de objetos)
        endforeach;

        return $registrosFormatados;
    }
}
