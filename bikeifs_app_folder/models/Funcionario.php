<?php

require_once('Tools.php');

class Funcionario extends CI_Model
{
    /**
     * ### Funcionario constructor.
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
        $this->db->where("senha", md5($senha));

        $result = $this->db->get('FUNCIONARIO');
        return ($result->num_rows() > 0) ? $result->row() : NULL;
    }

    /**
     * ### Exclui um registro da tabela Funcionario.
     * 
     * @param $id -  O id do registro a ser excluído
     */
    public function excluir($id)
    {
        $this->db->where('id', $id)->delete('FUNCIONARIO');
    }

    /**
     * ### Edita os valores do registro na tabela Funcionario.
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
     * ### Insere um registro na tabela Funcionario.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('FUNCIONARIO', $valores);
    }

    /**
     * ### Carrega os valores do objeto instanciado com os valores de um registro da tabela Funcionario. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        return $this->db->get_where('FUNCIONARIO', array('id' => $id));
    }


    /**
     * ### Lista todos os registros da tabela Funcionario
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        return $this->db->get('FUNCIONARIO');
    }

    /**
     * ### Lista todos os registros da tabela Funcionario que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        return $this->db->get_where('FUNCIONARIO', $camposValores);
    }

    /**
     * Ativa a Funcionario encontrado com o id enviado
     * 
     * @param $id - o id do funcionário a ser ativado
     */
    public function ativar($id)
    {
        $this->db->where('id', $id)->update('FUNCIONARIO', array('situacao', SituacaoFuncionario::ATIVO));
    }

    /**
     * Desativa a Funcionario encontrado com o id enviado
     * 
     * @param $id - o id do funcionário a ser desativado
     */
    public function desativar($id)
    {
        $this->db->where('id', $id)->update('FUNCIONARIO', array('situacao', SituacaoFuncionario::INATIVO));
    }


    /**
     * ### Lista todos os registros da tabela Funcionario associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        return $this->db->get_where('FUNCIONARIO', array($foreignKey => $valor));
    }

    /**
     * ### Conta quantos funcionarios estão cadastrados do sistema
     * 
     * @return array - array de uma posição com a quantidade de funcionarios cadastrados
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('FUNCIONARIO')->count_all_results();
    }
}
