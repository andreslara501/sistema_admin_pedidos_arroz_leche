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

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="navbar-brand">PANEL PEDIDOS</div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/pedidos/">Principal <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/pedidos_todos/">Todos los pedidos</a>
            </li>
            <?php
                if($_SESSION['tipo']!=0){
            ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="/sabores/">Sabores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/toppings/">Toppings</a>
                    </li>
            <?php
                }
            ?>
            <li class="nav-item">
                <a class="nav-link active" href="/pedidos_todos/">Configuración</a>
            </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">


        </form>
    </div>
</nav>

<div id="page_content" style="padding: 20px 10%;">
    <br><br><br>
	<div class="row">
		<div class="col"><h1>Configuración</h1></div>
		<div class="col text-right">

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
                                        <i id_topping=\"{$topping["id"]}\" class=\"fas fa-trash-alt eliminar_topping_botton\"></i>
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
