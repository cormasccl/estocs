<?php
echo $this->Html->script(array(
  'datepicker','fancybox'
), array('inline' => false));


if (!empty($this->request->data['CashOrder']['fechadesde'])) {
	$fechadesde = $this->request->data['CashOrder']['fechadesde'];
	$fechadesde = substr($fechadesde,3,2).'/'.substr($fechadesde,0,2).'/'.substr($fechadesde,6,4);
} else {
	$fechadesde = '';
}
if (!empty($this->request->data['CashOrder']['fechahasta'])) {
	$fechahasta = $this->request->data['CashOrder']['fechahasta'];
	$fechahasta = substr($fechahasta,3,2).'/'.substr($fechahasta,0,2).'/'.substr($fechahasta,6,4);
} else {
	$fechahasta = '';
}

?>

<div class="title-wrap">
<h1 class="custom-title"><?php echo __('Consulta de pedidos'); ?></h1>
</div>
<div class="row form-filtro">
<?php
echo  $this->Form->create('CashOrder',array('action' => 'view','class'=>'form-group','accept-charset'=>'utf-8'));

//echo "<div class='col-md-3'>";
echo "<div class='form-group col-md-3'>";
echo $this->Form->input('pedido',array('id'=>'pedido','type' => 'text','label' => __('Nº pedido:'),'class' => 'form-control'));
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('fechadesde',array('type' => 'text','label' => __('Fecha pedido desde:'),'class' => 'form-control datepicker fecha', 'value'=>$fechadesde));
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('fechahasta',array('type' => 'text','label' => __('Fecha pedido hasta:'),'class' => 'form-control datepicker fecha', 'value'=>$fechahasta));
echo "</div>";
echo "<div class='col-md-3'>";
echo $this->Form->end(__('Buscar'));
echo "</div>";
?>
</div>
<hr />

<div class="paginator"><ul>
<?php
    /*echo $this->Paginator->prev('<<', array('class' => 'btn btn-default prev', 'tag' => 'button'), null, array('class' => 'btn btn-default prev disabled', 'tag' => 'button'));
    echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-default', 'currentClass' => 'disabled', 'tag' => 'button'));
    echo $this->Paginator->next('>>', array('class' => 'btn btn-default next', 'tag' => 'button'), null, array('class' => 'btn btn-default next disabled', 'tag' => 'button'));*/

    echo $this->Paginator->prev('<<', array('class' => 'btn btn-default prev', 'tag' => 'li'), null, array('class' => 'btn btn-default prev disabled', 'tag' => 'li'));
    echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-default', 'currentClass' => 'disabled', 'tag' => 'li'));
    echo $this->Paginator->next('>>', array('class' => 'btn btn-default next', 'tag' => 'li'), null, array('class' => 'btn btn-default next disabled', 'tag' => 'li'));
?></ul>
</div>

<div class="related col-md-12">
<table cellpadding = "0" cellspacing = "0" class='tableResults'>
<tr class='head'>
	<th class='align_center'><?php echo $this->Paginator->sort('id',__('Nº Pedido')); ?><i class='icon-arrow-up'></i></th>
	<th class='align_center'><?php echo $this->Paginator->sort('deliver_date',__('Fecha del pedido')); ?></th>
	<th class='align_center'><?php echo $this->Paginator->sort('status_id',__('Estado')); ?></th>
	<th class='align_center'><?php echo __('Importe total'); ?></th>
	<th class='align_center'><?php echo __('Acciones')?></th>
</tr>
<?php $i = 0;

	foreach ($cashorders as $cashorder) { 
	?>
<tr class='content'>
	<th class='align_center'><?php echo h($cashorder['CashOrder']['id_order']); ?></th>
	<th class='align_center'><?php 
	$date = new DateTime($cashorder['CashOrder']['deliver_date']);
	echo h($date->format('d/m/Y'));?></th>
	<th class='align_center'><?php echo h($cashorder['Status']['name']); ?></th>
	<th class='align_right'>
		<?php 
		$total = 0;
		foreach($cashorder['CashOrderDetail'] as $cashorderDetail) {
			$total += $cashorderDetail['price']*$cashorderDetail['real_unities'];
		}
		if (!empty($total)) {
			echo str_replace('.',',',$total). ' €';
		} else {
			echo __(' - ');
		} ?>
	</th>
	<th class='align_center'>
<?php echo '<p><i class="btn btn-default fa fa-eye">'.'  '.$this->Html->link(__('Ver detalle'),array('controller' => 'CashOrderDetails','action' => 'view',$cashorder['CashOrder']['id']), array('class' => 'various fancybox.ajax', 'title' => __('Ver detalle'), 'escape' => false)).'</i></p>';
	if (!empty($catalogue_id)) {
		echo '<p><i class="btn btn-info fa fa-copy">'.'  '.__('Duplicar pedido').'</i></p>';
	}
		?></th>
</tr>
<?php } ?>
</table>
<style>
table th {
	background: none;
}
</style>