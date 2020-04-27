<?php

if (!defined('BASEPATH')){exit('No direct script access allowed');}
//aqui es simple preguntamos si no existe la funcion urls_amigables la podemos crear de lo contrario no se crea
if (!function_exists('logineado')) {
	//creamos la funcion y no explico mas sobre que es cada linea por que eso ya es otro tema.
	function logineado(){
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}

		$respuesta = TRUE;

        if(isset($_SESSION['usuario']) AND isset($_SESSION['password'])){
			$ci =& get_instance();
            $result =  $ci  -> db
                            -> where("usuario='" . $_SESSION['usuario'] . "' AND contrasena='" . $_SESSION['password'] . "'")
                            -> get("usuarios");
            $row = $result 	-> row_array();

            if(!count($row)){
				$respuesta = FALSE;
            }
        }else{
			$respuesta = FALSE;
        }
		return $respuesta;
	}
}
?>
