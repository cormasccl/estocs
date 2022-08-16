<div class="productsCollections index">
	<h2><?php echo __('Products Collections'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('collection_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($productsCollections as $productsCollection): ?>
	<tr>
		<td><?php echo h($productsCollection['ProductsCollection']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($productsCollection['Collection']['id'], array('controller' => 'collections', 'action' => 'view', $productsCollection['Collection']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($productsCollection['Product']['description'], array('controller' => 'products', 'action' => 'view', $productsCollection['Product']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $productsCollection['ProductsCollection']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $productsCollection['ProductsCollection']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $productsCollection['ProductsCollection']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $productsCollection['ProductsCollection']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Products Collection'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Collections'), array('controller' => 'collections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection'), array('controller' => 'collections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
