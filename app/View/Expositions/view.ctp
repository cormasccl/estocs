<div class="expositions view">
<h2><?php echo __('Exposition'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($exposition['Exposition']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($exposition['Exposition']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($exposition['Exposition']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($exposition['Exposition']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo h($exposition['Exposition']['image']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($exposition['Exposition']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Exposition'), array('action' => 'edit', $exposition['Exposition']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Exposition'), array('action' => 'delete', $exposition['Exposition']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $exposition['Exposition']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Expositions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exposition'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Products'); ?></h3>
	<?php if (!empty($exposition['Product'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Common Name'); ?></th>
		<th><?php echo __('Temperature'); ?></th>
		<th><?php echo __('Initial Flowering'); ?></th>
		<th><?php echo __('Final Flowering'); ?></th>
		<th><?php echo __('Floration'); ?></th>
		<th><?php echo __('Max Width'); ?></th>
		<th><?php echo __('Max Height'); ?></th>
		<th><?php echo __('Fragrance'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th><?php echo __('Exposition Id'); ?></th>
		<th><?php echo __('Plant Type Id'); ?></th>
		<th><?php echo __('Irrigation Id'); ?></th>
		<th><?php echo __('Programming Group Id'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th><?php echo __('Availability'); ?></th>
		<th><?php echo __('Temperature Id'); ?></th>
		<th><?php echo __('Published'); ?></th>
		<th><?php echo __('Family Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($exposition['Product'] as $product): ?>
		<tr>
			<td><?php echo $product['id']; ?></td>
			<td><?php echo $product['created']; ?></td>
			<td><?php echo $product['modified']; ?></td>
			<td><?php echo $product['description']; ?></td>
			<td><?php echo $product['common_name']; ?></td>
			<td><?php echo $product['temperature']; ?></td>
			<td><?php echo $product['initial_flowering']; ?></td>
			<td><?php echo $product['final_flowering']; ?></td>
			<td><?php echo $product['floration']; ?></td>
			<td><?php echo $product['max_width']; ?></td>
			<td><?php echo $product['max_height']; ?></td>
			<td><?php echo $product['fragrance']; ?></td>
			<td><?php echo $product['code']; ?></td>
			<td><?php echo $product['exposition_id']; ?></td>
			<td><?php echo $product['plant_type_id']; ?></td>
			<td><?php echo $product['irrigation_id']; ?></td>
			<td><?php echo $product['programming_group_id']; ?></td>
			<td><?php echo $product['image']; ?></td>
			<td><?php echo $product['availability']; ?></td>
			<td><?php echo $product['temperature_id']; ?></td>
			<td><?php echo $product['published']; ?></td>
			<td><?php echo $product['family_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'products', 'action' => 'delete', $product['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
