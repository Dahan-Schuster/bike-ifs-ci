<?php


class SituacaoBicicleta
{
    const __default = self::ATIVA;

    const ATIVA = 0;
    const INATIVA = 1;


    public static function getTipoSituacao($situacao)
    {
        switch ($situacao) {
            case 0:
                return 'Ativa';
            case 1:
                return 'Inativa';
            default:
                return 'Situação não reconhecida';
        }
    }
}
