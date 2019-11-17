<?php
defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

require_once(APPPATH . 'models/Tools.php');

class Requisicao extends CI_Controller
{

    /** Construtor
     *  Carrega a biblioteca de sessão
     */
    public function __construct()
    {
        parent::__construct();
        backup();
        $this->load->library('session');

        $this->load->model('requisicao_model');

        # Define o fuso horário do sistema
        date_default_timezone_set('America/Maceio');

        # Verifica se o usuário está logado e, se não, redireciona para a tela de login
        if (!isset($this->session->userdata['permissions_level']))
            header('location: ' . base_url('home/view/login'));
    }
    /**
     * Função acessada por requisições AJAX para listagem de Pendências (requisições em aberto)
     * 
     * Retorna um JSON de objetos
     */
    public function select_all_open()
    {

        if ($this->session->permissions_level != 'funcionario')
            show_404();
        elseif (!$this->input->is_ajax_request())
            header('location: ' . base_url('funcionario/me'));

        # Carrega o model Bicicleta
        $this->load->model('bicicleta_model');
        # Carrega o model Usuario
        $this->load->model('usuario_model');
        # Carrega o model Funcionario
        $this->load->model('funcionario_model');

        # Array de resposta
        $response = array();
        # status == 0: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        # Lista as pendencias
        $pendencias = $this->requisicao_model->listarRequisicoesEmAberto();

        # Verifica se houve um resultado e, se não, retorna status 0 e encerra a execução
        if (!$pendencias) {
            $response['status'] = 0;
            echo json_encode($response);
            exit();
        }

        # Array com todos os objetos referente à requisição formatados
        $pendenciasFormatadas = array();

        foreach ($pendencias as $pen) :

            $pen['atendida'] = $pen['atendida'] == 'f' ? false : true;
            $pen['urgencia'] = $this->calcularUrgenciaRequisicao($pen['data_hora']);
            $pen['data_hora'] = Tools::formatarTimestamp(strtotime($pen['data_hora']));

            ## Formata as informações importantes sobre a bicicleta

            $bike = $this->bicicleta_model->carregarPorId($pen['id_bicicleta']);
            $bikeInfo = array(
                'id' => $bike->id,
                'cores' => $bike->cores,
                'modelo' => ModeloBike::getNomeModelo($bike->modelo),
                'marca' => (!trim($bike->marca) ? 'Não informado' : $bike->marca),
                'aro' => $bike->aro,
                'foto_url' =>  Tools::getBikeFoto(array('modelo' => $bike->modelo, 'foto_url' => $bike->foto_url))
            );

            ## Formata as informações importantes sobre o usuário (dono da bike)

            $user = $this->usuario_model->carregarPorId($bike->id_usuario);
            $userInfo = array(
                'id' => $user->id,
                'nome' => $user->nome, // Retorna apenas o primeiro nome do usuário
                'matricula' => (!trim($user->matricula) ? "Não informado" : $user->matricula),
                'cpf' => ($user->perfil_privado == 't' ? 'Privado' : $user->cpf)
            );

            # Salva as informações formatadas em um array que contém todos os dados pertinentes sobre a requisição
            $pendencia['pendencias'] = $pen;                # info. sobre a requisição
            $pendencia['bikes'] = $bikeInfo;                # info. sobre a bicicleta
            $pendencia['users'] = $userInfo;                # info. sobre o dono da bicicleta

            array_push($pendenciasFormatadas, $pendencia); // adiciona à lista de pendencias uma nova requisição (array de objetos)
        endforeach;

        $response['data'] = $pendenciasFormatadas;

        echo json_encode($response);
    }

    private function calcularUrgenciaRequisicao($dataRequisicao)
    {
        $dateObjRequisicao = new DateTime($dataRequisicao);
        $dateObjHoje = new DateTime();

        $intervalo = $dateObjHoje->diff($dateObjRequisicao);
        return $this->formatarUrgencia($intervalo);
    }

    private function formatarUrgencia($intervalo)
    {
        $dias = $intervalo->d;
        $horas = $intervalo->h;
        $minutos = $intervalo->i;

        if ($dias <= 1) {

            if ($horas == 0 && $minutos < 10) $mensagem = 'Agora mesmo';
            elseif ($horas < 1 && $minutos <= 59) $mensagem = 'Há poucos minutos';
            elseif ($horas == 1 && $minutos <= 59) $mensagem = 'Há uma hora';
            elseif ($horas > 1 && $minutos <= 59) $mensagem = "Há $horas horas";

            return array('mensagem' => $mensagem, 'nivel' => 'recente');

        } elseif ($dias <= 3)
            return array('mensagem' => "Há $dias dias", 'nivel' => 'intermediario');
        else
            return array('mensagem' => "Há $dias dias", 'nivel' => 'urgente');
    }
}
