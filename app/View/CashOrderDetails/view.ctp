

<div class="col-md-12">

	<?php 

	echo "<table class='table-striped table-resumen'><thead class='detalle'>";
	echo "<th>".__('Línea pedido')."</th>";
	echo "<th style='padding: 20px;'>".__('Información planta').'</th><th>'.__('Sus comentarios');
	echo "</th><th>".__('Unidades (US)')."</th><th>".__('Unidades')."</th><th>".__('Precio');
	echo "</th><th>".__('Importe')."</th></thead><tbody>";
	$lineDetail = 1;
	$counter    = 1;
	foreach ($cashorderdetails as $detail) {
		if ($detail['CashOrderDetail']['line'] == 0) {
			$lineDetail = $counter;
		} else {
			$lineDetail = $detail['CashOrderDetail']['line'];
		}
		$counter++;
		echo "<tr><td>".$lineDetail."</td><td>".$detail['description'].'<br />'.$detail['common_name'].'<br />'.$detail['name']."</td>";
		$detail = $detail['CashOrderDetail'];
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
		echo "<td>".$detail['price']." €</td>";
		echo "<td>".($detail['price'] * $detail['real_unities'])." €</td>";

		echo "</tr>";
	}
	echo "</tbody></table>";


	if (!empty($catalogue_id)) {


echo '<p>';
		echo '<span class="btn btn-default"><i class="fa fa-copy"></i>'.'  '.$this->Html->link(__('Duplicar pedido'),array('controller' => 'CashOrderDetails','action' => 'duplicate',$this->Session->read('cash_order_id'), $cashorder_id, $catalogue_id)).'</span>';

		echo '      '.__("(Se añadirán todos los artículos que tengan disponibilidad esta semana)");

		echo '</p>';
	}


	?>
</div>
<style>
.textoInicial {
	margin-top:10px;
}
.table-resumen .detalle th  {
	padding:10px;
}
.table-resumen tr {
	border:1px #666666 solid;
}
.spaced {
	padding: 10px;
}
</style>