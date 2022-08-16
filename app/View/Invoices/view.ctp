<?php
	echo $this->Html->script(array('datepicker','fancybox'), array('inline' => false));

if (!empty($this->request->data['Invoice']['fechadesde'])) {
	$fechadesde = $this->request->data['Invoice']['fechadesde'];
	$fechadesde = substr($fechadesde,0,2).'/'.substr($fechadesde,3,2).'/'.substr($fechadesde,6,4);
} else {
	$fechadesde = '';
}
if (!empty($this->request->data['Invoice']['fechahasta'])) {
	$fechahasta = $this->request->data['Invoice']['fechahasta'];
	$fechahasta = substr($fechahasta,3,2).'/'.substr($fechahasta,0,2).'/'.substr($fechahasta,6,4);
} else {
	$fechahasta = '';
}




if (!empty($filter_fecha_desde)) {
	$filter_fecha_desde = substr($filter_fecha_desde,5,2).'/'.substr($filter_fecha_desde,8,2).'/'.substr($filter_fecha_desde,0,4);
	//$filter_fecha_desde = substr($filter_fecha_desde,3,2).'/'.substr($filter_fecha_desde,0,2).'/'.substr($filter_fecha_desde,6,4);
} else {
	$filter_fecha_desde = '';
}

if (!empty($filter_fecha_hasta)) {
	$filter_fecha_hasta = substr($filter_fecha_hasta,5,2).'/'.substr($filter_fecha_hasta,8,2).'/'.substr($filter_fecha_hasta,0,4);
	//$filter_fecha_hasta = substr($filter_fecha_hasta,3,2).'/'.substr($filter_fecha_hasta,0,2).'/'.substr($filter_fecha_hasta,6,4);
} else {
	$filter_fecha_hasta = '';
}


?>
<div class="title-wrap">
<h1 class="custom-title"><?php echo __('Consulta de facturas'); ?></h1>
</div>
<div class="row form-filtro">
<?php
echo  $this->Form->create('Invoices',array('type'=>'get','action' => 'view','class' => 'contact-form','accept-charset'=>'utf-8'));


echo "<div class='form-group col-md-3'>";

echo "<label for ='InvoicesFactura'>".__('Nº Factura:')."</label>";
echo "<input name='data[Invoices][factura]' class='form-control' type='text' id='InvoicesFactura' value='".$filter_factura."'>";

/* echo $this->Form->input('factura',array('type' => 'text','label' => __('Nº factura:'),'class' => 'form-control'));*/
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo "<label for ='InvoicesFechaDesde'>".__('Fecha factura desde:')."</label>";
echo "<input name='data[Invoices][fecha_desde]' class='form-control datepicker fecha' type='text' id='InvoicesFechaDesde' value='".$filter_fecha_desde."'>";
/*echo $this->Form->input('fechadesde',array('type' => 'text','label' => __('Fecha factura desde:'),'class' => 'form-control datepicker fecha', 'value'=>$fechadesde));*/
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo "<label for ='InvoicesFechaHasta'>".__('Fecha factura hasta:')."</label>";
echo "<input name='data[Invoices][fecha_hasta]' class='form-control datepicker fecha' type='text' id='InvoicesFechaHasta' value='".$filter_fecha_hasta."'>";
/*echo $this->Form->input('fechahasta',array('type' => 'text','label' => __('Fecha factura hasta:'),'class' => 'form-control datepicker fecha', 'value'=>$fechahasta));*/
echo "</div>";
echo "<div class='col-md-3'>";
echo $this->Form->end(__('Buscar'));
echo "</div>";
?>
</div>
<hr />

<!--<div class="paginator"><ul>-->
<?php
 /*   echo $this->Paginator->prev('<<', array('class' => 'btn btn-default prev', 'tag' => 'li'), null, array('class' => 'btn btn-default prev disabled', 'tag' => 'li'));
    echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-default', 'currentClass' => 'disabled', 'tag' => 'li'));
    echo $this->Paginator->next('>>', array('class' => 'btn btn-default next', 'tag' => 'li'), null, array('class' => 'btn btn-default next disabled', 'tag' => 'li'));*/
