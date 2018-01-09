<?php
/*
Plugin Name: Custom Functions CNA
Description: Custom functions
Version: 0.1
Author: Team Atix Plus
Author URI: http://atixplus.com/
*/

/* Cortar Texto */
function cortarTexto($texto, $numMaxCaract){
	if (strlen($texto) <  $numMaxCaract){
		$textoCortado = $texto;
	}else{
		$textoCortado = substr($texto, 0, $numMaxCaract);
		$ultimoEspacio = strripos($textoCortado, " ");
 
		if ($ultimoEspacio !== false){
			$textoCortadoTmp = substr($textoCortado, 0, $ultimoEspacio);
			if (substr($textoCortado, $ultimoEspacio)){
				$textoCortadoTmp .= '...';
			}
			$textoCortado = $textoCortadoTmp;
		}elseif (substr($texto, $numMaxCaract)){
			$textoCortado .= '...';
		}
	}
 
	return $textoCortado;
}

?>