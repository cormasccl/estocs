<div class="expositions index">
	<h2><?php echo __('Expositions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('image'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($expositions as $exposition): ?>
	<tr>
		<td><?php echo h($exposition['Exposition']['id']); ?>&nbsp;</td>
		<td><?php echo h($exposition['Exposition']['created']); ?>&nbsp;</td>
		<td><?php echo h($exposition['Exposition']['modified']); ?>&nbsp;</td>
		<td><?php echo h($exposition['Exposition']['description']); ?>&nbsp;</td>
		<td><?php echo h($exposition['Exposition']['image']); ?>&nbsp;</td>
		<td><?php echo h($exposition['Exposition']['code']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $exposition['Exposition']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $exposition['Exposition']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $exposition['Exposition']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $exposition['Exposition']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Exposition'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
