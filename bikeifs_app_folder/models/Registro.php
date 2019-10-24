<?php


class Registro extends CI_Model
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
     * Exclui um registro da tabela Registro.
     * 
     * @param $id -  O id do registro a ser excluído
     */
    public function excluir($id)
    {
        $this->db->where('id', $id)->delete('REGISTRO');
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
        return ($result->num_rows() > 0) ? $result : NULL;
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
        return ($result->num_rows() > 0) ? $result : NULL;
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
        return ($result->num_rows() > 0) ? $result : NULL;
    }

    /**
     * Conta quantos registros estão cadastrados do sistema
     * 
     * @return array - array de uma posição com a quantidade de registros cadastrados
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('REGISTRO')->count_all_results();
    }

    /**
     * Lista todos os registros de um dia específico enviado por parâmetro.
     * A String $dia será convertida em um timestamp e depois formatada em uma 
     * data no formado Y-m-d (padrão PostgreSQL)
     * 
     * @param $dia - o dia em questão
     * @return array - Array associativo com os registros encontrados.
     * 
     */
    public function listarRegistrosPorDia($dia)
    {
        $dia = date('Y-m-d', strtotime($dia));
        $result = $this->db->where("hora::date =", $dia)->get('REGISTRO');
        return ($result->num_rows() > 0) ? $result : NULL;
    }

    /**
     * Lista todos os registros em que a FK id_bicicleta estiver associada ao id_usuario enviado por parâmetro.
     * 
     * @param $idUsuario - o id do usuário em questão
     * @return array - Array associativo com os registros encontrados.
     * 
     */
    public  function listarHistoricoUsuario($idUsuario)
    {
        $this->db->select("REGISTRO.*")
                 ->from("REGISTRO")
                 ->join("BICICLETA", 'REGISTRO.id_bicicleta = "BICICLETA".id')
                 ->where('"BICICLETA".id_usuario', $idUsuario)
                 ->order_by('"REGISTRO".hora', 'DESC');
        $result = $this->db->get();
        return ($result->num_rows() > 0) ? $result : NULL;
    }

    /**
     * Conta os registros de um dia específico enviado por parâmetro
     * Este método poderá ser atualizado no futuro para recber duas datas e listar os registros entre elas
     * Na versão atual, isto ainda não foi implementado
     * 
     * @param $dia - o dia em questão
     * @return array - Array associativo com quantidade de registros encontrados.
     * 
     */
    public  function contarRegistrosDoDia($dia)
    {
        $result = $this->db->where('hora::date', $dia)->from('REGISTRO')->count_all_results();
    }

    /**
     * Conta os registros de uma semana específica enviada por parâmetro
     * Este método poderá ser atualizado no futuro para recber duas datas e listar os registros entre elas
     * Na versão atual, isto ainda não foi implementado
     * 
     * @param $semana - a semana em questão
     * @param $ano - o ano da semana
     * @return array - Array associativo com quantidade de registros encontrados.
     * 
     */
    public function contarRegistrosDaSemana($semana, $ano)
    {
        $this->db->where("date_part('year', hora::date)", $ano);
        $this->db->where("date_part('week', hora::date)", $semana);
        return $this->db->from('REGISTRO')->count_all_results();
    }

    /**
     * Conta os registros de um mês-ano específico enviado por parâmetro
     * Este método poderá ser atualizado no futuro para recber mais de um mês listar os registros entre eles
     * Na versão atual, isto ainda não foi implementado
     * 
     * @param $mes - o mês em questão
     * @param $ano - o ano do mês
     * @return array - Array associativo com quantidade de registros encontrados.
     * 
     */
    public  function contarRegistrosDoMes($mes, $ano)
    {
        $this->db->where("date_part('year', hora::date)", $ano);
        $this->db->where("date_part('month', hora::date)", $mes);
        return $this->db->from('REGISTRO')->count_all_results();
    }

    /**
     * Lista todos os registros de uma bicicleta em que a FK id_saida for nula.
     * 
     * @param $idBicicleta - o id da bicicleta em questão
     * @return array - Array associativo com os registros encontrados.
     * 
     */
    public  function listarRegistrosEmAberto($idBicicleta)
    {
        $this->db->where("id_bicicleta", $idBicicleta);
        $this->db->where("id_saida IS NULL");
        $result = $this->db->from('REGISTRO')->get();
        return ($result->num_rows() > 0) ? $result : NULL;
    }
}
