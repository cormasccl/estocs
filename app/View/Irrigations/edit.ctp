<div class="irrigations form">
<?php echo $this->Form->create('Irrigation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Irrigation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
		echo $this->Form->input('image');
		echo $this->Form->input('code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Irrigation.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Irrigation.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Irrigations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>