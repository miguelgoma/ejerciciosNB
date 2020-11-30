<?php

namespace App\Traits;

trait Encriptacion
{

	private $newMensaje;
	private $letraAnterior;
	private $line;
	private $error;
 
    public function calculaEncriptacion($file) {

		$array = file($file->getRealPath());

		foreach ($array as $line => $value){

			$value = trim($value);
        	switch ($line) {
        		case '0':
        			$totales = $value;
        		break;
        		case '1':
        			$instruccionUno = $value;
        		break;
        		case '2':
        			$instruccionDos = $value;
        		break;
        		case '3':
        			$mensajeRaw = $value;
        		break;
        	}

		}

		$txt = $this->verificaInfo($totales,$instruccionUno,$instruccionDos,$mensajeRaw);

 		if(strlen($txt) == 0){
	 		$mensaje = $this->quitarRepetidos($mensajeRaw);
			$txt 	 = $this->buscaInstruccion($mensaje,$instruccionUno,$instruccionDos);
		}

        return $txt;

    }

    public function verificaInfo($totales,$instruccionUno,$instruccionDos,$mensajeRaw){

    	$error = '';
    	$totales = explode(' ', $totales);

    	$error .= (strlen($instruccionUno) != $totales[0])?"Error: Diferencia encontrada en tamaño de instruccion uno\n":"";
    	$error .= (strlen($instruccionDos) != $totales[1])?"Error: Diferencia encontrada en tamaño de instruccion dos\n":"";
    	$error .= (strlen($mensajeRaw) 	   != $totales[2])?"Error: Diferencia encontrada en tamaño de mensaje original \n":"";

    	return $error;

    }

    public function quitarRepetidos($value){

    	$letras = str_split($value);

    	$newMensaje    = '';
    	$letraAnterior = '';
    	foreach ($letras as $line => $value){
    		switch ($line) {
    			case '0':
    				$newMensaje    = $value;
	    			$letraAnterior = $value;
    			break;
    			default:
    				if($letraAnterior != $value){
    					$newMensaje .= $value;
    					$letraAnterior = $value;
    				}
    			break;
    		}

    	}

 		return $newMensaje;

    }

    public function buscaInstruccion($mensaje,$instruccionUno,$instruccionDos){

    	$txt = '';
    	$txt = (strpos($mensaje, $instruccionUno))?"SI\n":"NO\n";
    	$txt .= (strpos($mensaje, $instruccionDos))?"SI\n":"NO\n";

    	return $txt;

    }

 
}

?>