<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');
class Api extends CI_Controller{
	public function index(){
		echo "hola ;)";
	}

	public function marcar_pedido($id = 0){
		$this -> load -> model("pedido");
		$this -> pedido -> marcar_pedido($id);
	}

	public function configuracion($accion = 0, $id=0){
		$data = $this -> input -> post();

		switch ($accion){
			case 'actualizar':
				$this -> load -> model("sabor");
				$this -> sabor -> actualizar_sabor($id, $data["descripcion"]);

				break;
		}
	}

	public function sabores($accion = 0, $id=0){
		$data = $this -> input -> post();

		switch ($accion){
			case 'estado':
				$this -> load -> model("sabor");
				$this -> sabor -> estado($id, $data["estado"]);

				break;

			case 'actualizar_sabor':
				$this -> load -> model("sabor");
				$this -> sabor -> actualizar_sabor($id, $data["descripcion"]);

				break;

			case 'nuevo_sabor':
				$this -> load -> model("sabor");
				echo $this -> sabor -> nuevo_sabor($data["descripcion"]);
				break;

			case 'eliminar_sabor':
				$this -> load -> model("sabor");
				echo $this -> sabor -> eliminar_sabor($id);
				break;
			default:
				// code...
				break;
		}
	}

	public function toppings($accion = 0, $id=0){
		$data = $this -> input -> post();

		switch ($accion){
			case 'actualizar_topping':
				$this -> load -> model("topping");
				$this -> topping -> actualizar_topping($id, $data["descripcion"]);

				break;

			case 'nuevo_topping':
				$this -> load -> model("topping");
				echo $this -> topping -> nuevo_topping($data["descripcion"]);
				break;

			case 'eliminar_topping':
				$this -> load -> model("topping");
				echo $this -> topping -> eliminar_topping($id);
				break;

			case 'estado':
				$this -> load -> model("topping");
				$this -> topping -> estado($id, $data["estado"]);

				break;
			default:
				// code...
				break;
		}
	}

	public function info_pedido($id = 0){

		$id = substr($id , 0 , -1);

		$informacion    = $this 			-> db
											-> where("id = " . $id)
                                            -> order_by("id","DESC")
							 				-> get('pedido');
		$pedido      = $informacion      -> result_array();

		$pedido = $pedido[0];

		$suma = 0;

		$vasos    	= $this 			-> db
											-> where("pedido = " . $pedido["id"])
											-> order_by("id","DESC")
											-> get('vaso_pedido');
		$vasos      = $vasos      -> result_array();

		foreach($vasos AS $vaso){
			switch ($vaso["vaso"]) {
				case 1:
					$suma = $suma + 5500;
					break;

				case 2:
					$suma = $suma + 4500;
					break;

				case 3:
					$suma = $suma + 3500;
					break;
				default:
					// code...
					break;
			}

			$query = "SELECT * FROM topping_pedido INNER JOIN topping ON topping_pedido.topping = topping.id WHERE vaso = " . $vaso["id"];
			$resultado      = $this -> db -> query($query);
			$toppings = $resultado -> result_array();

			$suma_toppings = count($toppings) * 1000;

			$suma = $suma + $suma_toppings;

		}


		echo "
			<div class=\"card\" id=\"pedido_" . $pedido["id"] ."\">
			  <div class=\"card-header\">
					<div class=\"row\">
						<div class=\"col\" style=\"font-size: 27px; font-weight: bold;\">{$pedido["id"]}</div>
						<div class=\"col text-right\" style=\"font-size: 27px; font-weight: bold; color: red\">$ " . number_format($suma, 0, ',', '.') ."</div>
					</div>
			  </div>
			  <ul class=\"list-group list-group-flush\">

						";

						foreach($vasos AS $vaso){
							echo "
							<li class=\"list-group-item\">
								<div class=\"row\">
								";
							switch ($vaso["vaso"]) {
								case 1:
									echo "<div class=\"col text-center\"><strong>Vaso grande</strong><br><img src=\"/theme/img/vasos/" . $vaso["vaso"] . ".png\" style=\"width: 100px;\"></div>";
									break;

								case 2:
									echo "<div class=\"col text-center\"><strong>Vaso mediano</strong><br><img src=\"/theme/img/vasos/" . $vaso["vaso"] . ".png\" style=\"width: 100px;\"></div>";
									break;

								case 3:
									echo "<div class=\"col text-center\"><strong>Vaso pequeño</strong><br><img src=\"/theme/img/vasos/" . $vaso["vaso"] . ".png\" style=\"width: 100px;\"></div>";
									break;
								default:
									// code...
									break;
							}

							$sabor    	= $this 			-> db
																-> where("vaso = " . $vaso["id"])
																-> order_by("id","DESC")
																-> get('sabor_pedido');
							$sabor      = $sabor      -> result_array();


							echo "<div class=\"col text-center\"><img src=\"/theme/img/sabores/" . $sabor[0]["sabor"] . ".png\" style=\"width: 100px;\"></div>";


							$query = "SELECT * FROM topping_pedido INNER JOIN topping ON topping_pedido.topping = topping.id WHERE vaso = " . $vaso["id"];
							$resultado      = $this -> db -> query($query);
							$toppings = $resultado -> result_array();

							echo "
								<div class=\"col\">
									<ul class=\"list-group list-group-flush\">";
									foreach ($toppings as $topping){
										echo "<li class=\"list-group-item\">" . $topping["descripcion"] ."</li>";
									}

							echo "
									</ul>
								</div>
								</div>
							</li>
								";
						}
		echo "

			  </ul>
			  <div class=\"card-footer\">
					<div class=\"row\">
						<div class=\"col text-right\" id=\"marcar_pedido_\">";
							if(!$pedido["realizado"]){
								echo "<button type=\"button\" class=\"marcar_pedido btn btn-primary\" id_pedido=\"{$pedido["id"]}\">Pendiente</button>";
							}else{
								echo "Entregado";
							}
							echo "
						</div>
					</div>
			  </div>
			</div>";

	}


