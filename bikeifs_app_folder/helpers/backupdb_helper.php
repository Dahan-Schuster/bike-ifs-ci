<?php defined('BASEPATH') or exit('Não é permitido acesso direto aos scripts.');

if (!defined('DBBKPATH'))
    define(
        'DBBKPATH',
        APPPATH . 'core' .
            DIRECTORY_SEPARATOR . 'database' .
            DIRECTORY_SEPARATOR . 'database_backup.backup'
    );

if (!defined('PG_DUMP_DIR'))
    define(
        'PG_DUMP_DIR',
        APPPATH . 'core' .
            DIRECTORY_SEPARATOR . 'database' .
            DIRECTORY_SEPARATOR . 'bin' .
            DIRECTORY_SEPARATOR
    );


if (!defined('PERIODO_BACKUP'))
    define('PERIODO_BACKUP', 1);




if (!function_exists('existeArquivoBackup')) {
    /**
     * Verifica se existe um arquivo de backup salvo no servidor
     * 
     * @return bool true se o arquivo existes, false se não
     */
    function existeArquivoBackup()
    {
        return file_exists(DBBKPATH);
    }
}

if (!function_exists('segundosDesdeUltimoBackup')) {
    /**
     * Retorna a quantidade de segundos desde o último backup
     * 
     * @return integer segundos desde o último backup
     */
    function segundosDesdeUltimoBackup()
    {
        return time() -  filemtime(DBBKPATH);
    }
}



if (!function_exists('necessitaBackup')) {
    /**
     * Verifica se o último backup foi realizado dentro do período de backup
     * O período de backup tem como valor padrão 1, o que corresponde a 1 dia
     * 
     * @return bool true se um backup é necessário, false se não
     */
    function necessitaBackup()
    {
        return (segundosDesdeUltimoBackup() >= (PERIODO_BACKUP * 86400)) ? true : false;
    }
}

if (!function_exists('backup')) {
    /**
     * Verifica se deve realizar o backup e, se sim, chama a função responsável
     * 
     * @param bool $force caso TRUE, irá pular a verificação de necessidade de backup
     * 
     * @return bool - true se a rotina de backup foi chamada, false se não
     */
    function backup($force = false)
    {
        try {
            if ($force || !existeArquivoBackup() || necessitaBackup()) {
                realizarBackup();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}

if (!function_exists('realizarBackup')) {
    /**
     * Executa o script responsável por realizar o backup do banco de dados.
     * 
     * @param $database nome do banco de dados
     * @param $host endereço IP ou nome do servidor
     * @param $port porta utilizada pelo postgre
     * @param $username usuário do banco de dados
     * @param $password senha do usuário do banco de dados
     * @param $format formato do backup
     */
    function realizarBackup(
        $database = 'bikeifs',
        $host = 'localhost',
        $port = '5432',
        $username = 'postgres',
        $password = 'root',
        $format = 'tar'
    ) {
        exec(
            "SET PGPASSWORD=$password" .
                ' & ' .
                'cd ' . PG_DUMP_DIR .
                ' & ' .
                'pg_dump.exe ' .
                ' --host ' . $host .
                ' --port ' . $port .
                ' --username ' .  $username .
                ' --format ' . $format .
                ' --file ' . DBBKPATH  .
                " $database"
        );
    }
}
