<div class="contacts view">
<h2><?php echo __('Contact'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Razon Social'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['razon_social']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipologia'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['tipologia']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idioma'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['idioma']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notificado Rgpd'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['notificado_rgpd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Notificacion'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['fecha_notificacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aceptado Rgpd'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['aceptado_rgpd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rechazado Rgpd'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['rechazado_rgpd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Aceptacion'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['fecha_aceptacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Rechazo'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['fecha_rechazo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hash'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['hash']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mailchimp Ok'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['mailchimp_ok']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Traspasar Mailchimp'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['traspasar_mailchimp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Traspasar Oracle'); ?></dt>
		<dd>
			<?php echo h($contact['Contact']['traspasar_oracle']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contact'), array('action' => 'edit', $contact['Contact']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contact'), array('action' => 'delete', $contact['Contact']['id']), array(), __('Are you sure you want to delete # %s?', $contact['Contact']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contact'), array('action' => 'add')); ?> </li>
	</ul>
</div>
