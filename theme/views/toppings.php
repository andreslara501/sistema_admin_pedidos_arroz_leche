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



<!-- Modal -->
<div class="modal fade" id="nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo topping</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="text" id="nuevo_topping" style="width: 100%" name="fname" autocomplete="false">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="nuevo_topping_botton">Agregar</button>
        </div>
    </div>
  </div>
</div>

<div id="page_content" style="padding: 20px 10%;">
    <br><br><br>
	<div class="row">
		<div class="col"><h1>Toppings</h1></div>
		<div class="col text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo">
                Nuevo topping
            </button>
        </div>
	</div>

	<br>

    <ul class="list-group" id="sortable">
    	<?php
    	foreach ($toppings as $topping) {
            echo "
                    <li class=\"list-group-item ui-state-default\" id=\"topping_{$topping["id"]}\">
                        <div class=\"clearfix\">
                            <div class=\"float-left px-3\" style=\"width: 5%; height:25px;\">
                                <input type=\"checkbox\" class=\"form-check-input topping_check\" id=\"{$topping["id"]}\"
                                ";
                                if($topping["activo"]){
                                    echo " checked ";
                                }
            echo                ">
                            </div>
                            <div class=\"float-left\" style=\"width: 95%; height:25px;\">
                                <div class=\"row\">
                                    <div class=\"col-11\">
                                        <input type=\"text\" class=\"campo_topping_actualizar\" id_topping=\"{$topping["id"]}\" style=\"width: 100%\" name=\"fname\" value=\"{$topping["descripcion"]}\">
                                    </div>
                                    <div class=\"col-1\">
                                        <i id_topping=\"{$topping["id"]}\" class=\"fas fa-trash-alt eliminar_topping_botton\" style=\"display:none\"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    ";
    	}
    	?>
    </ul>
</div>
