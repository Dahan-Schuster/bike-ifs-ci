<?php

require_once('Tools.php');
require_once(APPPATH . 'models/SituacaoFuncionario.php');

class Funcionario_model extends CI_Model
{
    /**
     * Funcionario constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Verifica se o login e a senha enviados como parâmetro encontram
     * um registro na tabela FUNCIONARIO
     * 
     * @param $login - Email ou cpf do funcionáiro. O cpf será formatado com pontos e traço
     * @param $senha - Senha do funcionário em string. Será criptografada com md5() antes de realizar a query
     */
    public function verificarLogin($login, $senha)
    {
        $cpf = Tools::formatCnpjCpf($login);
        $this->db->where("(email='$login' OR cpf='$cpf')");
        $result = $this->db->get('FUNCIONARIO');

        if ($result->num_rows() > 0 && password_verify($senha, $result->row()->senha))
            return  $result->row();

        return false;
    }
    
    /**
     * Exclui registros da tabela Funcionario.
     * 
     * @param array $id - Os ids dos registros a serem excluídos
     */
    public function excluir($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->delete('FUNCIONARIO');
    }
    
    /**
     * Edita os valores do registro na tabela Funcionario.
     * 
     * @param mixed $id - id do Funcionario a ser editado
     * @param array $camposValores - array associativo com as colunas para editar 
     *              (escritas como se apresentam no banco de dados) e seus novos valores
     */
    public function editar($id, $camposValores = array())
    {
        $this->db->where('id', $id)->update('FUNCIONARIO', $camposValores);
    }

    /**
     * Insere um registro na tabela Funcionario.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('FUNCIONARIO', $valores);
        return $this->db->insert_id();
    }

    /**
     * Carrega os valores do objeto instanciado com os valores de um registro da tabela Funcionario. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        $result = $this->db->get_where('FUNCIONARIO', array('id' => $id));
        return ($result->num_rows() > 0) ? $result->row() : NULL;
    }


    /**
     * Lista todos os registros da tabela Funcionario
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        $result = $this->db->get('FUNCIONARIO');
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }


    /**
     * Lista todos os registros da tabela Funcionario que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        $result = $this->db->get_where('FUNCIONARIO', $camposValores);
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Ativa os Funcionarios encontrados com os ids enviados
     * 
     * @param array $ids - os ids dos funcionários a serem ativados
     */
    public function ativar($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->update('FUNCIONARIO', array('situacao' => SituacaoFuncionario::ATIVO));
    }

    /**
     * Desativa os Funcionarios encontrados com os ids enviados
     * 
     * @param array $ids - os ids dos funcionários a serem desativados
     */
    public function desativar($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->update('FUNCIONARIO', array('situacao' => SituacaoFuncionario::INATIVO));
    }

    /**
     * Verifica se existe um registro com um atributo igual ao enviado por parâmetro
     * Usado para evitar duplicidade em campos UNIQUE (cpf, email, matrícula)
     */
    public function estaCadastrado($campo, $valor)
    {
        $this->db->from('FUNCIONARIO')->where($campo, $valor);
        return $this->db->get()->num_rows() > 0;
    }

    /**
     * Lista todos os registros da tabela Funcionario associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        $result = $this->db->get_where('FUNCIONARIO', array($foreignKey => $valor));
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Conta quantos funcionarios estão cadastrados do sistema
     * 
     * @return array - array de uma posição com a quantidade de funcionarios cadastrados
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('FUNCIONARIO')->count_all_results();
    }
}
