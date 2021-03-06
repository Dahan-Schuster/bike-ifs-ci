<?php

require_once(APPPATH . 'models/SituacaoFuncionario.php');
require_once(APPPATH . 'models/SituacaoUsuario.php');

class Registro_model extends CI_Model
{
    /**
     * Registro constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Exclui registros da tabela Registro.
     * 
     * @param array $id - Os ids dos registros a serem excluídos
     */
    public function excluir($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->delete('REGISTRO');
    }

    /**
     * Edita os valores do registro na tabela Registro.
     * 
     * @param mixed $id - id do Registro a ser editado
     * @param array $camposValores - array associativo com as colunas para editar 
     *              (escritas como se apresentam no banco de dados) e seus novos valores
     */
    public function editar($id, $camposValores = array())
    {
        $this->db->where('id', $id)->update('REGISTRO', $camposValores);
    }

    /**
     * Insere um registro na tabela Registro.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('REGISTRO', $valores);
        return $this->db->insert_id();
    }

    /**
     * Carrega os valores do objeto instanciado com os valores de um registro da tabela Registro. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        $result = $this->db->get_where('REGISTRO', array('id' => $id));
        return ($result->num_rows() > 0) ? $result->row() : NULL;
    }


    /**
     * Lista todos os registros da tabela Registro
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        $result = $this->db->get('REGISTRO');
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Lista todos os registros da tabela Registro que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        $result = $this->db->get_where('REGISTRO', $camposValores);
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Verifica se existe um registro de entrada em aberto utilizando o cadedao enviado
     * por parâmetro. O cadeado é especificado na tabela na coluna num_trava
     * 
     * @param $cadeado - número do cadeado a ser verificado
     * @return bool - true se o cadeado estiver sendo utilizado, false se não
     */
    public function verificarSeCadeadoEstaEmUso($cadeado)
    {
        $this->db->where('"id_saida" IS NULL', NULL, FALSE);
        $this->db->where('num_trava', $cadeado);
        $result = $this->db->get('REGISTRO');
        return ($result->num_rows() > 0) ? true : false;
    }

    /**
     * Lista todos os registros da tabela Registro associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        $result = $this->db->get_where('REGISTRO', array($foreignKey => $valor));
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Conta quantos registros estão cadastrados do sistema
     * Se o id de uma bicicleta for enviado, conta os regisros dessa bike
     * 
     * @param integer $id_bicicleta (opicional)
     * @return array - array de uma posição com a quantidade de registros cadastrados
     * 
     */
    public function getTotalDeLinhas($id_bicicleta = null)
    {
        if ($id_bicicleta)
            $this->db->where("id_bicicleta", $id_bicicleta);
        return $this->db->from('REGISTRO')->count_all_results();
    }

    /**
     * Conta quantos registros um determinado usuário realizou
     * 
     * @param integer $id_usuario
     * @return array - array de uma posição com a quantidade de registros cadastrados
     * 
     */
    public function getTotalDeRegistrosUsuario($id_usuario = 0)
    {
        $this->db->from('REGISTRO')
        ->join("BICICLETA", 'REGISTRO.id_bicicleta = "BICICLETA".id', 'inner')
        ->join("USUARIO", 'BICICLETA.id_usuario = "USUARIO".id', 'inner')
        ->where("BICICLETA.id_usuario", $id_usuario);
        
        return $this->db->count_all_results();
    }

    /**
     * Conta quantos registros um determinado funcionário realizou
     * 
     * @param integer $id_bicicleta (opicional)
     * @return array - array de uma posição com a quantidade de registros cadastrados
     * 
     */
    public function getTotalDeRegistrosFuncionario($id_funcionario = 0)
    {
        $this->db->from('REGISTRO')->where("id_funcionario", $id_funcionario);
        return $this->db->count_all_results();
    }

