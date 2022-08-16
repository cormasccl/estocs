<div class="contacts index">
	<h2><?php echo __('Contacts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('razon_social'); ?></th>
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
	<?php foreach ($contacts as $contact): ?>
	<tr>
		<td><?php echo h($contact['Contact']['id']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['email']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['razon_social']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['tipologia']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['idioma']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['notificado_rgpd']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['fecha_notificacion']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['aceptado_rgpd']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['rechazado_rgpd']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['fecha_aceptacion']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['fecha_rechazo']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['hash']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['mailchimp_ok']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['traspasar_mailchimp']); ?>&nbsp;</td>
		<td><?php echo h($contact['Contact']['traspasar_oracle']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $contact['Contact']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contact['Contact']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contact['Contact']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $contact['Contact']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Contact'), array('action' => 'add')); ?></li>
	</ul>
</div>
