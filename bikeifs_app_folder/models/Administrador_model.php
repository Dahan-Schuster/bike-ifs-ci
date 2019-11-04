<?php

require_once('Tools.php');

class Administrador_model extends CI_Model
{
    /**
     * Administrador constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Verifica se o login e a senha enviados como parâmetro encontram
     * um registro na tabela ADMINISTRADOR
     * 
     * @param $login - Email ou cpf do admin. O cpf será formatado com pontos e traço
     * @param $senha - Senha do admin em string. Será criptografada com md5() antes de realizar a query
     */
    public function verificarLogin($login, $senha)
    {
        $cpf = Tools::formatCnpjCpf($login);
        $this->db->where("(email='$login' OR cpf='$cpf')");
        $result = $this->db->get('ADMINISTRADOR');

        if ($result->num_rows() > 0 && password_verify($senha, $result->row()->senha))
            return  $result->row();

        return false;
    }
    
    /**
     * Exclui registros da tabela Administrador.
     * 
     * @param array $id - Os ids dos registros a serem excluídos
     */
    public function excluir($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->delete('ADMINISTRADOR');
    }

    /**
     * Edita os valores do registro na tabela Administrador.
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
     * Insere um registro na tabela Administrador.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('ADMINISTRADOR', $valores);
        return $this->db->insert_id();
    }

    /**
     * Carrega os valores do objeto instanciado com os valores de um registro da tabela Administrador. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        $result = $this->db->get_where('ADMINISTRADOR', array('id' => $id));
        return ($result->num_rows() > 0) ? $result->row() : NULL;
    }


    /**
     * Lista todos os registros da tabela Administrador
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        $result = $this->db->get('ADMINISTRADOR');
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Verifica se existe um registro com um atributo igual ao enviado por parâmetro
     * Usado para evitar duplicidade em campos UNIQUE (cpf, email, matrícula)
     */
    public function estaCadastrado($campo, $valor)
    {
        $this->db->from('ADMINISTRADOR')->where($campo, $valor);
        return $this->db->get()->num_rows() > 0;
    }

    /**
     * Lista todos os registros da tabela Administrador que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public  function listarPorCampos($camposValores)
    {
        $result = $this->db->where($camposValores)->get('ADMINISTRADOR');
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }
}
