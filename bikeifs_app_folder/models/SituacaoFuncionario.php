<?php


class SituacaoFuncionario
{
    const __default = self::ATIVO;

    const ATIVO = 0;
    const INATIVO = 1;


    public static function getTipoSituacao($situacao)
    {
        switch ($situacao) {
            case 0:
                return 'Ativo';
            case 1:
                return 'Inativo';
            default:
                return 'Situação não reconhecida';
        }
    }
}
