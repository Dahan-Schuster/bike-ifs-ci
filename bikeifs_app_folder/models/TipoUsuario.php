<?php

abstract class TipoUsuario
{
    const __default = self::ALUNO;

    const ALUNO = 1;
    const SERVIDOR = 2;
    const VISITANTE = 3;


    public static function getNomeTipo($tipo)
    {
        switch ($tipo) {
            case 1:
                return 'Aluno';
            case 2:
                return 'Servidor';
            case 3:
                return 'Visitante';
            default:
                return 'Tipo de usuário não reconhecido';
        }
    }
}
