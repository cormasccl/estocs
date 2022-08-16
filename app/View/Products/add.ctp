<div class="products form">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Add Product'); ?></legend>
	<?php
		echo $this->Form->input('description');
		echo $this->Form->input('common_name');
		echo $this->Form->input('temperature');
		echo $this->Form->input('initial_flowering');
		echo $this->Form->input('final_flowering');
		echo $this->Form->input('max_width');
		echo $this->Form->input('max_height');
		echo $this->Form->input('fragrance');
		echo $this->Form->input('code');
		echo $this->Form->input('exposition_id');
		echo $this->Form->input('plant_type_id');
		echo $this->Form->input('irrigation_id');
		echo $this->Form->input('programming_groups_id');
		echo $this->Form->input('image');
		echo $this->Form->input('availability');
		echo $this->Form->input('FlowerColour');
		echo $this->Form->input('SheetColour');
		echo $this->Form->input('Utilization');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Expositions'), array('controller' => 'expositions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exposition'), array('controller' => 'expositions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plant Types'), array('controller' => 'plant_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plant Type'), array('controller' => 'plant_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Irrigations'), array('controller' => 'irrigations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Irrigation'), array('controller' => 'irrigations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Programming Groups'), array('controller' => 'programming_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Programming Groups'), array('controller' => 'programming_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles'), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article'), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Flower Colours'), array('controller' => 'flower_colours', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Flower Colour'), array('controller' => 'flower_colours', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sheet Colours'), array('controller' => 'sheet_colours', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sheet Colour'), array('controller' => 'sheet_colours', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilizations'), array('controller' => 'utilizations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilization'), array('controller' => 'utilizations', 'action' => 'add')); ?> </li>
	</ul>
</div>
