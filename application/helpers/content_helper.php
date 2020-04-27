<?php
//esto no es obligatorio pero por un tema de seguridad que nos dice si BASEPATH no esta definido no va a cargar
if (!defined('BASEPATH')){exit('No direct script access allowed');}
//aqui es simple preguntamos si no existe la funcion urls_amigables la podemos crear de lo contrario no se crea
if (!function_exists('holix')) {
	//creamos la funcion y no explico mas sobre que es cada linea por que eso ya es otro tema.
	function holix($url) {
		echo "holi";
	}
}
?>
