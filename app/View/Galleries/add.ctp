<div class="galleries form">
<?php echo $this->Form->create('Gallery'); ?>
	<fieldset>
		<legend><?php echo __('Add Gallery'); ?></legend>
	<?php
		echo $this->Form->input('detail_id');
		echo $this->Form->input('image');
		echo $this->Form->input('principal');
		echo $this->Form->input('image_published');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Galleries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Details'), array('controller' => 'details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detail'), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>