	public function info_pedido_json($id = 0){
		$array_pedido = array();

		$informacion    = $this 			-> db
											-> where("id = " . $id)
                                            -> order_by("id","DESC")
							 				-> get('pedido');
		$pedido      = $informacion      -> result_array();

		$pedido = $pedido[0];
		$array_pedido["pedido"] = $pedido;

		$suma = 0;

		$vasos    	= $this 			-> db
											-> where("pedido = " . $pedido["id"])
											-> order_by("id","DESC")
											-> get('vaso_pedido');
		$vasos      = $vasos      -> result_array();

		foreach($vasos AS $vaso){
			switch ($vaso["vaso"]) {
				case 1:
					$suma = $suma + 5500;
					$array_pedido["vasos"][(int)$vaso["id"]]["id"] = (int)$vaso["id"];
					$array_pedido["vasos"][(int)$vaso["id"]]["tipo"] = (int)$vaso["vaso"];
					$array_pedido["vasos"][(int)$vaso["id"]]["valor"] = 5500;

					break;

				case 2:
					$suma = $suma + 4500;
					$array_pedido["vasos"][(int)$vaso["id"]]["id"] = (int)$vaso["id"];
					$array_pedido["vasos"][(int)$vaso["id"]]["tipo"] = (int)$vaso["vaso"];
					$array_pedido["vasos"][(int)$vaso["id"]]["valor"] = 4500;

					break;

				case 3:
					$suma = $suma + 3500;
					$array_pedido["vasos"][(int)$vaso["id"]]["id"] = (int)$vaso["id"];
					$array_pedido["vasos"][(int)$vaso["id"]]["tipo"] = (int)$vaso["vaso"];
					$array_pedido["vasos"][(int)$vaso["id"]]["valor"] = 3500;

					break;
				default:
					// code...
					break;
			}

			$query = "SELECT * FROM sabor_pedido INNER JOIN sabor ON sabor_pedido.sabor = sabor.id WHERE vaso = " . $vaso["id"];
			$resultado      = $this -> db -> query($query);
			$sabor = $resultado -> result_array();


			$query = "SELECT * FROM topping_pedido INNER JOIN topping ON topping_pedido.topping = topping.id WHERE vaso = " . $vaso["id"];
			$resultado      = $this -> db -> query($query);
			$toppings = $resultado -> result_array();

			$suma_toppings = count($toppings) * 1000;

			$suma = $suma + $suma_toppings;

			$array_pedido["vasos"][(int)$vaso["id"]]["sabor"] = $sabor[0]["descripcion"];
			$array_pedido["vasos"][(int)$vaso["id"]]["toppings"] = $toppings;
		}

		$array_pedido["suma"] = $suma;

		echo json_encode($array_pedido);
	}

	public function prueba(){
		$data = $this -> input -> post();

		$this -> load -> model("pedido");
		$array_pedido["fecha"] = date("Y-m-d");
		$array_pedido["valor"] = "0";
		$pedido = $this -> pedido -> nuevo_pedido($array_pedido);

		$suma = 0;

		foreach ($data["vasos"] as $vaso){

			switch ($vaso["id_vaso"]) {
				case 1:
					$suma = $suma + 5500;
					break;

				case 2:
					$suma = $suma + 4500;
					break;

				case 3:
					$suma = $suma + 3500;
					break;

				default:
					// code...
					break;
			}

			$array_vaso["pedido"] 	= $pedido;
			$array_vaso["vaso"] 	= $vaso["id_vaso"];
			$vaso_resultado = $this -> pedido -> nuevo_vaso_pedido($array_vaso);

			$array_sabor["vaso"] 	= $vaso_resultado;
			$array_sabor["sabor"] 	= $vaso["sabor"];

			$sabor = $this -> pedido -> nuevo_sabor_pedido($array_sabor);


			foreach ($vaso["toppings"] as $topping){

				if($topping!=1){
					$suma = $suma + 1000;

					$array_topping["vaso"] 		= $vaso_resultado;
					$array_topping["topping"] 	= $topping;

					$topping_resultado = $this -> pedido -> nuevo_topping_pedido($array_topping);
				}
			}
		}

		$info_final["pedido"] = $pedido;
		$info_final["valor"] = $suma;

		$this -> pedido -> total_pedido_actualizar($pedido, $suma);

		echo json_encode($info_final);
	}

	public function clear_caracteres($string){
		$string_explode = explode("/", $string);
		foreach ($string_explode as &$tmp_explode){
			$tmp_explode = filter_var($tmp_explode, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
			$tmp_explode = htmlentities($tmp_explode);
			$tmp_explode = str_replace(" ", "_", $tmp_explode);
			$tmp_explode = preg_replace('/[^a-z0-9_\.]/', '', strtolower($tmp_explode));
		}

		return implode("/", $string_explode);
	}

	public function numeros_limpios($texto = "error"){
		return preg_replace("/\D/", "", $texto);
	}
}
?>
