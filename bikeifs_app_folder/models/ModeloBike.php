<?php


class ModeloBike
{

    const __default = self::URBANA;

    const URBANA = 0;
    const DOBRAVEL = 1;
    const FIXA = 2;
    const MOUNTAIN = 3;
    const SPEED = 4;
    const BMX = 5;
    const DOWNHILL = 6;
    const ELETRICA = 7;

    public static function getNomeModelo($modelo)
    {
    	switch ($modelo) {
    		case 0:
    			return 'Urbana';
    		case 1:
    			return 'Dobrável';
    		case 2:
    			return 'Fixa';
    		case 3:
    			return 'Mountain';
    		case 4:
    			return 'Speed';
    		case 5:
    			return 'BMX';
    		case 6:
    			return 'Downhill';
    		case 7:
    			return 'Elétrica';
    		default:
    			return 'Modelo não reconhecido';
    	}
    }
}
