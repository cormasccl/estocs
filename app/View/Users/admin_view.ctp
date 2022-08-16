<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('List'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['List']['id'], array('controller' => 'lists', 'action' => 'view', $user['List']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agent'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Agent']['name'], array('controller' => 'agents', 'action' => 'view', $user['Agent']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($user['User']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tariff'); ?></dt>
		<dd>
			<?php echo h($user['User']['tariff']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transportation Included Price'); ?></dt>
		<dd>
			<?php echo h($user['User']['transportation_included_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Mail'); ?></dt>
		<dd>
			<?php echo h($user['User']['contact_mail']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lists'), array('controller' => 'lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New List'), array('controller' => 'lists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Agents'), array('controller' => 'agents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Agent'), array('controller' => 'agents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cash Orders'), array('controller' => 'cash_orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cash Order'), array('controller' => 'cash_orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Cash Orders'); ?></h3>
	<?php if (!empty($user['CashOrder'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Status Id'); ?></th>
		<th><?php echo __('Date End'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['CashOrder'] as $cashOrder): ?>
		<tr>
			<td><?php echo $cashOrder['id']; ?></td>
			<td><?php echo $cashOrder['created']; ?></td>
			<td><?php echo $cashOrder['modified']; ?></td>
			<td><?php echo $cashOrder['user_id']; ?></td>
			<td><?php echo $cashOrder['status_id']; ?></td>
			<td><?php echo $cashOrder['date_end']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'cash_orders', 'action' => 'view', $cashOrder['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'cash_orders', 'action' => 'edit', $cashOrder['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cash_orders', 'action' => 'delete', $cashOrder['id']), array(), __('Are you sure you want to delete # %s?', $cashOrder['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cash Order'), array('controller' => 'cash_orders', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
