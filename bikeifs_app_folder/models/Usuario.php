<?php


class Usuario extends CI_Model
{
    /**
     * ### Usuario constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * ### Exclui um registro da tabela Usuario.
     * 
     * @param $id -  O id do registro a ser excluído
     */
    public function excluir($id)
    {
        $this->db->where('id', $id)->delete('USUARIO');
    }

    /**
     * ### Edita os valores do registro na tabela Usuario.
     * 
     * @param mixed $id - id do Usuario a ser editado
     * @param array $camposValores - array associativo com as colunas para editar 
     *              (escritas como se apresentam no banco de dados) e seus novos valores
     */
    public function editar($id, $camposValores = array())
    {
        $this->db->where('id', $id)->update('USUARIO', $camposValores);
    }

    /**
     * ### Insere um registro na tabela Usuario.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('USUARIO', $valores);
    }

    /**
     * ### Carrega os valores do objeto instanciado com os valores de um registro da tabela Usuario. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        return $this->db->get_where('USUARIO', array('id' => $id));
    }


    /**
     * ### Lista todos os registros da tabela Usuario
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        return $this->db->get('USUARIO');
    }

    /**
     * ### Lista todos os registros da tabela Usuario que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        return $this->db->get_where('USUARIO', $camposValores);
    }

    /**
     * Ativa a Usuario encontrada com o id enviado
     * 
     * @param $id - o id da usuario a ser ativada
     */
    public function ativar($id)
    {
        $this->db->where('id', $id)->update('USUARIO', array('situacao', SituacaoUsuario::ATIVO));
    }

    /**
     * Desativa a Usuario encontrada com o id enviado
     * 
     * @param $id - o id da usuario a ser desativada
     */
    public function desativar($id)
    {
        $this->db->where('id', $id)->update('USUARIO', array('situacao', SituacaoUsuario::INATIVO));
    }


    /**
     * ### Lista os tipos dos usuários cadastrados
     * Usado para criação de relatórios.
     * O controlador Relatorio irá contar a quantidade de cada tipo
     * e retornar um JSON para ser transformado em gráfico via js
     * 
     * @return array - Array com os tipos em formatados como Objetos
     * 
     */
    public function listarTipos()
    {
        return $this->db->select('tipo')->from('USUARIO')->get();
    }

    /**
     * ### Lista todos os registros da tabela Usuario associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        return $this->db->get_where('USUARIO', array($foreignKey => $valor));
    }

    /**
     * ### Conta quantas usuarios estão cadastradas do sistema
     * 
     * @return array - array de uma posição com a quantidade de usuarios cadastradas
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('USUARIO')->count_all_results();
    }
}
