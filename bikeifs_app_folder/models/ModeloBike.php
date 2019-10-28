<?php


class ModeloBike
{

    const __default = self::URBANA;

    const URBANA = 1;
    const DOBRAVEL = 2;
    const FIXA = 3;
    const MOUNTAIN = 4;
    const SPEED = 5;
    const BMX = 6;
    const DOWNHILL = 7;
    const ELETRICA = 8;

    public static function getNomeModelo($modelo)
    {
    	switch ($modelo) {
    		case 1:
    			return 'Urbana';
    		case 2:
    			return 'Dobrável';
    		case 3:
    			return 'Fixa';
    		case 4:
    			return 'Mountain';
    		case 5:
    			return 'Speed';
    		case 6:
    			return 'BMX';
    		case 7:
    			return 'Downhill';
    		case 8:
    			return 'Elétrica';
    		default:
    			return 'Modelo não reconhecido';
    	}
    }
}
