<?php
	session_start();

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
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

		$data_etiquetas =[
			"titulo"		=> "Arrocito en bajo - Pedidos",
			"descripcion" 	=> "Arrocito en bajo - Pedidos",
			"img" 			=> "/theme/img/principal.jpg",
			"url" 			=> "...",
			"google" 		=> "..."
		];

		$this -> load -> model("sabor");
		$sabores = $this -> sabor -> todos();

		$this -> load -> model("topping");
		$toppings = $this -> topping -> todos();

		$data["etiquetas"] 					= $data_etiquetas;
		$data["toppings"] 					= $toppings;
		$data["sabores"] 					= $sabores;

		$this -> theme_load($data);
	}

	function theme_load($data){
		$this -> load -> view('../../theme/views/start', $data);
		$this -> load -> view('../../theme/views/head', $data);
		$this -> load -> view('../../theme/views/content');
		$this -> load -> view('../../theme/views/footer');
	}

}
?>
