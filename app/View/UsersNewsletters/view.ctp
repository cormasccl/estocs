<div class="usersnewsletters view">
<h2><?php echo __('Usersnewsletter'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codigo Cliente'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['codigo_cliente']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idioma'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['idioma']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notificado Rgpd'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['notificado_rgpd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Notificacion'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['fecha_notificacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aceptado Rgpd'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['aceptado_rgpd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rechazado Rgpd'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['rechazado_rgpd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Aceptacion'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['fecha_aceptacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Rechazo'); ?></dt>
		<dd>
			<?php echo h($usersnewsletter['Usersnewsletter']['fecha_rechazo']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Usersnewsletter'), array('action' => 'edit', $usersnewsletter['Usersnewsletter']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Usersnewsletter'), array('action' => 'delete', $usersnewsletter['Usersnewsletter']['id']), array(), __('Are you sure you want to delete # %s?', $usersnewsletter['Usersnewsletter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Usersnewsletters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usersnewsletter'), array('action' => 'add')); ?> </li>
	</ul>
</div>
