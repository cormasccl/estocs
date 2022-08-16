<div class="providers form">
<?php echo $this->Form->create('Provider'); ?>
	<fieldset>
		<legend><?php echo __('Edit Provider'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('email');
		echo $this->Form->input('codigo_proveedor');
		echo $this->Form->input('razon_social');
		echo $this->Form->input('direccion');
		echo $this->Form->input('poblacion');
		echo $this->Form->input('codigopostal');
		echo $this->Form->input('provincia');
		echo $this->Form->input('pais');
		echo $this->Form->input('tipologia');
		echo $this->Form->input('idioma');
		echo $this->Form->input('notificado_rgpd');
		echo $this->Form->input('fecha_notificacion');
		echo $this->Form->input('aceptado_rgpd');
		echo $this->Form->input('rechazado_rgpd');
		echo $this->Form->input('fecha_aceptacion');
		echo $this->Form->input('fecha_rechazo');
		echo $this->Form->input('hash');
		echo $this->Form->input('mailchimp_ok');
		echo $this->Form->input('traspasar_mailchimp');
		echo $this->Form->input('traspasar_oracle');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Provider.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Provider.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Providers'), array('action' => 'index')); ?></li>
	</ul>
</div>
