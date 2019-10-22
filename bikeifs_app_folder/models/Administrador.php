<?php


class Administrador extends CI_Model
{
    /**
     * ### Administrador constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    /**
     * ### Exclui um registro da tabela Administrador.
     * 
     * @param $id -  O id do registro a ser excluído
     */
    public function excluir($id)
    {
        $this->db->where('id', $id)->delete('ADMINISTRADOR');
    }

    /**
     * ### Edita os valores do registro na tabela Administrador.
     * 
     * @param mixed $id - id do Administrador a ser editado
     * @param array $camposValores - array associativo com as colunas para editar 
     *              (escritas como se apresentam no banco de dados) e seus novos valores
     */
    public function editar($id, $camposValores = array())
    {
        $this->db->where('id', $id)->update('ADMINISTRADOR', $camposValores);
    }

    /**
     * ### Insere um registro na tabela Administrador.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('ADMINISTRADOR', $valores);
    }

    /**
     * ### Carrega os valores do objeto instanciado com os valores de um registro da tabela Administrador. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        return $this->db->get_where('ADMINISTRADOR', array('id' => $id));
    }


    /**
     * ### Lista todos os registros da tabela Administrador
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        return $this->db->get('ADMINISTRADOR');
    }

    /**
     * ### Lista todos os registros da tabela Administrador que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public  function listarPorCampos($camposValores)
    {
        return $this->db->get_where('ADMINISTRADOR', $camposValores);
    }
}
