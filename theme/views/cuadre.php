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

<div id="page_content" class="container">
    <br><br><br>
	<div class="row">
		<div class="col"><h1>Cuadre diario</h1></div>
		<div class="col text-right">
            <input id="fecha_cuadre" class="form-control mr-sm-2" value="<?php echo $fecha;?>" type="date">
        </div>
	</div>

	<br>
    <div class="card">
        <ul class="list-group list-group-flush">
                        <li class="list-group-item"><div class="row"><div class="col-3"><strong>Pedido</strong></div><div class="col-6"><strong>Producto</strong></div><div class="col-3 text-right"><strong>Valor</strong></div></li>
	<?php
    $super_suma = 0;
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
        $super_suma = $super_suma + $suma;




						foreach($vasos AS $vaso){

                            $query = "SELECT * FROM sabor_pedido INNER JOIN sabor ON sabor_pedido.sabor = sabor.id WHERE vaso = " . $vaso["id"];
                            $resultado      = $this -> db -> query($query);

							$sabor      = $resultado      -> result_array();

							switch ($vaso["vaso"]) {
								case 1:
                                    echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong>{$pedido["id"]}</strong></div><div class=\"col-4\">Vaso grande </div><div class=\"col-2\"><span class=\"badge badge-primary\">{$sabor[0]["descripcion"]}</span></div><div class=\"col-3 text-right\">\$ 5.500</div></li>";
									break;

								case 2:
                                    echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong>{$pedido["id"]}</strong></div><div class=\"col-4\">Vaso mediano </div><div class=\"col-2\"><span class=\"badge badge-primary\">{$sabor[0]["descripcion"]}</span></div><div class=\"col-3 text-right\">\$ 4.500</div></li>";
									break;

								case 3:
                                    echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong>{$pedido["id"]}</strong></div><div class=\"col-4\">Vaso pequeño </div><div class=\"col-2\"><span class=\"badge badge-primary\">{$sabor[0]["descripcion"]}</span></div><div class=\"col-3 text-right\">\$ 3.500</div></li>";
									break;
								default:
									// code...
									break;
							}

                            //echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> - </strong></div><div class=\"col-6\"></div><div class=\"col-3 text-right\">\$ 0</div></li>";


							$query = "SELECT * FROM topping_pedido INNER JOIN topping ON topping_pedido.topping = topping.id WHERE vaso = " . $vaso["id"];
							$resultado      = $this -> db -> query($query);
					        $toppings = $resultado -> result_array();

                            foreach ($toppings as $topping){
                                echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> - </strong></div><div class=\"col-6\">&nbsp;&nbsp;&nbsp;&nbsp; - {$topping["descripcion"]}</div><div class=\"col-3 text-right\">\$ 1.000</div></li>";
                            }
						}
                            echo "<li class=\"list-group-item\" style=\" border-bottom: 3px dotted black; color: red\"><div class=\"row\"><div class=\"col-3\"><strong>  </strong></div><div class=\"col-6\">Subtotal</div><div class=\"col-3 text-right\">$ " . number_format($suma, 0, ',', '.') ."</div></li>";


	}
	?>
        </ul>
    </div>

<br>

    <div class="card" >
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><div class="row"><div class="col-9" style="font-size: 30px; font-weight:bold;">Suma total</div><div class="col-3 text-right" style="font-size: 30px; font-weight:bold;">$ <?php echo number_format($super_suma, 0, ',', '.');?></div></li>
        </ul>
    </div>
<br>
</div>
<iframe id="iframeoculto" name="iframeOcultoDX" style="width:0px; height:0px; border:0px"></iframe>