?><!--</ul>
</div>-->

<div class="related col-md-12">
<table id="invoices-grid" cellpadding = "0" cellspacing = "0" class='tableResults'>
<!--<tr class='head'>
	<th class='align_center'><?php echo $this->Paginator->sort('code',__('Nº factura')); ?><i class='icon-arrow-up'></i></th>
	<th class='align_center'><?php echo $this->Paginator->sort('invoicedate',__('Fecha factura')); ?></th>
	<th class='align_center'><?php echo __('Albarán / devolución'); ?></th>
	<th class='align_center'><?php echo $this->Paginator->sort('invoice_total',__('Importe total')); ?></th>
	<th class='align_center'><?php echo __('Acciones')?></th>
</tr>-->

<tr class='head'>
	<th class='align_center'><?php echo __('Nº factura'); ?><i class='icon-arrow-up'></i></th>
	<th class='align_center'><?php echo __('Fecha factura'); ?></th>
	<th class='align_center'><?php echo __('Albarán / devolución'); ?></th>
	<th class='align_center'><?php echo __('Importe total'); ?></th>
	<th class='align_center'><?php echo __('Acciones')?></th>
</tr>

<?php $i = 0;

	foreach ($invoices as $invoice) { 
	?>
<tr class='post content'>
	<th class='align_center'><?php echo h($invoice['Invoice']['code']); ?></th>
	<th class='align_center'><?php 
	$date = new DateTime($invoice['Invoice']['invoicedate']);
	echo h($date->format('d-m-Y'));?></th>
	<th class='align_center'><?php  
	$textoAlbaranDevolucion = ($invoice['Invoice']['type']=='A') ? __('Albarán') : __('Devolución');
	echo $textoAlbaranDevolucion;
	?></th>
	<th class='align_center'>
		<?php 
		echo $invoice['Invoice']['invoice_total'].' €';
		?>
	</th>
	<th class='align_center'>
		<?php 
		if ($invoice['Invoice']['pdf']) {
			echo "<a href='https://www.corma.es/intranet/factures/".$invoice['Invoice']['code'].".pdf' target='_blank'>";
			echo $this->Html->image('pdf.png', array('alt' => __('Descargar factura en PDF'), 'title' => __('Descargar factura en PDF'), 'width'=>'24px'));
			echo "</a>";
		}
		if ($invoice['Invoice']['excel']) {
			echo "<a href='https://www.corma.es/intranet/factures/".$invoice['Invoice']['code'].".xls' target='_blank'>";
			echo $this->Html->image('excel.png', array('alt' => __('Descargar factura en Excel'), 'title' => __('Descargar factura en Excel'), 'width'=>'24px'));
			echo "</a>";
		}
		?>
	</th>
</tr>
<?php } ?>
</table>
<style>
table th {
	background: none;
}
</style>




<?php
    
    if (isset($next)) {
        echo "<div id='pagination'>";
        $url = SERVER."invoices/view/".$next;
        

        echo "  <a href='".$url.$param."' class='next'>".__('Siguiente página')."</a>";
        //echo "  <a href='".SERVER."Stocks/index/".$next."' class='next'>".__('Siguiente página')."</a>";
        echo "</div>";


    }
    ?>


<script type="text/javascript">
 var ias = jQuery.ias({
    container:  '#invoices-grid',
    item:       '.post',
    pagination: '#pagination',
    next:       '#pagination a.next'
  });

  ias.extension(new IASSpinnerExtension());
  ias.extension(new IASTriggerExtension({offset: 1000, text: "Carrega mes dades"}));
  ias.extension(new IASNoneLeftExtension({text: ""}));
  ias.extension(new IASPagingExtension());
  //ias.extension(new IASHistoryExtension({prev: '#pagination a.prev'}));
</script>