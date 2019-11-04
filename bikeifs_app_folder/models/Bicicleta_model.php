<?php

require_once(APPPATH . 'models/SituacaoBicicleta.php');
require_once(APPPATH . 'models/ModeloBike.php');

class Bicicleta_model extends CI_Model
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
        $result = $this->db->order_by('id_usuario', 'ASC')->get('BICICLETA');
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
     * Conta a quantidade de cada modelo dentre as bikes cadastradas
     * Usado para criação de relatórios.
     * 
     * @return array - Array com a quantidade de cada modelo de bike
     * 
     */
    public function contarModelos()
    {
        $urbanas = $this->db->where('modelo', ModeloBike::URBANA)->from('BICICLETA')->count_all_results();
        $dobraveis = $this->db->where('modelo', ModeloBike::DOBRAVEL)->from('BICICLETA')->count_all_results();
        $fixas = $this->db->where('modelo', ModeloBike::FIXA)->from('BICICLETA')->count_all_results();
        $mountains = $this->db->where('modelo', ModeloBike::MOUNTAIN)->from('BICICLETA')->count_all_results();
        $speeds = $this->db->where('modelo', ModeloBike::SPEED)->from('BICICLETA')->count_all_results();
        $bmxs = $this->db->where('modelo', ModeloBike::BMX)->from('BICICLETA')->count_all_results();
        $downhills = $this->db->where('modelo', ModeloBike::DOWNHILL)->from('BICICLETA')->count_all_results();
        $eletricas = $this->db->where('modelo', ModeloBike::ELETRICA)->from('BICICLETA')->count_all_results();
        
        return array(
            'urbanas' => $urbanas,
            'dobraveis' => $dobraveis,
            'fixas' => $fixas,
            'mountains' => $mountains,
            'speeds' => $speeds,
            'bmxs' => $bmxs,
            'downhills' => $downhills,
            'eletricas' => $eletricas
        );
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