    /**
     * Lista todos os registros de um dia específico enviado por parâmetro.
     * O timestamp enviado será formatado em uma data no formado Y-m-d (padrão PostgreSQL)
     * 
     * Se uma chave estrangeira for especificada em $foreignKey, irá listar os registros
     * associados ao objeto com o ID enviado como $foreignKeyValue.
     * 
     * Pode listar registros de um funcinário/bicicleta/usuário específico.
     * 
     * @param $timestamp - timestamp do dia em questão
     * @return array - Array associativo com os registros encontrados.
     * 
     */
    public function listarRegistrosPorDia($timestamp, $foreignKey = NULL, $foreignKeyValue = NULL)
    {
        $timestamp = intval(substr($timestamp, 0, 10));
        $dia = "'" . date('Y-m-d', $timestamp) . "'";

        if (NULL !== $foreignKey) {
            if (strtoupper($foreignKey) == 'ID_FUNCIONARIO') {
                $this->db->where('id_funcionario', $foreignKeyValue);
            } elseif (strtoupper($foreignKey) == 'ID_BICICLETA') {
                $this->db->where('id_bicicleta', $foreignKeyValue);
            } elseif (strtoupper($foreignKey) == 'ID_USUARIO') {
                $this->db->join("BICICLETA", 'REGISTRO.id_bicicleta = "BICICLETA".id')
                    ->where('"BICICLETA".id_usuario', $foreignKeyValue);
            }
        }

        $result = $this->db->where("data_hora::date", $dia, false)->get('REGISTRO');
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Conta os registros de cada um dos 14 dias anteriores ao atual.
     * 
     * @return array - Array associativo com quantidade de registros encontrados.
     * 
     */
    public  function contarRegistrosDosUltimos14Dias()
    {
        $dados = array();

        for ($i = 14; $i >= 0; $i--) {
            $dia = date('Y-m-d', strtotime("-$i days"));
        
            array_push($dados, array(
                'dia' => $dia,
                'count' => $this->db->where('"data_hora"::date', "'" . $dia . "'", false)->from('REGISTRO')->count_all_results()
            ));
        }

        return $dados;
    }

    /**
     * Conta os registros de cada uma das 8 semanas anteriores à atual.
     * 
     * @return array - Array associativo com quantidade de registros encontrados.
     * 
     */
    public function contarRegistrosDasUltimas8Semanas()
    {
        $dados = array();

        for ($i = 8; $i >= 0; $i--) {
            $ano = date('Y', strtotime("-$i weeks"));
            $semana = date('W', strtotime("-$i weeks"));

            $this->db->where("date_part('year', data_hora::date) = '" . $ano . "'");
            $this->db->where("date_part('week', data_hora::date) = '" . $semana . "'");

            array_push($dados, array(
                'semana' => $semana . ' de ' . $ano,
                'count' => $this->db->from('REGISTRO')->count_all_results()
            ));
        }

        return $dados;
    }

    /**
     * Conta os registros de cada uma dos últimos 12 meses.
     * 
     * @return array - Array associativo com quantidade de registros encontrados.
     * 
     */
    public function contarRegistrosDosUltimos12Meses()
    {
        $dados = array();
        $meses = array(
            '01' => 'Janeiro', 
            '02' => 'Fevereiro', 
            '03' => 'Março', 
            '04' => 'Abril',
            '05' => 'Maio', 
            '06' => 'Junho',
            '07' => 'Julho', 
            '08' => 'Agosto',
            '09' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        );

        for ($i = 12; $i >= 0; $i--) {
            $ano = date('Y', strtotime("-$i month"));
            $mes = date('m', strtotime("-$i month"));

            $this->db->where("date_part('year', data_hora::date) = '" . $ano . "'");
            $this->db->where("date_part('month', data_hora::date) = '" . $mes . "'");

            array_push($dados, array(
                'mes' => $meses[$mes],
                'count' => $this->db->from('REGISTRO')->count_all_results()
            ));
        }

        return $dados;
    }

    /**
     * Lista todos os registros em que a FK id_saida for nula.
     * 
     * @param $id_bicicleta - Se id_bicicleta for NULL, irá listar todos os reistos em aberto
     *                     - Se não, irá listar os registros em aberto da bicicleta com id enviado
     * @return array - Array associativo com os registros encontrados.
     * 
     */
    public function listarRegistrosEmAberto($id_bicicleta = NULL)
    {
        if ($id_bicicleta)
            $this->db->where("id_bicicleta", $id_bicicleta);
        $this->db->where('"id_saida" IS NULL', NULL, FALSE);
        $result = $this->db->from('REGISTRO')->get();
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Llista registros filtrados
     * O filtro é enviado por parâmetro
     * 
     * @author Dahan Schuster
     * GitHub: https://github.com/Dahan-Schuster
     */
    public function filtrarRegistros($filtro = array())
    {

        # Caso o filtro esteja vazio, retorna uma lista vazia
        // Este comportamento foi escolhido no lugar de retornar
        // todos os registros por uma questão de performance
        if ($filtro == null || sizeof($filtro) == 0) :
            $this->db->where('id', 0)->from("REGISTRO");

        # Se houverem filtros de pesquisa, formata a query SQL 
        else :

            // Preparando a query com as configurações iniciais
            $this->db->select("REGISTRO.*")->from("REGISTRO")
                ->join("SAIDA", 'REGISTRO.id_saida = "SAIDA".id', 'inner')
                ->join("BICICLETA", 'REGISTRO.id_bicicleta = "BICICLETA".id', 'inner')
                ->join("USUARIO", 'BICICLETA.id_usuario = "USUARIO".id', 'inner')
                ->join("FUNCIONARIO fun_entrada", 'REGISTRO.id_funcionario = "fun_entrada".id', 'inner')
                ->join("FUNCIONARIO fun_saida", 'SAIDA.id_funcionario = "fun_saida".id', 'inner');

            ## Adicionando as cláusulas WHERE ##

            // Formatando o valor da data inicial para incluir na query sql
            $dataInicial = "'" . date('Y-m-d', strtotime($filtro['dataInicial'])) . "'";
            $this->db->where('"REGISTRO"."data_hora"::date >=', $dataInicial, false);

            // Conferindo se o intervalo de datas é diferente de 'todos'
            if ($filtro['intervalo'] != 'todos') {
                // O intervalo é escolhido em um <select> no formulário de filtragem, e cada <option>
                // possui seu valor correspondente no formato usado pelo PHP para somar datas (+1 months, +3 years, etc)
                $intervalo = "'" . date('Y-m-d', strtotime($filtro['intervalo'], strtotime($filtro['dataInicial']))) . "'";
                $this->db->where('"REGISTRO"."data_hora"::date <=', $intervalo, false);
            }


            // Verifica se foi especificado um funcionário que realizou o checkin.
            // Se não, irá adicionar o ID do funcionario à query
            if ($filtro['funcionarioCheckin'] != 'todos') {
                $this->db->where('"fun_entrada".id', $filtro['funcionarioCheckin']);
            }

            // Verifica se deve listar apenas registros com checking feito por funcionários ainda ativos
            if ($filtro['apenasFuncionariosAtivosCheckin'] == 'true') {
                $this->db->where('"fun_entrada".situacao', SituacaoFuncionario::ATIVO);
            }

            // Verifica se foi especificado um funcionário que realizou o checkin.
            // Se não, irá adicionar o ID do funcionario à query
            if ($filtro['funcionarioCheckout'] != 'todos') {
                $this->db->where('"fun_saida".id', $filtro['funcionarioCheckout']);
            }

            // Verifica se deve listar apenas registros com checking feito por funcionários ainda ativos
            if ($filtro['apenasFuncionariosAtivosCheckout'] == 'true') {
                $this->db->where('"fun_saida".situacao', SituacaoFuncionario::ATIVO);
            }

            // Formata o SQL do(s) tipo(s) de usuário
            switch ($filtro['tipoUsuario']) {
                case 'aluno':
                    $this->db->where('"USUARIO".tipo', 0);
                    break;
                case 'servidor':
                    $this->db->where('"USUARIO".tipo', 1);
                    break;
                case 'visitante':
                    $this->db->where('"USUARIO".tipo', 2);
                    break;
                case 'aluno_servidor':
                    $this->db->where('("USUARIO".tipo = 0 OR "USUARIO".tipo = 1)');
                    break;
                case 'aluno_visitante':
                    $this->db->where('("USUARIO".tipo = 0 OR "USUARIO".tipo = 2)');
                    break;
                case 'servidor_visitante':
                    $this->db->where('("USUARIO".tipo = 1 OR "USUARIO".tipo = 2)');
                    break;
            }

            // Verifica se deve listar apenas registros com checking feito por funcionários ainda ativos
            if ($filtro['apenasUsuariosAtivos'] == 'true') {
                $this->db->where('"USUARIO".situacao', SituacaoUsuario::ATIVO);
            }

        endif;

        return $this->db->get()->result_array();
    }
}
