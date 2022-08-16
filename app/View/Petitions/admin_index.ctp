<div class="petitions index">
	<h2><?php echo __('Petitions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('company_name'); ?></th>
			<th><?php echo $this->Paginator->sort('nif'); ?></th>
			<th><?php echo $this->Paginator->sort('customer'); ?></th>
			<th><?php echo $this->Paginator->sort('bill'); ?></th>
			<th><?php echo $this->Paginator->sort('amount_bill'); ?></th>
			<th><?php echo $this->Paginator->sort('initial_password'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($petitions as $petition): ?>
	<tr>
		<td><?php echo h($petition['Petition']['id']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['email']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['name']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['company_name']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['nif']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['customer']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['bill']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['amount_bill']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['initial_password']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['status']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['created']); ?>&nbsp;</td>
		<td><?php echo h($petition['Petition']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $petition['Petition']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $petition['Petition']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $petition['Petition']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $petition['Petition']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Petition'), array('action' => 'add')); ?></li>
	</ul>
</div>
