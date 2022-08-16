<div class="payments index">
	<h2><?php echo __('Payments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('numdoc'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice_id'); ?></th>
			<th><?php echo $this->Paginator->sort('importe'); ?></th>
			<th><?php echo $this->Paginator->sort('payement_date'); ?></th>
			<th><?php echo $this->Paginator->sort('payement_date_limit'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('status_description'); ?></th>
			<th><?php echo $this->Paginator->sort('type_description'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($payments as $payment): ?>
	<tr>
		<td><?php echo h($payment['Payment']['id']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['created']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['User']['name'], array('controller' => 'users', 'action' => 'view', $payment['User']['id'])); ?>
		</td>
		<td><?php echo h($payment['Payment']['numdoc']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Invoice']['id'], array('controller' => 'invoices', 'action' => 'view', $payment['Invoice']['id'])); ?>
		</td>
		<td><?php echo h($payment['Payment']['importe']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['payement_date']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['payement_date_limit']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['status']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['type']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['status_description']); ?>&nbsp;</td>
		<td><?php echo h($payment['Payment']['type_description']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $payment['Payment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $payment['Payment']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $payment['Payment']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $payment['Payment']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Payment'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoices'), array('controller' => 'invoices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add')); ?> </li>
	</ul>
</div>
