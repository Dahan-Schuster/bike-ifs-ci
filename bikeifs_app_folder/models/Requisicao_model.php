<?php


class Requisicao_model extends CI_Model
{
    /**
     * Requisicao constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Exclui registros da tabela Requisicao.
     * 
     * @param array $id - Os ids dos registros a serem excluídos
     */
    public function excluir($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->delete('REQUISICAO');
    }

    /**
     * Exclui registros que ainda não foram atendidos da tabela Requisicao.
     * 
     * @param int $id - Os id da bike com requisições em aberto
     */
    public function apagarRequisicoesEmAberto($id_bicicleta)
    {
        $this->db->where('id_bicicleta', $id_bicicleta)->where('atendida', 'f')->delete('REQUISICAO');
    }

    /**
     * Edita os valores do registro na tabela Requisicao.
     * 
     * @param mixed $id - id da Requisicao a ser editada
     * @param array $camposValores - array associativo com as colunas para editar 
     *              (escritas como se apresentam no banco de dados) e seus novos valores
     */
    public function editar($id, $camposValores = array())
    {
        $this->db->where('id', $id)->update('REQUISICAO', $camposValores);
    }

    /**
     * Insere um registro na tabela Requisicao.
     * 
     * @return id - O ID do registro inserido
     */
    public function inserir($valores)
    {
        $this->db->insert('REQUISICAO', $valores);
        return $this->db->insert_id();
    }

    /**
     * Carrega os valores do objeto instanciado com os valores de um registro da tabela Requisicao. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        $result = $this->db->get_where('REQUISICAO', array('id' => $id));
        return ($result->num_rows() > 0) ? $result->row() : NULL;
    }


    /**
     * Lista todos os registros da tabela Requisicao
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        $result = $this->db->get('REQUISICAO');
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Lista todos os registros da tabela Requisicao que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        $result = $this->db->get_where('REQUISICAO', $camposValores);
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Lista todos os registros da tabela Requisicao associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        $result = $this->db->get_where('REQUISICAO', array($foreignKey => $valor));
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Conta quantas requisições estão cadastradas do sistema
     * 
     * @return array - array de uma posição com a quantidade de requisições cadastradas
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('REQUISICAO')->count_all_results();
    }
}
