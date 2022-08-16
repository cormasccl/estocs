<div class="growings form">
<?php echo $this->Form->create('Growing'); ?>
	<fieldset>
		<legend><?php echo __('Edit Growing'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Growing.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Growing.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Growings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Details'), array('controller' => 'details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detail'), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>
