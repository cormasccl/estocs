<div class="productsCollections form">
<?php echo $this->Form->create('ProductsCollection'); ?>
	<fieldset>
		<legend><?php echo __('Edit Products Collection'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('collection_id');
		echo $this->Form->input('product_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProductsCollection.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ProductsCollection.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Products Collections'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Collections'), array('controller' => 'collections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection'), array('controller' => 'collections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
