<div class="plantTypes form">
<?php echo $this->Form->create('PlantType'); ?>
	<fieldset>
		<legend><?php echo __('Add Plant Type'); ?></legend>
	<?php
		echo $this->Form->input('description');
		echo $this->Form->input('code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Plant Types'), array('action' => 'index')); ?></li>
	</ul>
</div>
