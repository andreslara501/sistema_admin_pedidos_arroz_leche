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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div id="pedido_cargar">a</div>
            </div>
        </div>
    </div>
</div>

<div id="page_contentss" style="padding: 20px 20%;">
	<br><br><br>
	<div class="row">
		<div class="col"><h1>Lista de pedidos</h1></div>
		<div class="col text-right"><input id="pedido_input" style="opacity: 0; width: 0px" type="text"></div>
	</div>


	<br>
	<br>
	<h2>Selecciona el ticket con el lector para cargar el pedido</h2>

	<br>
</div>
