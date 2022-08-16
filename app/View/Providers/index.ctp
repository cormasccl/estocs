<div class="providers index">
	<h2><?php echo __('Providers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('codigo_proveedor'); ?></th>
			<th><?php echo $this->Paginator->sort('razon_social'); ?></th>
			<th><?php echo $this->Paginator->sort('direccion'); ?></th>
			<th><?php echo $this->Paginator->sort('poblacion'); ?></th>
			<th><?php echo $this->Paginator->sort('codigopostal'); ?></th>
			<th><?php echo $this->Paginator->sort('provincia'); ?></th>
			<th><?php echo $this->Paginator->sort('pais'); ?></th>
			<th><?php echo $this->Paginator->sort('tipologia'); ?></th>
			<th><?php echo $this->Paginator->sort('idioma'); ?></th>
			<th><?php echo $this->Paginator->sort('notificado_rgpd'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_notificacion'); ?></th>
			<th><?php echo $this->Paginator->sort('aceptado_rgpd'); ?></th>
			<th><?php echo $this->Paginator->sort('rechazado_rgpd'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_aceptacion'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_rechazo'); ?></th>
			<th><?php echo $this->Paginator->sort('hash'); ?></th>
			<th><?php echo $this->Paginator->sort('mailchimp_ok'); ?></th>
			<th><?php echo $this->Paginator->sort('traspasar_mailchimp'); ?></th>
			<th><?php echo $this->Paginator->sort('traspasar_oracle'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($providers as $provider): ?>
	<tr>
		<td><?php echo h($provider['Provider']['id']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['email']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['codigo_proveedor']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['razon_social']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['direccion']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['poblacion']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['codigopostal']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['provincia']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['pais']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['tipologia']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['idioma']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['notificado_rgpd']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['fecha_notificacion']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['aceptado_rgpd']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['rechazado_rgpd']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['fecha_aceptacion']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['fecha_rechazo']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['hash']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['mailchimp_ok']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['traspasar_mailchimp']); ?>&nbsp;</td>
		<td><?php echo h($provider['Provider']['traspasar_oracle']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $provider['Provider']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $provider['Provider']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $provider['Provider']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $provider['Provider']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Provider'), array('action' => 'add')); ?></li>
	</ul>
</div>
