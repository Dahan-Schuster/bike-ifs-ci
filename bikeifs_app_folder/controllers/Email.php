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

class Email extends CI_Controller
{

    private $mail;

    /** Construtor
     *  Configura o objeto mail
     */
    public function __construct()
    {
        parent::__construct();
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
     * Gera e envia uma nova senha para o usuário que requisitou
     */
    public function ajaxEnviarNovaSenha()
    {
        # Verifica se o método está sendo acessado por uma requisição AJAX
        //if (!$this->input->is_ajax_request())
        //    exit("Não é permitido acesso direto aos scripts.");

        # Array de resposta à requisição AJAX
        $json = array();
        # status != 1: algo deu errado | status == 1: tudo certo
        $json['status'] = 1;

        $email = $this->input->post('email');
        $tipoAcesso = $this->input->post('tipoAcesso');

        # Armazena uma nova senha gerada
        $novaSenha = $this->gerarSenha();

        # Pesquisa o registro que possui o endereço de email enviado
        # Após pesquisar, edita a senha
        switch ($tipoAcesso):
            case 'funcionario':
                $this->load->model('funcionario'); # Carrega o modal correspondente ao tipo de acesso escolhido
                $result = $this->funcionario->listarPorCampos(array('email' => $email)); # Pesquisa o registro por endereço de email
                if ($result) :       # Se a pesquisa retorna um registro
                    $result = $result[0];   # Move o resultado para a primeira linha (deve haver apenas um, visto que o campo email no bd possui o index UNIQUE)
                    if ($this->enviarEmailRecuperacaoSenha($email, $result['nome'], $novaSenha))  # Tenta enviar a nova senha via email
                        $this->funcionario->editar($result['id'], array('senha' => $novaSenha));  # Se enviar, altera a senha
                    else                                                                        # Se não, não edita a senha
                        $json['status'] = 2;    # status == 2: erro no envio do email
                else :
                    $json['status'] = 0;        # status == 0: endereço de email não encontrado
                endif;
                break;
            case 'usuario':
                $this->load->model('usuario');
                $result = $this->usuario->listarPorCampos(array('email' => $email));
                if ($result) :
                    $result = $result[0];
                    if ($this->enviarEmailRecuperacaoSenha($email, $result['nome'], $novaSenha))
                        $this->usuario->editar($result['id'], array('senha' => $novaSenha));
                    else
                        $json['status'] = 2;
                else :
                    $json['status'] = 0;
                endif;
                break;
            case 'admin':
                $this->load->model('administrador');
                $result = $this->administrador->listarPorCampos(array('email' => $email));
                if ($result) :
                    $result = $result[0];
                    if ($this->enviarEmailRecuperacaoSenha($email, $result['nome'], $novaSenha))
                        $this->administrador->editar($result['id'], array('senha' => $novaSenha));
                    else
                        $json['status'] = 2;
                else :
                    $json['status'] = 0;
                endif;
                break;
            default:
                $json['status'] = -1;
                $json['error_message'] = 'Tipo de usuário não reconhecido';
                break;
        endswitch;

        # Mensagem de erro para endereço de email não encontrado
        if ($json['status'] == 0) :
            $json['error_message'] = 'Nenhum email encontrado na base de dados para este tipo de usuário';
        # Mensagem de erro para email não enviada
        elseif ($json['status'] == 2) :
            $json['error_message'] = 'Não foi possível enviar sua senha por email e, portanto, ela não foi alterada. ' .
                'Certifique-se de estar devidamente conectado à Internet e possui um email válido cadastrado e tente novamente.';
        endif;

        echo json_encode($json);
    }

    /**
     *  Gera uma sequencia de oito caracteres aletaórios   
     */
    private function gerarSenha()
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
}
