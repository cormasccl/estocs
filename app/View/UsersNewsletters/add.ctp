<div class="usersnewsletters form">
<?php echo $this->Form->create('Usersnewsletter'); ?>
	<fieldset>
		<legend><?php echo __('Add Usersnewsletter'); ?></legend>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('codigo_cliente');
		echo $this->Form->input('idioma');
		echo $this->Form->input('notificado_rgpd');
		echo $this->Form->input('fecha_notificacion');
		echo $this->Form->input('aceptado_rgpd');
		echo $this->Form->input('rechazado_rgpd');
		echo $this->Form->input('fecha_aceptacion');
		echo $this->Form->input('fecha_rechazo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Usersnewsletters'), array('action' => 'index')); ?></li>
	</ul>
</div>
