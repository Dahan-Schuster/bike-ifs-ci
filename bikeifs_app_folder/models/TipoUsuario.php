<?php

abstract class TipoUsuario
{
    const __default = self::ALUNO;

    const ALUNO = 0;
    const SERVIDOR = 1;
    const VISITANTE = 2;


    public static function getNomeTipo($tipo)
    {
        switch ($tipo) {
            case 0:
                return 'Aluno';
            case 1:
                return 'Servidor';
            case 2:
                return 'Visitante';
            default:
                return 'Tipo de usuário não reconhecido';
        }
    }
}
