<?php

require_once(APPPATH . 'models/ModeloBike.php');

class Tools
{

    public static function formatarUid($uid) {
        $uid = substr($uid, 0, 8);
        $uid = preg_replace('/\s/', '', $uid);
        $letters = str_split($uid);
        $output = '';
        for($i = 0; $i < strlen($uid); $i++) {
            $output .= $letters[$i] . ($i % 2 != 0 ? ' ' : '');
        }

        return trim($output);
    }

    /**
     * Retorna a url da foto da bicicleta ou o ícone de seu modelo
     */
    public static function getBikeFoto($bike)
    {
        if (!isset($bike['nome_modelo'])) $bike['nome_modelo'] =  ModeloBike::getNomeModelo($bike['modelo']);
        return trim($bike['foto_url']) && file_exists(getcwd() . $bike['foto_url']) ?
                base_url($bike['foto_url']) : base_url('public/img/icons/bike-' . mb_strtolower($bike['nome_modelo']) . '-colored.png');
    }
    
    /**
     * Retorna a url da foto do funcionário ou uma imagem padrão
     */
    public static function getFuncionarioFoto($foto_url)
    {
        return trim($foto_url) && file_exists(getcwd() . $foto_url) ?
                base_url($foto_url) : base_url('public/img/icons/employee.png');
    }
    
    /**
     * Retorna a url da foto do usuário ou uma imagem padrão
     */
    public static function getUsuarioFoto($foto_url)
    {
        return trim($foto_url) && file_exists(getcwd() . $foto_url) ?
                base_url($foto_url) : base_url('public/img/icons/cyclist.png');
    }

    /**
     * Configura a localização e o fuso horário e retorna um String 
     * com um formato padrão de data para ser salva no banco de dados
     */
    public static function formatarTimestamp($timestamp)
    {
        # Define as configurações de localização (para retorno do strftime em português)
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        # Define o fuso horário
        date_default_timezone_set('America/Maceio');
        return utf8_encode(ucfirst(strftime('%A, %d/%m/%Y', $timestamp))) . ' - ' . date('H:i', $timestamp);
    }

    /**
     * Formata CPF e CNPJ
     */
    public static function formatCnpjCpf($value)
    {
        $cnpj_cpf = preg_replace("/\D/", '', $value);

        if (strlen($cnpj_cpf) === 11)
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    /**
     * Verifica a validade de um número de cpf
     */
    public static function isCpfValido($cpf = null)
    {

        // Verifica se um número foi informado
        if (empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if (
            $cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999'
        ) {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{
                        $c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{
                    $c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }
}
