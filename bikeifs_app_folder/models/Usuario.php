<?php

require_once('Tools.php');
require_once('../models/SituacaoUsuario.php');

class Usuario extends CI_Model
{
    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Verifica se o login e a senha enviados como parâmetro encontram
     * um registro na tabela USUARIO
     * 
     * @param $login - Email, cpf ou matrícula do usuário. O cpf será formatado com pontos e traço
     * @param $senha - Senha do usuário em string. Será criptografada com md5() antes de realizar a query
     */
    public function verificarLogin($login, $senha)
    {
        $cpf = Tools::formatCnpjCpf($login);
        $this->db->where("(email='$login' OR cpf='$cpf' OR matricula='$login')");
        $result = $this->db->get('USUARIO');

        if ($result->num_rows() > 0 && password_verify($senha, $result->row()->senha))
            return  $result->row();

        return false;
    }
    
    /**
     * Exclui registros da tabela Usuario.
     * 
     * @param array $id - Os ids dos registros a serem excluídos
     */
    public function excluir($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->delete('USUARIO');
    }

    /**
     * Edita os valores do registro na tabela Usuario.
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
     * Insere um registro na tabela Usuario.
     * 
     * @return bool - True se a query for bem sucedida, False se não.
     */
    public function inserir($valores)
    {
        $this->db->insert('USUARIO', $valores);
        return $this->db->insert_id();
    }

    /**
     * Carrega os valores do objeto instanciado com os valores de um registro da tabela Usuario. 
     * 
     * @param $id - o id do registro na tabela
     * @return bool - o registro encontrado .
     */
    public function carregarPorId($id)
    {
        $result = $this->db->get_where('USUARIO', array('id' => $id));
        return ($result->num_rows() > 0) ? $result->row() : NULL;
    }


    /**
     * Lista todos os registros da tabela Usuario
     * 
     * @return array - Array associativo com os registros e seus atributos. 
     */
    public function listarTodos()
    {
        $result = $this->db->get('USUARIO');
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Lista todos os registros da tabela Usuario que se encaixam nos atributos enviados por parâmetro.
     * 
     * @param $camposValores - array associativo com as colunas e seus valores para verificar igualdade.
     * 
     * @return - Array associativo com os registros que passaram na filtragem e seus atributos.
     * 
     */
    public function listarPorCampos($camposValores)
    {
        $result = $this->db->get_where('USUARIO', $camposValores);
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Ativa os Usuarios encontrados com os ids enviados
     * 
     * @param array $ids - os ids dos usuarios a serem ativados
     */
    public function ativar($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->update('USUARIO', array('situacao', SituacaoUsuario::ATIVO));
    }

    /**
     * Desativa os Usuarios encontrados com os ids enviados
     * 
     * @param array $id - os ids dos usuarios a serem desativados
     */
    public function desativar($ids)
    {
        foreach ($ids as $id) {
            $this->db->or_where('id', $id);
        }
        $this->db->update('USUARIO', array('situacao', SituacaoUsuario::INATIVO));
    }


    /**
     * Lista os tipos dos usuários cadastrados
     * Usado para criação de relatórios.
     * O controlador Relatorio irá contar a quantidade de cada tipo
     * e retornar um JSON para ser transformado em gráfico via js
     * 
     * @return array - Array com os tipos em formatados como Objetos
     * 
     */
    public function listarTipos()
    {
        $result = $this->db->select('tipo')->from('USUARIO')->get();
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Lista todos os registros da tabela Usuario associados à chave estrangeira enviada por parâmetro
     * 
     * @param $foreignKey - a coluna referente à chave estrangeira
     * @param $valor - o valor da chave estrangeira
     * 
     */
    public function listarPorChaveEstrangeira($foreignKey, $valor)
    {
        $result = $this->db->get_where('USUARIO', array($foreignKey => $valor));
        return ($result->num_rows() > 0) ? $result->result_array() : NULL;
    }

    /**
     * Verifica se existe um registro com um atributo igual ao enviado por parâmetro
     * Usado para evitar duplicidade em campos UNIQUE (cpf, email, matrícula)
     */
    public function estaCadastrado($campo, $valor)
    {
        $this->db->from('USUARIO')->where($campo, $valor);
        return $this->db->get()->num_rows() > 0;
    }

    /**
     * Conta quantas usuarios estão cadastradas do sistema
     * 
     * @return array - array de uma posição com a quantidade de usuarios cadastradas
     * 
     */
    public function getTotalDeLinhas()
    {
        return $this->db->from('USUARIO')->count_all_results();
    }
}
