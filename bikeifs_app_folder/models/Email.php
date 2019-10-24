<?php


class Email extends CI_Model
{
    /**
     * Email constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Exclui um registro da tabela Email.
     * 
     * @param $id -  O id do registro a ser excluído
     */
    public function excluir($id)
    {
        $this->db->where('id', $id)->delete('EMAIL');
    }

    /**
     * Edita os valores do registro na tabela Email.
     * 
     * @param mixed $id - id do Email a ser editado
     * @param array $camposValores - array associativo com as colunas para editar 
     *              (escritas como se apresentam no banco de dados) e seus novos valores
     */
    public function editar($id, $camposValores = array())
    {
        $this->db->where('id', $id)->update('EMAIL', $camposValores);
    }

    /**
     * Insere um registro na tabela Email.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('EMAIL', $valores);
    }

    /**
     * Carrega os valores do objeto instanciado com os valores de um registro da tabela Email. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        $result = $this->db->get_where('EMAIL', array('id' => $id));
        return ($result->num_rows() > 0) ? $result->row() : NULL;
    }


    /**
     * Lista todos os registros da tabela Email
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        $result = $this->db->get('EMAIL');
        return ($result->num_rows() > 0) ? $result : NULL;
    }

    /**
     * Lista todos os registros da tabela Email que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        $result = $this->db->get_where('EMAIL', $camposValores);
        return ($result->num_rows() > 0) ? $result : NULL;
    }

    /**
     * Lista todos os registros da tabela Email associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        $result = $this->db->get_where('EMAIL', array($foreignKey => $valor));
        return ($result->num_rows() > 0) ? $result : NULL;
    }

    /**
     * Conta quantos emails estão cadastrados do sistema
     * 
     * @return array - array de uma posição com a quantidade de emails cadastrados
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('EMAIL')->count_all_results();
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
    public function listarEmailsPorDia($dia)
    {
        $dia = date('Y-m-d', strtotime($dia));
        $result = $this->db->where("hora::date =", $dia)->get('EMAIL');
        return ($result->num_rows() > 0) ? $result : NULL;

    }
}
