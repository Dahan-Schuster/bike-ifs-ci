<?php

require_once(APPPATH . 'models/SituacaoBicicleta.php');

class Bicicleta extends CI_Model
{
    /**
     * Bicicleta constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Exclui registros da tabela Bicicleta.
     * 
     * @param array $id - Os ids dos registros a serem excluídos
     */
    public function excluir($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->delete('BICICLETA');
    }

    /**
     * Edita os valores do registro na tabela Bicicleta.
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
     * Insere um registro na tabela Bicicleta.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('BICICLETA', $valores);
        return $this->db->insert_id();
    }

    /**
     * Carrega os valores do objeto instanciado com os valores de um registro da tabela Bicicleta. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        $result = $this->db->get_where('BICICLETA', array('id' => $id));
        return ($result->num_rows() > 0) ? $result->row() : NULL;
    }


    /**
     * Lista todos os registros da tabela Bicicleta
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        $result = $this->db->get('BICICLETA');
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Lista todos os registros da tabela Bicicleta que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        $result = $this->db->get_where('BICICLETA', $camposValores);
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Ativa as Bicicletas encontradas com o array de IDs enviado
     * 
     * @param array $ids - os ids das bicicletas a seresm ativadas
     */
    public function ativar($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->update('BICICLETA', array('situacao' => SituacaoBicicleta::ATIVA));
    }

    /**
     * Destiva as Bicicletas encontradas com o array de IDs enviado
     * 
     * @param array $ids - os ids das bicicletas a seresm desativadas
     */
    public function desativar($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->update('BICICLETA', array('situacao' => SituacaoBicicleta::INATIVA));
    }


    /**
     * Lista os modelos das bicicletas cadastradas
     * Usado para criação de relatórios.
     * O controlador Relatorio irá contar a quantidade de cada modelo
     * e retornar um JSON para ser transformado em gráfico via js
     * 
     * @return array - Array com os modelos em formatados como Objetos
     * 
     */
    public function listarModelos()
    {
        $result = $this->db->select('modelo')->get('BICICLETA');
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Lista todos os registros da tabela Bicicleta associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        $result = $this->db->get_where('BICICLETA', array($foreignKey => $valor));
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Verifica se existe um registro com um atributo igual ao enviado por parâmetro
     * Usado para evitar duplicidade em campos UNIQUE (cpf, email, matrícula)
     */
    public function estaCadastrado($campo, $valor)
    {
        $this->db->from('BICICLETA')->where($campo, $valor);
        return $this->db->get()->num_rows() > 0;
    }

    /**
     * Conta quantas bikes estão cadastradas do sistema
     * 
     * @return array - array de uma posição com a quantidade de bikes cadastradas
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('BICICLETA')->count_all_results();
    }
}
