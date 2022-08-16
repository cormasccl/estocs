<div class="plantTypes view">
<h2><?php echo __('Plant Type'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($plantType['PlantType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($plantType['PlantType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($plantType['PlantType']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($plantType['PlantType']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($plantType['PlantType']['code']); ?>
			&nbsp;
			<?php echo "PlantTypes/".$plantType['PlantType']['id'].".jpg";?>
		</dd>

	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Plant Type'), array('action' => 'edit', $plantType['PlantType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Plant Type'), array('action' => 'delete', $plantType['PlantType']['id']), array(), __('Are you sure you want to delete # %s?', $plantType['PlantType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Plant Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plant Type'), array('action' => 'add')); ?> </li>
	</ul>
</div>
