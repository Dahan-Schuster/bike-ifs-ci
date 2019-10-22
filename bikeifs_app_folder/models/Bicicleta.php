<?php

class Bicicleta extends CI_Model
{
    /**
     * ### Bicicleta constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * ### Exclui um registro da tabela Bicicleta.
     * 
     * @param $id -  O id do registro a ser excluído
     */
    public function excluir($id)
    {
        $this->db->where('id', $id)->delete('BICICLETA');
    }

    /**
     * ### Edita os valores do registro na tabela Bicicleta.
     * 
     * @param mixed $id - id do Bicicleta a ser editado
     * @param array $camposValores - array associativo com as colunas para editar 
     *              (escritas como se apresentam no banco de dados) e seus novos valores
     */
    public function editar($id, $camposValores = array())
    {
        $this->db->where('id', $id)->update('BICICLETA', $camposValores);
    }

    /**
     * ### Insere um registro na tabela Bicicleta.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('BICICLETA', $valores);
    }

    /**
     * ### Carrega os valores do objeto instanciado com os valores de um registro da tabela Bicicleta. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        return $this->db->get_where('BICICLETA', array('id' => $id));
    }


    /**
     * ### Lista todos os registros da tabela Bicicleta
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        return $this->db->get('BICICLETA');
    }

    /**
     * ### Lista todos os registros da tabela Bicicleta que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        return $this->db->get_where('BICICLETA', $camposValores);
    }

    /**
     * Ativa a Bicicleta encontrada com o id enviado
     * 
     * @param $id - o id da bicicleta a ser ativada
     */
    public function ativar($id)
    {
        $this->db->where('id', $id)->update('BICICLETA', array('situacao', SituacaoBicicleta::ATIVA));
    }

    /**
     * Desativa a Bicicleta encontrada com o id enviado
     * 
     * @param $id - o id da bicicleta a ser desativada
     */
    public function desativar($id)
    {
        $this->db->where('id', $id)->update('BICICLETA', array('situacao', SituacaoBicicleta::INATIVA));
    }


    /**
     * ### Lista os modelos das bicicletas cadastradas
     * Usado para criação de relatórios.
     * O controlador Relatorio irá contar a quantidade de cada modelo
     * e retornar um JSON para ser transformado em gráfico via js
     * 
     * @return array - Array com os modelos em formatados como Objetos
     * 
     */
    public function listarModelos()
    {
        return $this->db->select('modelo')->from('BICICLETA')->get();
    }

    /**
     * ### Lista todos os registros da tabela Bicicleta associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        return $this->db->get_where('BICICLETA', array($foreignKey => $valor));
    }

    /**
     * ### Conta quantas bikes estão cadastradas do sistema
     * 
     * @return array - array de uma posição com a quantidade de bikes cadastradas
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('BICICLETA')->count_all_results();
    }
}
