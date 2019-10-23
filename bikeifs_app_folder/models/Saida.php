<?php


class Saida extends CI_Model
{
    /**
     * Saida constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Exclui um registro da tabela Saida.
     * 
     * @param $id -  O id do registro a ser excluído
     */
    public function excluir($id)
    {
        $this->db->where('id', $id)->delete('SAIDA');
    }

    /**
     * Edita os valores do registro na tabela Saida.
     * 
     * @param mixed $id - id do Saida a ser editado
     * @param array $camposValores - array associativo com as colunas para editar 
     *              (escritas como se apresentam no banco de dados) e seus novos valores
     */
    public function editar($id, $camposValores = array())
    {
        $this->db->where('id', $id)->update('SAIDA', $camposValores);
    }

    /**
     * Insere um registro na tabela Saida.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('SAIDA', $valores);
    }

    /**
     * Carrega os valores do objeto instanciado com os valores de um registro da tabela Saida. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        return $this->db->get_where('SAIDA', array('id' => $id));
    }


    /**
     * Lista todos os registros da tabela Saida
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        return $this->db->get('SAIDA');
    }

    /**
     * Lista todos os registros da tabela Saida que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        return $this->db->get_where('SAIDA', $camposValores);
    }

    /**
     * Lista todos os registros da tabela Saida associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        return $this->db->get_where('SAIDA', array($foreignKey => $valor));
    }

    /**
     * Conta quantas saidas estão cadastradas do sistema
     * 
     * @return array - array de uma posição com a quantidade de saidas cadastradas
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('SAIDA')->count_all_results();
    }
}
