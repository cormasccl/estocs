<div class="plantTypes form">
<?php echo $this->Form->create('PlantType'); ?>
	<fieldset>
		<legend><?php echo __('Edit Plant Type'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
		echo $this->Form->input('code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PlantType.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('PlantType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Plant Types'), array('action' => 'index')); ?></li>
	</ul>
</div>
