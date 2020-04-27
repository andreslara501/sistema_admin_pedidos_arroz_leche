<?php
	session_start();

date_default_timezone_set('America/Bogota');

defined('BASEPATH') OR exit('No direct script access allowed');

class Consolidado extends CI_Controller {
	function _output($output)
    {
        echo $this -> sanitize_output($output);
    }

	function sanitize_output($buffer) {
	    $search = array(
	        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
	        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
	        '/(\s)+/s',         // shorten multiple whitespace sequences
	        '/<!--(.|\s)*?-->/' // Remove HTML comments
	    );
	    $replace = array(
	        '>',
	        '<',
	        '\\1',
	        ''
	    );
	    $buffer = preg_replace($search, $replace, $buffer);
	    return $buffer;
	}

	public function index(){

		$fecha = date("Y-m-d");

		$data_etiquetas =[
			"titulo"		=> "Arrocito en bajo - Pedidos",
			"descripcion" 	=> "Arrocito en bajo - Pedidos",
			"img" 			=> "/theme/img/principal.jpg",
			"url" 			=> "...",
			"google" 		=> "..."
		];

		$this -> load -> model("topping");
		$toppings = $this -> topping -> todos();

		$this -> load -> model("sabor");
		$sabores = $this -> sabor -> todos();

		$this -> load -> model("pedido");
		$pedidos = $this -> pedido -> por_fecha_cuadre($fecha);

		$data["etiquetas"] 					= $data_etiquetas;
		$data["toppings_todos"] 			= $toppings;
		$data["sabores_todos"] 				= $sabores;
		$data["pedidos"] 					= $pedidos;
		$data["fecha"] 						= $fecha;

		$this -> theme_load($data);
	}

	public function por_fecha($fecha = 0){

		if($fecha == 0){
			$fecha = date("Y-m-d");
		}

		$data_etiquetas =[
			"titulo"		=> "Arrocito en bajo - Pedidos",
			"descripcion" 	=> "Arrocito en bajo - Pedidos",
			"img" 			=> "/theme/img/principal.jpg",
			"url" 			=> "...",
			"google" 		=> "..."
		];

		$this -> load -> model("topping");
		$toppings = $this -> topping -> todos();

		$this -> load -> model("sabor");
		$sabores = $this -> sabor -> todos();
		
		$this -> load -> model("pedido");
		$pedidos = $this -> pedido -> por_fecha_cuadre($fecha);

		$data["etiquetas"] 					= $data_etiquetas;
		$data["toppings_todos"] 			= $toppings;
		$data["sabores_todos"] 				= $sabores;
		$data["pedidos"] 					= $pedidos;
		$data["fecha"] 						= $fecha;

		$this -> theme_load($data);
	}

	function theme_load($data){
		$this -> load -> view('../../theme/views/start', $data);
		$this -> load -> view('../../theme/views/head', $data);
		$this -> load -> view('../../theme/views/menu');
		$this -> load -> view('../../theme/views/consolidado');
		$this -> load -> view('../../theme/views/footer');
	}

}
?>
