<div class="col-md-12">
	<?php 
	echo "<table class='table-striped table-resumen'><thead class='detalle'>";
	echo "<th>".__('Línea factura')."</th>";
	echo "<th style='padding: 20px;'>".__('Información planta').'</th>';
	echo "<th>".__('Unidades')."</th><th>".__('Precio')."</th><th>".__('Total');
	echo "</th></thead><tbody>";

	foreach ($invoicedetails as $detail) {
		echo "<tr><td>".$detail['InvoiceDetail']['invoice_line']."</td><td>".$detail['description'].'<br />'.$detail['common_name'].'<br />'.$detail['name']."</td>";
		$detail = $detail['InvoiceDetail'];
		//echo "<td>".$detail['observations']."</td>";
		//echo "<td>".$detail['units']." ??? </td>";
		echo "<td>".$detail['unities']."</td>";
		echo "<td>".$detail['price']." €</td>";
		//echo "<td>".$detail['real_unities']."</td>";
		echo "<td> ".$detail['price']*$detail['unities']."</td>";
		//echo "<td>".($detail['price'] * $detail['real_unities'])." €</td>";

		echo "</tr>";
	}
	echo "</tbody></table>";

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