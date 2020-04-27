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

<div id="page_content" style="padding: 20px 30%;">
    <br><br><br>
	<div class="row">
		<div class="col"><h1>Configuracion</h1></div>
		<div class="col text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo">
                Nuevo topping
            </button>
        </div>
	</div>

	<br>

    <ul class="list-group" id="sortable">
        <li class="list-group-item ui-state-default">
            <div class="clearfix">
                <div class="row">
                    <div class="col">
                        Precio vaso pequeño
                    </div>
                    <div class="col">
                        <input id="valor_vaso_pequeno" type="number" class="campo_configuracion" style="width: 100%">
                    </div>
                </div>
            </div>
        </li>

        <li class="list-group-item ui-state-default">
            <div class="clearfix">
                <div class="row">
                    <div class="col">
                        Precio vaso mediano
                    </div>
                    <div class="col">
                        <input id="valor_vaso_mediano" type="number" class="campo_configuracion" style="width: 100%">
                    </div>
                </div>
            </div>
        </li>

        <li class="list-group-item ui-state-default">
            <div class="clearfix">
                <div class="row">
                    <div class="col">
                        Precio vaso grande
                    </div>
                    <div class="col">
                        <input id="valor_vaso_grande" type="number" class="campo_configuracion" style="width: 100%">
                    </div>
                </div>
            </div>
        </li>

        <li class="list-group-item ui-state-default">
            <div class="clearfix">
                <div class="row">
                    <div class="col">
                        Precio toppings
                    </div>
                    <div class="col">
                        <input id="valor_topping" type="number" class="campo_configuracion" style="width: 100%">
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
