<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_id');
		echo $this->Form->input('list_id');
		echo $this->Form->input('agent_id');
		echo $this->Form->input('username');
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('tariff');
		echo $this->Form->input('transportation_included_price');
		echo $this->Form->input('contact_mail');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
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
