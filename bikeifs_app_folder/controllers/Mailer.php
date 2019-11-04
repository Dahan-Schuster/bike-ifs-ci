<?php

/**
 * Controlador responsável por enviar emails usando a biblioteca PHPMailer
 */

defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

# Carrega o PHPMailer
require_once(APPPATH . "models/phpmailer/PHPMailer.php");
require_once(APPPATH . "models/phpmailer/SMTP.php");
require_once(APPPATH . "models/phpmailer/POP3.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\POP3;

class Mailer extends CI_Controller
{

    private $mail;

    /** Construtor
     *  Configura o objeto mail
     */
    public function __construct()
    {
        parent::__construct();

        # Carrega o model Email
        $this->load->model('email_model');

        # Carrega a biblioteca de sessão
        $this->load->library('session');

        # Define o fuso horário do sistema
        date_default_timezone_set('America/Maceio');

        $this->mail = new PHPMailer();

        # Configurações do gmail
        $this->mail->IsSMTP();
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 465;
        $this->mail->SMTPSecure = 'ssl';

        # configuração do usuário do email
        $this->mail->Username = 'bikeifs.naoresponda@gmail.com'; // usuario email.   
        $this->mail->Password = 'Pedale 1 vez por dia.'; // senha do email.

        # configuração do email a ver enviado.
        $this->mail->isHTML(true);

        $this->mail->From = "bikeifs.naoresponda@gmail.com";
        $this->mail->FromName = "Bike-Ifs";
    }


    /**
     * Envia emails para os usuários enviados via POST
     * Registra o envio do do email após enviar
     */
    public function ajaxContatarUsuarios()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta à requisição AJAX
        $response = array();
        # status != 1: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $data = $this->input->post();

        $this->load->model('usuario_model');

        ## Validação dos dados

        if (empty(trim($data['remetente']))) :
            $response['error_list']['#divInputNome'] = "O nome do remetente não pode estar vazio";
        endif;

        if (empty($data['assunto'])) :
            $response['error_list']['#divInputAssunto'] = "O assunto não pode estar vazio";
        endif;

        if (empty($data['corpo'])) :
            $response['error_list']['#divInputCorpo'] = "O corpo do e-mail não pode estar vazio";
        endif;

        if (empty($data['destinatarios'])) :
            $response['error_list']['#divInputDestinatarios'] = "Escolha ao menos um destinatário";
        endif;

        ## Fim validação
        if (!empty($response['error_list'])) :
            $response['status'] = 0;
        else :
            foreach ($data['destinatarios'] as $destinatario) {
                $usuario = $this->usuario_model->listarPorCampos(array('email' => $destinatario));
                if ($usuario) :
                    $usuario = $usuario[0];
                    try {
                        $this->mail->addAddress($destinatario);
                        $this->email_model->inserir(
                            array(
                                'hora' => date('Y-m-d H:i:s'),
                                'remetente' => $data['remetente'],
                                'assunto' => $data['assunto'],
                                'corpo' => $data['corpo'],
                                'id_funcionario' => $this->session->logged_user_id,
                                'id_usuario' => $usuario['id']

                            )
                        );
                    } catch (\Throwable $e) {
                        $response['status'] = -1;
                    }
                endif;
            }

            if (!$this->enviarEmailParaUsuarios($data['assunto'], $data['remetente'], $data['corpo'])) {
                $response['status'] = -1;
            }

        endif;

        if ($response['status'] == -1)
            $response['error_message'] = 'Um ou mais destinatários não puderam ser contatados.';


        # Retorna o array de resposta à requisição AJAX
        echo json_encode($response);
    }

    /**
     * Gera e envia uma nova senha para o usuário que requisitou
     */
    public function ajaxEnviarNovaSenha()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta à requisição AJAX
        $response = array();
        # status != 1: algo deu errado | status == 1: tudo certo
        $response['status'] = 1;

        $email = $this->input->post('email');
        $tipoAcesso = $this->input->post('tipoAcesso');

        # Armazena uma nova senha gerada
        $novaSenha = $this->gerarCodigo();

        # Criptografa a nova senha para inserção no banco de dados
        $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        # Pesquisa o registro que possui o endereço de email enviado
        # Após pesquisar, edita a senha
        switch ($tipoAcesso):
            case 'funcionario':
                $this->load->model('funcionario_model'); # Carrega o modal correspondente ao tipo de acesso escolhido
                $result = $this->funcionario_model->listarPorCampos(array('email' => $email)); # Pesquisa o registro por endereço de email
                if ($result) :       # Se a pesquisa retorna um registro
                    $result = $result[0];   # Move o resultado para a primeira linha (deve haver apenas um, visto que o campo email no bd possui o index UNIQUE)
                    if ($this->enviarEmailRecuperacaoSenha($email, $result['nome'], $novaSenha))  # Tenta enviar a nova senha via email
                        $this->funcionario_model->editar($result['id'], array('senha' => $novaSenhaHash));  # Se enviar, altera a senha
                    else                                                                        # Se não, não edita a senha
                        $response['status'] = 2;    # status == 2: erro no envio do email
                else :
                    $response['status'] = 0;        # status == 0: endereço de email não encontrado
                endif;
                break;
            case 'usuario':
                $this->load->model('usuario_model');
                $result = $this->usuario_model->listarPorCampos(array('email' => $email));
                if ($result) :
                    $result = $result[0];
                    if ($this->enviarEmailRecuperacaoSenha($email, $result['nome'], $novaSenha))
                        $this->usuario_model->editar($result['id'], array('senha' => $novaSenhaHash));
                    else
                        $response['status'] = 2;
                else :
                    $response['status'] = 0;
                endif;
                break;
            case 'admin':
                $this->load->model('administrador_model');
                $result = $this->administrador_model->listarPorCampos(array('email' => $email));
                if ($result) :
                    $result = $result[0];
                    if ($this->enviarEmailRecuperacaoSenha($email, $result['nome'], $novaSenha))
                        $this->administrador_model->editar($result['id'], array('senha' => $novaSenhaHash));
                    else
                        $response['status'] = 2;
                else :
                    $response['status'] = 0;
                endif;
                break;
            default:
                $response['status'] = -1;
                $response['error_message'] = 'Tipo de usuário não reconhecido';
                break;
        endswitch;

        # Mensagem de erro para endereço de email não encontrado
        if ($response['status'] == 0) :
            $response['error_message'] = 'Nenhum email encontrado na base de dados para este tipo de usuário';
        # Mensagem de erro para email não enviada
        elseif ($response['status'] == 2) :
            $response['error_message'] = 'Não foi possível enviar sua senha por email e, portanto, ela não foi alterada. ' .
                'Certifique-se de estar devidamente conectado à Internet e possui um email válido cadastrado e tente novamente.';
        endif;

        echo json_encode($response);
    }

    public function ajaxEnviarCodigo()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        if (!$this->input->is_ajax_request())
            exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta à requisição AJAX
        $response = array();
        # status != 1: algo deu errado | status == 1: tudo certo


        $email = $this->input->post('email');

        # Gera um código de confirmação
        $codigo = $this->gerarCodigo();

        if ($this->enviarCodigoDeConfirmacao($email, $codigo)) {
            $response['status'] = 1;
            // Salva o código e o novo email temprariamente na sessão, definindo o tempo de expiração para 30 minutos
            $this->session->set_tempdata('codigo_confirmacao_email', $codigo, 1800);
            $this->session->set_tempdata('novo_email', $email, 1800);
        } else {
            $response['status'] = 0;
            $response['error_message'] = 'Não foi possível enviar o email. Certifique-se de estar devidamente conectado à Internet e de ter inserido um email válido.';
        }

        echo json_encode($response);
    }

    /**
     *  Gera uma sequencia de oito caracteres aletaórios   
     */
    private function gerarCodigo()
    {
        # Gera um número aleatório de oito dígitos
        $codigo_numerico = Rand(10000000, 99999999);
        # Converte para string e criptografa com base 64
        $codigo_base_64 = base64_encode(strval($codigo_numerico));
        # Limita a 8 caracteres e retorna
        return substr($codigo_base_64, 0, 8);
    }

    /**
     * Envia um email ao usuário que teve sua senha alterada.
     */
    private function enviarEmailRecuperacaoSenha($emailDestinatario, $nomeDestinatario, $novaSenha)
    {

        $this->mail->addAddress($emailDestinatario); // email do destinatario.

        $this->mail->Subject = "Recuperação de senha - Bike IFS";

        # Recupera o arquivo html salvo no arquivo pagina-email.html
        $rawBody = file_get_contents(APPPATH . 'views/phpmailer-html/pagina-nova-senha.html');

        # Substitui a palavra '!novasenha!', previamente posicionada no arquivo,
        # pela senha gereada
        $rawBodySenha = preg_replace('/\bnovaSenha\b/', $novaSenha, $rawBody);

        # Substitui a palavra '!nomeUser!', previamente posicionada no arquivo,
        # pelo nome do usuário
        $body = preg_replace('/\bnomeUser\b/', strtoupper($nomeDestinatario), $rawBodySenha);

        $this->mail->Body = $body;

        # Envia o e-mail
        $result = $this->mail->Send();

        # Limpa os destinatários
        $this->mail->ClearAllRecipients();

        return $result;
    }

    /**
     * Envia um email ao usuário que teve sua senha alterada.
     */
    private function enviarCodigoDeConfirmacao($emailDestinatario, $codigo)
    {
        # Limpa os destinatários
        $this->mail->ClearAllRecipients();

        $this->mail->addAddress($emailDestinatario); // email do destinatario.

        $this->mail->Subject = "Confirmação de email - Bike IFS";

        # Recupera o arquivo html salvo no arquivo pagina-email.html
        $rawBody = file_get_contents(APPPATH . 'views/phpmailer-html/pagina-verificar-email.html');

        # Substitui a palavra 'codigo', previamente posicionada no arquivo,
        # pelo código gerado
        $body = preg_replace('/\bcodigo\b/', $codigo, $rawBody);

        $this->mail->Body = $body;

        # Envia o e-mail
        return $this->mail->send();
    }

    private function enviarEmailParaUsuarios($assunto, $remetente, $corpo)
    {
        $this->mail->Subject = $assunto;

        # Recupera o arquivo html salvo no arquivo pagina-email.html
        $rawBody = file_get_contents(APPPATH . 'views/phpmailer-html/pagina-contatar-usuario.html');

        # Substitui as string de assunto, corpo e remetente, 
        # previamente posicionada no arquivo,
        # pelos valores recebidos via POST
        $body = preg_replace('/\bstringToReplaceAssunto\b/', $assunto, $rawBody);
        $body = preg_replace('/\bstringToReplaceCorpo\b/', $corpo, $body);
        $body = preg_replace('/\bstringToReplaceRemetente\b/', $remetente, $body);

        $this->mail->Body = $body;
        # Envia o e-mail
        $result = $this->mail->Send();

        $this->mail->ClearAllRecipients();

        return $result;
    }
}
