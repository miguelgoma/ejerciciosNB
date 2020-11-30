<?php

namespace App\Traits;

trait Juego
{
 
 	private $line;
 	private $expVals;
 	private $jugadorUno;
 	private $jugadorDos;
 	private $numeroMaximo;
 	private $numeroMinimo;
 	private $diferenciaActual;
 	private $diferenciaAnterior;
 	private $totalRondas;

    public function calculaJuego($file) {

    	$array = file($file->getRealPath());

    	$diferenciaAnterior  = 0;
		foreach ($array as $line => $value)
       	{

        	if($line == 0){
        		$value = trim($value);
				$totalRondas = $this->validateLine($value);
           	}else{

           		$expVals 	  = explode(' ', $value);
           		$jugadorUno   = trim($expVals[0]);
           		$jugadorDos   = trim($expVals[1]);

	           	$numeroMaximo = max($jugadorUno, $jugadorDos);
	           	$numeroMinimo = min($jugadorUno, $jugadorDos);
	           	$diferenciaActual   = $numeroMaximo - $numeroMinimo;

	           	$ganador = ($jugadorUno>$jugadorDos)?1:2;
	           	
	           	if($diferenciaActual>$diferenciaAnterior){
	           		$jugadorGanador = $ganador;
	           		$diferencia 	= $diferenciaActual;
	           		$diferenciaAnterior = $diferenciaActual;
	           	}

           	}

       	}

    	$txt = $jugadorGanador.' '.$diferencia;
    	return $txt;
 
    }

    public function validateLine($value){

    	if(!is_numeric($value)){
    		echo "No es numero ".$value.' el programa no funcionara correctamente';
    	}
    }
 
}

?>