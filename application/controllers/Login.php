<?php

session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* establecer la caducidad de la caché a 30 minutos */
session_cache_expire(480);
$cache_expire = session_cache_expire();

session_start();
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');
class Login extends CI_Controller
{
	public function index(){
		echo "hola ;)";
	}

	public function login_form(){
		$data = $this -> input -> post();

		if(isset($data["usuario"]) AND isset($data["password"])){
			$result = $this -> db
	                        -> where("usuario='" . $data["usuario"] . "' AND password='" . $data["password"] . "'")
	                        -> get("usuario");
			$row = $result -> row_array();

			if(!is_null($row)){
				echo json_encode(1);
				$_SESSION['usuario'] 			= $data["usuario"];
				$_SESSION['password'] 			= $data["password"];
				//$_SESSION['nombre'] 			= $row["nombre"];
				$_SESSION['tipo'] 				= $row["tipo"];
			}else{
				echo json_encode(0);
			}
		}
	}

	public function out() {
		$_SESSION['usuario'] = "";
		$_SESSION['password'] = "";
		session_destroy();

		echo
		"<script>
			window.location.replace('/admin/');
		</script>";
	}
}
?>
