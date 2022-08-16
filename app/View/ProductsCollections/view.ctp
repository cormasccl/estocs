<div class="productsCollections view">
<h2><?php echo __('Products Collection'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productsCollection['ProductsCollection']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Collection'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productsCollection['Collection']['id'], array('controller' => 'collections', 'action' => 'view', $productsCollection['Collection']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productsCollection['Product']['description'], array('controller' => 'products', 'action' => 'view', $productsCollection['Product']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Products Collection'), array('action' => 'edit', $productsCollection['ProductsCollection']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Products Collection'), array('action' => 'delete', $productsCollection['ProductsCollection']['id']), array(), __('Are you sure you want to delete # %s?', $productsCollection['ProductsCollection']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Products Collections'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Products Collection'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Collections'), array('controller' => 'collections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Collection'), array('controller' => 'collections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
