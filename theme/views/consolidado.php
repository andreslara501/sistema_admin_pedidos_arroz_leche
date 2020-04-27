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
		<div class="col"><h1>Consolidado</h1></div>
		<div class="col text-right">
            <input id="fecha_consolidado" class="form-control mr-sm-2" value="<?php echo $fecha;?>" type="date">
        </div>
	</div>

	<br>
    <div class="card" >
        <ul class="list-group list-group-flush">
                        <li class="list-group-item"><div class="row"><div class="col-3"><strong>Pedido</strong></div><div class="col-6"><strong>Producto</strong></div><div class="col-3 text-right"><strong>Valor</strong></div></li>
	<?php
    $super_suma = 0;
    $array_contador = array();
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
            switch ($vaso["vaso"]) {
                case 1:
                    if(!isset($array_contador["grande"])){
                        $array_contador["grande"]=0;
                    }
                    $array_contador["grande"]++;
                    break;

                case 2:
                    if(!isset($array_contador["mediano"])){
                        $array_contador["mediano"]=0;
                    }
                    $array_contador["mediano"]++;
                    break;

                case 3:
                    if(!isset($array_contador["pequeno"])){
                        $array_contador["pequeno"]=0;
                    }
                    $array_contador["pequeno"]++;
                    break;
                default:
                    // code...
                    break;
            }

            $query = "SELECT * FROM sabor_pedido WHERE vaso = " . $vaso["id"];
            $resultado      = $this -> db -> query($query);

            $sabor      = $resultado      -> result_array();


            if(!isset($array_contador["sabor_" . $sabor[0]["sabor"]])){
                $array_contador["sabor_" . $sabor[0]["sabor"]]=0;
            }
            $array_contador["sabor_" . $sabor[0]["sabor"]]++;


            $query = "SELECT * FROM topping_pedido WHERE vaso = " . $vaso["id"];
            $resultado      = $this -> db -> query($query);
            $toppings = $resultado -> result_array();

            foreach ($toppings as $topping){
                if(!isset($array_contador["topping_" . $topping["topping"]])){
                    $array_contador["topping_" . $topping["topping"]]=0;
                }
                $array_contador["topping_" . $topping["topping"]]++;
            }

        }
	}

    echo "<li class=\"list-group-item\" style=\"color: red\"><div class=\"row\"><div class=\"col-3\"><strong> Vasos </strong></div></li>";

    if(isset($array_contador["grande"])){
        echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> Vaso grande </strong></div><div class=\"col-6\">{$array_contador["grande"]}</div><div class=\"col-3 text-right\">$ " . number_format($array_contador["grande"] * 5500, 0, ',', '.') ."</div></li>";
    }else{
        echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> Vaso grande </strong></div><div class=\"col-6\">0</div><div class=\"col-3 text-right\">$ " . number_format(0, 0, ',', '.') ."</div></li>";
    }

    if(isset($array_contador["mediano"])){
        echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> Vaso mediano </strong></div><div class=\"col-6\">{$array_contador["mediano"]}</div><div class=\"col-3 text-right\">$ " . number_format($array_contador["mediano"] * 4500, 0, ',', '.') ."</div></li>";
    }else{
        echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> Vaso mediano </strong></div><div class=\"col-6\">0</div><div class=\"col-3 text-right\">$ " . number_format(0, 0, ',', '.') ."</div></li>";
    }

    if(isset($array_contador["pequeno"])){
        echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> Vaso pequeño </strong></div><div class=\"col-6\">{$array_contador["pequeno"]}</div><div class=\"col-3 text-right\">$ " . number_format($array_contador["pequeno"] * 3500, 0, ',', '.') ."</div></li>";
    }else{
        echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> Vaso pequeño </strong></div><div class=\"col-6\">0</div><div class=\"col-3 text-right\">$ " . number_format(0, 0, ',', '.') ."</div></li>";
    }

    echo "<li class=\"list-group-item\" style=\"color: red\"><div class=\"row\"><div class=\"col-3\"><strong> Sabores </strong></div></li>";

    foreach ($sabores_todos as $sabor){
        if(isset($array_contador["sabor_" . $sabor["id"]])){
            echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> {$sabor["descripcion"]} </strong></div><div class=\"col-6\">{$array_contador["sabor_" . $sabor["id"]]}</div><div class=\"col-3 text-right\">$ " . number_format(0, 0, ',', '.') ."</div></li>";
        }
    }

    echo "<li class=\"list-group-item\" style=\"color: red\"><div class=\"row\"><div class=\"col-3\"><strong> Toppings </strong></div></li>";

    foreach ($toppings_todos as $topping){
        if(isset($array_contador["topping_" . $topping["id"]])){
            echo "<li class=\"list-group-item\"><div class=\"row\"><div class=\"col-3\"><strong> {$topping["descripcion"]} </strong></div><div class=\"col-6\">{$array_contador["topping_" . $topping["id"]]}</div><div class=\"col-3 text-right\">$ " . number_format($array_contador["topping_" . $topping["id"]] * 1000, 0, ',', '.') ."</div></li>";
        }
    }


	?>
        </ul>
    </div>

    <br>

    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><div class="row"><div class="col-9" style="font-size: 30px; font-weight:bold;">Suma total</div><div class="col-3 text-right" style="font-size: 30px; font-weight:bold;">$ <?php echo number_format($super_suma, 0, ',', '.');?></div></li>
        </ul>
    </div>

    <br>

</div>
<iframe id="iframeoculto" name="iframeOcultoDX" style="width:0px; height:0px; border:0px"></iframe>
