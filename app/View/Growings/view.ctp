<div class="growings view">
<h2><?php echo __('Growing'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($growing['Growing']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($growing['Growing']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($growing['Growing']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($growing['Growing']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($growing['Growing']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Growing'), array('action' => 'edit', $growing['Growing']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Growing'), array('action' => 'delete', $growing['Growing']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $growing['Growing']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Growings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Growing'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Details'), array('controller' => 'details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detail'), array('controller' => 'details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Details'); ?></h3>
	<?php if (!empty($growing['Detail'])): ?>
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
	<?php foreach ($growing['Detail'] as $detail): ?>
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
