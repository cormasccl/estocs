<?php
echo $this->Html->script(array(
	'datepicker',
), array('inline' => true));

if (!empty($this->request->data['Invoice']['fechadesde'])) {
	$fechadesde = $this->request->data['Invoice']['fechadesde'];
	$fechadesde = substr($fechadesde,3,2).'/'.substr($fechadesde,0,2).'/'.substr($fechadesde,6,4);
} else {
	$fechadesde = '';
}
if (!empty($this->request->data['Invoice']['fechahasta'])) {
	$fechahasta = $this->request->data['Invoice']['fechahasta'];
	$fechahasta = substr($fechahasta,3,2).'/'.substr($fechahasta,0,2).'/'.substr($fechahasta,6,4);
} else {
	$fechahasta = '';
}

?>
<div class="title-wrap">
<h1 class="custom-title"><?php echo __('Consulta de facturas'); ?></h1>
</div>
<div class="row form-filtro">
<?php
echo  $this->Form->create('Invoice',array('action' => 'view','class' => 'contact-form','accept-charset'=>'utf-8'));

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('factura',array('type' => 'text','label' => __('Nº factura:'),'class' => 'form-control'));
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('fechadesde',array('type' => 'text','label' => __('Fecha factura desde:'),'class' => 'form-control datepicker fecha', 'value'=>$fechadesde));
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('fechahasta',array('type' => 'text','label' => __('Fecha factura hasta:'),'class' => 'form-control datepicker fecha', 'value'=>$fechahasta));
echo "</div>";
echo "<div class='col-md-3'>";
echo $this->Form->end(__('Buscar'));
echo "</div>";
?>
</div>
<hr />

<div class="paginator"><ul>
<?php
    echo $this->Paginator->prev('<<', array('class' => 'btn btn-default prev', 'tag' => 'li'), null, array('class' => 'btn btn-default prev disabled', 'tag' => 'li'));
    echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-default', 'currentClass' => 'disabled', 'tag' => 'li'));
    echo $this->Paginator->next('>>', array('class' => 'btn btn-default next', 'tag' => 'li'), null, array('class' => 'btn btn-default next disabled', 'tag' => 'li'));
?></ul>
</div>

<div class="related col-md-12">
<table cellpadding = "0" cellspacing = "0" class='tableResults'>
<tr class='head'>
	<th class='align_center'><?php echo $this->Paginator->sort('code',__('Nº factura')); ?><i class='icon-arrow-up'></i></th>
	<th class='align_center'><?php echo $this->Paginator->sort('invoicedate',__('Fecha factura')); ?></th>
	<th class='align_center'><?php echo __('Cargo / abono'); ?></th>
	<th class='align_center'><?php echo __('Acciones')?></th>
</tr>
<?php $i = 0;

	foreach ($invoices as $invoice) { 
	?>
<tr class='content'>
	<th class='align_center'><?php echo h($invoice['Invoice']['code']); ?></th>
	<th class='align_center'><?php 
	$date = new DateTime($invoice['Invoice']['invoicedate']);
	echo h($date->format('d-m-Y'));?></th>
	<th class='align_center'><?php  
	if ($invoice['Invoice']['type']=='A') {
		echo __('Abono');
	} else {
		echo __('Cargo');
	}
	?></th>
	<th class='align_center'><?php echo '<p><i class="btn btn-default fa fa-eye">'.'  '.$this->Html->link(__('Ver detalle'),array('controller' => 'InvoiceDetails','action' => 'view',$invoice['Invoice']['id']), array('class' => 'various fancybox.ajax', 'title' => __('Ver detalle'), 'escape' => false)).'</i></p>';
	
		?></th>

	
</tr>
<?php } ?>
</table>
<style>
table th {
	background: none;
}
</style>