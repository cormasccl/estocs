<form accept-charset="utf-8" class="form-horizontal" role="form">
	<div class="form-group">
		<div>
			<label class="col-sm-3 control-label no-padding-right" for="UserGroupId"><?php echo __('Tipo usuario:');?></label>
			<label class="col-sm-9 control-label">			
				<?php echo $user['Group']['name'];?>
			</label>
		</div>
	</div>
	<div class="form-group">
		<div>
			<label class="col-sm-3 control-label no-padding-right" for="UserAgentId"><?php echo __('Agente:');?></label>
			<div class="col-sm-9">			
				<?php echo $user['Agent']['name'];?>
			</div>
		</div>
	</div>
</form>
<?php debug($user);?>


<!--
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
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
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
		<dt><?php echo __('Contact Mail'); ?></dt>
		<dd>
			<?php echo h($user['User']['contact_mail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Catalogue'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Catalogue']['listname'], array('controller' => 'catalogues', 'action' => 'view', $user['Catalogue']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
-->