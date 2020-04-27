<?php date_default_timezone_set('America/Bogota'); ?>

<?php
    if(isset($_SESSION['usuario']) AND isset($_SESSION['password'])){
        $result = $this -> db
                        -> where("usuario='" . $_SESSION['usuario'] . "' AND password='" . $_SESSION['password'] . "'")
                        -> get("usuario");
        $row = $result -> row_array();

        if(!is_null($row)){

        }else{
            echo
            "<script>
                swindow.location.replace('/admin/');
            </script>";
            exit("no se pudo abrir el archivo");
        }
    }else{
        echo
        "<script>
            window.location.replace('/admin/');
        </script>";
        exit("no se pudo abrir el archivo");
    }
?>


<div class="modal" id="modal_pedido" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<p>Modal body text goes here.</p>
            </div>
        </div>
    </div>
</div>

<div id="page_content" style="padding: 20px 20%;">
    <br><br><br>
	<div class="row">
		<div class="col"><h1>Lista de pedidos</h1></div>
		<div class="col text-right">
            <input id="fecha_lista_pedidos" class="form-control mr-sm-2" value="<?php echo $fecha;?>" type="date">
        </div>
	</div>

	<br>
	<?php
	foreach ($pedidos as $pedido) {

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
                        <div class=\"col text-left\" id=\"marcar_pedido_\">
                            <button type=\"button\" class=\"generar_factura btn btn-success\" id_pedido=\"{$pedido["id"]}\">Generar factura</button>
                        </div>
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
			</div>
			<br>
			<br>
			<br>
		";
	}
	?>
</div>
<iframe id="iframeoculto" name="iframeOcultoDX" style="width:0px; height:0px; border:0px"></iframe>
