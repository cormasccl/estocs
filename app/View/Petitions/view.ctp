<div class="petitions view">
<h2><?php echo __('Petition'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Name'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['company_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nif'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['nif']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['customer']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bill'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['bill']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount Bill'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['amount_bill']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Initial Password'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['initial_password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($petition['Petition']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Petition'), array('action' => 'edit', $petition['Petition']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Petition'), array('action' => 'delete', $petition['Petition']['id']), array(), __('Are you sure you want to delete # %s?', $petition['Petition']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Petitions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Petition'), array('action' => 'add')); ?> </li>
	</ul>
</div>
