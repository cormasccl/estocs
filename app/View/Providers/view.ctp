<div class="providers view">
<h2><?php echo __('Provider'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codigo Proveedor'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['codigo_proveedor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Razon Social'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['razon_social']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Direccion'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['direccion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Poblacion'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['poblacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codigopostal'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['codigopostal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Provincia'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['provincia']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pais'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['pais']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipologia'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['tipologia']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Idioma'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['idioma']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notificado Rgpd'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['notificado_rgpd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Notificacion'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['fecha_notificacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aceptado Rgpd'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['aceptado_rgpd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rechazado Rgpd'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['rechazado_rgpd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Aceptacion'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['fecha_aceptacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Rechazo'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['fecha_rechazo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hash'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['hash']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mailchimp Ok'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['mailchimp_ok']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Traspasar Mailchimp'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['traspasar_mailchimp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Traspasar Oracle'); ?></dt>
		<dd>
			<?php echo h($provider['Provider']['traspasar_oracle']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Provider'), array('action' => 'edit', $provider['Provider']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Provider'), array('action' => 'delete', $provider['Provider']['id']), array(), __('Are you sure you want to delete # %s?', $provider['Provider']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Providers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider'), array('action' => 'add')); ?> </li>
	</ul>
</div>
