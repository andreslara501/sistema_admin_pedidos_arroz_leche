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
                //if($_SESSION['tipo']!=0){
            ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="/sabores/">Sabores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/toppings/">Toppings</a>
                    </li>
            <?php
                //}
            ?>
            <li class="nav-item">
                <a class="nav-link active" href="/cuadre/">Cuadre diario</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="/consolidado/">Consolidado</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" href="/login/out/">Cerrar sesión</a>
            </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">


        </form>
    </div>
</nav>
