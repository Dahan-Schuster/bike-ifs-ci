<?php


class SituacaoUsuario
{
    const __default = self::ATIVO;

    const ATIVO = 0;
    const INATIVO = 1;
    const VISITANTE = 2;


    public static function getTipoSituacao($situacao)
    {
        switch ($situacao) {
            case 0:
                return 'Ativo';
            case 1:
                return 'Inativo';
            case 2:
                return 'Visitante';
            default:
                return 'Situação não reconhecida';
        }
    }
}
