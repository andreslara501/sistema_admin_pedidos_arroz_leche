<?php date_default_timezone_set('America/Bogota'); ?>

<div id="page_content" style="overflow:hidden">
	<h1 id="tamano" class="titulo">Escoge la base	<div id="arrastralo" class="texto_normal">Selecciona un sabor</div></h1>
	<h1 id="top" class="titulo">Escoge los toppins 	<div id="arrastralo" class="texto_normal">$1.000 C/U</div></h1>

	<img id="finalizar" src="/theme/img/finalizar.png">

	<div id="bod">
		<div id="vasos" class="row">
			<div id="vaso_1" class="vaso_general col-4 text-center">
				<img class="vaso" src="/theme/img/vasos/1.png">
				<img class="titulo_vaso" src="/theme/img/vasos/titulo_1.png">
				<div class="texto_normal">$ 5.500</div>
				<div class="contenedor">
					<div class="sabores">
						<?php
							$tipo = 1;
							foreach ($sabores as $sabor){
								echo "					    <div class=\"sabor";
								if($sabor["activo"] == "0"){
									echo " gris_desactivado";
								}
								echo"
								\" id_sabor=\"{$sabor["id"]}\" tipo=\"{$tipo}\"><img src=\"/theme/img/sabores/{$sabor["id"]}.png\"></div>";
							}
						?>
					</div>
				</div>
			</div>
			<div id="vaso_2" class="vaso_general col-4 text-center">
				<img class="vaso" src="/theme/img/vasos/2.png">
				<img class="titulo_vaso" src="/theme/img/vasos/titulo_2.png">
				<div class="texto_normal">$ 4.500</div>

				<div class="contenedor">
					<div class="sabores">
						<?php
							$tipo = 2;
							foreach ($sabores as $sabor){
								echo "					    <div class=\"sabor";
								if($sabor["activo"] == "0"){
									echo " gris_desactivado";
								}
								echo"
								\" id_sabor=\"{$sabor["id"]}\" tipo=\"{$tipo}\"><img src=\"/theme/img/sabores/{$sabor["id"]}.png\"></div>";
							}
						?>
					</div>
				</div>
			</div>
			<div id="vaso_3" class="vaso_general col-4 text-center">
				<img class="vaso" src="/theme/img/vasos/3.png">
				<img class="titulo_vaso" src="/theme/img/vasos/titulo_3.png">
				<div class="texto_normal">$ 3.500</div>

				<div class="contenedor">
					<div class="sabores">
						<?php
							$tipo = 3;
							foreach ($sabores as $sabor){
								echo "					    <div class=\"sabor";
								if($sabor["activo"] == "0"){
									echo " gris_desactivado";
								}
								echo"
								\" id_sabor=\"{$sabor["id"]}\" tipo=\"{$tipo}\"><img src=\"/theme/img/sabores/{$sabor["id"]}.png\"></div>";
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="toppings">
			<div class="x"><img src="/theme/img/atras.png"></div>
			<?php
				foreach($toppings AS $topping){
					echo "<button id_topping=\"" . $topping["id"] . "\" type=\"button\" class=\"btn btn-primary btn-lg";
					if($topping["activo"] == "0"){
						echo " d-none";
					}
					echo "
					\">" . $topping["descripcion"] . "</button>";
				}
			?>
			<div class="c"><img src="/theme/img/ok.png"></div>
		</div>
	</div>

	<div id="footer">
		<div class="row">
			<div class="col-10">
				<div id="content_resumen" style="padding: 5px; height:110px;">
					<div id="resumen">
					</div>
				</div>
			</div>
			<div class="col-2 text-right">
				<img id="logo" src="/theme/img/logo.png">
			</div>
		</div>
	</div>

	<div id="registrado">
		<div id="centra">
			¡Tu pedido ha sido registrado!
			<br>
			<div class="normal_re">Número del pedido: <span id="numero_pedido"></span></div>
			<div class="normal_re">Valor: <span id="valor_pedido"></span></div>
			<img id="ok_final" src="/theme/img/ok.png" style="display:none">
			<iframe id="iframeoculto" name="iframeOcultoDX" style="width:0px; height:0px; border:0px"></iframe>
		</div>
	</div>
</div>
