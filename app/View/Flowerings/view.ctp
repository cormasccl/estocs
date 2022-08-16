<div class="flowerings view">
<h2><?php echo __('Flowering'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($flowering['Flowering']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($flowering['Flowering']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($flowering['Flowering']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($flowering['Flowering']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($flowering['Flowering']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Flowering'), array('action' => 'edit', $flowering['Flowering']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Flowering'), array('action' => 'delete', $flowering['Flowering']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $flowering['Flowering']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Flowerings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Flowering'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Details'), array('controller' => 'details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detail'), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Details'); ?></h3>
	<?php if (!empty($flowering['Detail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Stock Id'); ?></th>
		<th><?php echo __('Growing Id'); ?></th>
		<th><?php echo __('Flowering Id'); ?></th>
		<th><?php echo __('Unities'); ?></th>
		<th><?php echo __('Observations'); ?></th>
		<th><?php echo __('Unities Published'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($flowering['Detail'] as $detail): ?>
		<tr>
			<td><?php echo $detail['id']; ?></td>
			<td><?php echo $detail['stock_id']; ?></td>
			<td><?php echo $detail['growing_id']; ?></td>
			<td><?php echo $detail['flowering_id']; ?></td>
			<td><?php echo $detail['unities']; ?></td>
			<td><?php echo $detail['observations']; ?></td>
			<td><?php echo $detail['unities_published']; ?></td>
			<td><?php echo $detail['created']; ?></td>
			<td><?php echo $detail['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'details', 'action' => 'view', $detail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'details', 'action' => 'edit', $detail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'details', 'action' => 'delete', $detail['id']), array('confirm' => __('Are you sure you want to delete # %s?', $detail['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Detail'), array('controller' => 'details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
