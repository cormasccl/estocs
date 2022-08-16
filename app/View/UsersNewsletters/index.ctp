<div class="usersnewsletters index">
	<h2><?php echo __('USUARIOS'); ?></h2>
	<table class="table table-bordered">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('codigo_cliente'); ?></th>
			<th><?php echo $this->Paginator->sort('idioma'); ?></th>
			<th><?php echo $this->Paginator->sort('notificado_rgpd'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_notificacion'); ?></th>
			<th><?php echo $this->Paginator->sort('aceptado_rgpd'); ?></th>
			<th><?php echo $this->Paginator->sort('rechazado_rgpd'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_aceptacion'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_rechazo'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($usersnewsletters as $usersnewsletter): ?>
	<tr>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['id']); ?>&nbsp;</td>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['email']); ?>&nbsp;</td>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['codigo_cliente']); ?>&nbsp;</td>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['idioma']); ?>&nbsp;</td>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['notificado_rgpd']); ?>&nbsp;</td>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['fecha_notificacion']); ?>&nbsp;</td>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['aceptado_rgpd']); ?>&nbsp;</td>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['rechazado_rgpd']); ?>&nbsp;</td>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['fecha_aceptacion']); ?>&nbsp;</td>
		<td><?php echo h($usersnewsletter['Usersnewsletter']['fecha_rechazo']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Mailchimp'), array('action' => 'subscribe_mailchimp', $usersnewsletter['Usersnewsletter']['hash'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $usersnewsletter['Usersnewsletter']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $usersnewsletter['Usersnewsletter']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $usersnewsletter['Usersnewsletter']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $usersnewsletter['Usersnewsletter']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Añadir usuario'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Enviar email usuarios'), array('action' => 'send')); ?></li>
	</ul>
</div>
