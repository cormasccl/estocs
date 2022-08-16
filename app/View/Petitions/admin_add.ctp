<div class="petitions form">
<?php echo $this->Form->create('Petition'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Petition'); ?></legend>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('name');
		echo $this->Form->input('company_name');
		echo $this->Form->input('nif');
		echo $this->Form->input('customer');
		echo $this->Form->input('bill');
		echo $this->Form->input('amount_bill');
		echo $this->Form->input('initial_password');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Petitions'), array('action' => 'index')); ?></li>
	</ul>
</div>
