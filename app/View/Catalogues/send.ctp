
<link href="https://fonts.googleapis.com/css?family=Oswald:400,700,300&effect=outline|3d|3d-float|putting-green|wallpaper" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700|Gloria+Hallelujah|Indie+Flower|Open+Sans:700,400" rel="stylesheet" type="text/css">



<div class="col-md-12 textoInicial">

<?php
echo __('A continuación encontrará el resumen de su pedido listo para enviar a su comercial. Revise todos los artículos. Si desea modificar alguno puede pulsar en el botón "Modificar / visualizar". Si todo su pedido es correcto puede añadir a continuación las observaciones que desee dirigidas a su comercial referente a este pedido. Para que su comercial procese correctamente su pedido debe pulsar en el botón "Finalizar y enviar pedido". Muchas gracias por su compra.');
?>
</div>



<div class="col-md-12" style="margin-bottom:25px;">
	<label><?php echo __('Observaciones pedido:');?></label>
	<textarea id="observations" name="observaciones" maxlength="100" style="width:100%"></textarea>
</div>



<div class="col-md-12">

	<?php 

	echo "<table class='table-striped table-resumen'><thead class='detalle'><th style='padding: 20px;'>".__('Información planta').'</th><th>'.__('Sus comentarios');
	echo "</th><th>".__('Unidades (US)')."</th><th>".__('Unidades')."</th><th>".__('Precio');
	echo "</th><th>".__('Importe')."</th></thead><tbody>";
	foreach ($cashorderdetails as $detail) {

		//debug($detail).die;
		echo "<tr><td>".$detail['description'].'<br />'.$detail['common_name'].'<br />'.$detail['name']."</td>";

		echo "<td>".$detail['observations']."</td>";

		switch ($detail['services_unit_id']) {
			case '1':
				$UnidadesServicio = __('Unidades');
				break;
			case '2':
				$UnidadesServicio = __('Cajas');
				break;
			case '3':
				$UnidadesServicio = __('Pisos');
				break;
			case '4':
				$UnidadesServicio = __('Carris');
				break;
		}
		echo "<td>".$detail['units']." ".$UnidadesServicio."</td>";
		echo "<td>".$detail['real_unities']."</td>";
		echo "<td>".$detail['price']."</td>";
		echo "<td>".($detail['price'] * $detail['real_unities'])."</td>";

		echo "</tr>";
	}
	echo "</tbody></table>";

	?>
</div>
