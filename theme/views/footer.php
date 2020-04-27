		<div id="page_footer">
			<!-- ** Jquery - otros -->
			<script src="/theme/libs/jquery/jquery.js"></script>
			<script src="/theme/libs/popper/popper.min.js"></script>
			<script src="/theme/libs/bootstrap/js/bootstrap.min.js"></script>

			<script src="/theme/js/basic.js"></script>
			<?php
				if(isset($script_cuadre_diario)){
					?>
						<script src="/theme/js/cuadre_diario.js"></script>
					<?php
				}
			?>
			<?php
				if(isset($script_plotteo)){
					?>
						<script src="/theme/js/plotteo.js"></script>
					<?php
				}
			?>
			<?php
				if(isset($script_suelos)){
					?>
						<script src="/theme/js/suelos.js"></script>
					<?php
				}
			?>
			<?php
				if(isset($script_peritajes)){
					?>
						<script src="/theme/js/peritajes.js"></script>
					<?php
				}
			?>
			<?php
				if(isset($script_proyectos)){
					?>
						<script src="/theme/js/proyectos.js"></script>
					<?php
				}
			?>
			<?php
				if(isset($script_tickets)){
					?>
						<script src="/theme/js/tickets.js"></script>
					<?php
				}
			?>
			<?php
				if(isset($script_cliente_responsable)){
					?>
						<script src="/theme/js/cliente_responsable.js"></script>
					<?php
				}
			?>

			<link rel="stylesheet" type="text/css" href="/theme/libs/notie/notie.min.css">
		    <script src="/theme/libs/notie/notie.min.js" type="text/javascript"></script>

			<link rel="stylesheet" type="text/css" href="/theme/libs/select2/css/select2.min.css">
			<script src="/theme/libs/select2/js/select2.min.js" type="text/javascript"></script>


			<script src="/theme/libs/autocomplete/autocomplete.js" type="text/javascript"></script>

			<?php
				if(isset($abrir_proyecto)){
			?>
				<script>
				$(document).ready(function(){
					$("#p<?php echo $abrir_proyecto;?> .abrir_proyecto").click();
				});

				</script>
			<?php
				}
			?>
		</div>
	</div>
</body>
</html>
