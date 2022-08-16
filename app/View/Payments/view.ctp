<?php
echo $this->Html->script(array(
	'datepicker',
), array('inline' => true));

if (!empty($this->request->data['Payment']['fechadesde'])) {
	$fechadesde = $this->request->data['Payment']['fechadesde'];
	$fechadesde = substr($fechadesde,3,2).'/'.substr($fechadesde,0,2).'/'.substr($fechadesde,6,4);
} else {
	$fechadesde = '';
}
if (!empty($this->request->data['Payment']['fechahasta'])) {
	$fechahasta = $this->request->data['Payment']['fechahasta'];
	$fechahasta = substr($fechahasta,3,2).'/'.substr($fechahasta,0,2).'/'.substr($fechahasta,6,4);
} else {
	$fechahasta = '';
}
?>

<div class="title-wrap">
<h1 class="custom-title"><?php echo __('Consulta de pagos'); ?></h1>
</div>
<div class="row form-filtro">
<?php
echo  $this->Form->create('Payment',array('action' => 'view','class' => 'contact-form','accept-charset'=>'utf-8'));

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('factura',array('type' => 'text','label' => __('Nº factura:'),'class' => 'form-control'));
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('fechadesde',array('type' => 'text','label' => __('Fecha pago desde:'),'class' => 'form-control datepicker fecha', 'value'=>$fechadesde));
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('fechahasta',array('type' => 'text','label' => __('Fecha pago hasta:'),'class' => 'form-control datepicker fecha', 'value'=>$fechahasta));
echo "</div>";

echo "<div class='form-group col-md-3'>";
$values = array(''=>'','Pagado' => __('Pagado'), 'Pendiente de pago' => __('Pendiente de pago'));
echo $this->Form->input('status',array('label' => __('Estado:'),'class' => 'form-control','options'=>$values, 'default' => ''));
echo "</div>";
//Pagado / Pendiente de pago

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
	<th class='align_center'><?php echo $this->Paginator->sort('invoice',__('Nº factura')); ?></th>
	<th class='align_right'><?php echo $this->Paginator->sort('importe',__('Importe')); ?></th>	
	<th class='align_center'><?php echo $this->Paginator->sort('payement_date',__('Fecha pago')); ?></th>
	<th class='align_center'><?php echo $this->Paginator->sort('type',__('Tipo')); ?></th>
	<th class='align_center'><?php echo $this->Paginator->sort('status',__('Estado')); ?></th>
</tr>
<?php $i = 0;

	foreach ($payments as $payment) { 
	?>
<tr class='content'>
	<th class='align_center'><?php echo h($payment['Invoice']['code']); ?></th>
	<th class='align_right'><?php echo h($payment['Payment']['importe']).' €'; ?></th>
	<th class='align_center'><?php 
	$date = new DateTime($payment['Payment']['payement_date']);
	echo h($date->format('d/m/Y'));?></th>
	<th class='align_center'><?php echo h($payment['Payment']['type_description']); ?></th>
	<th class='align_center'><?php echo h($payment['Payment']['status_description']); ?></th>
	
</tr>
<?php } ?>
</table>
<style>
table th {
	background: none;
}
.datepicker {
	text-align: center;
}
</style>



