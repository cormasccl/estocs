<?php

$urlBase = $this->get('urlActual');

?>


<div class="row">
	<div class="col-xs-12">
		<a href="<?=$urlBase;?>/users/add" class="btn btn-app btn-primary no-radius">
			<i class="fa fa-plus-circle" aria-hidden="true"></i>
			<?php echo __('Nuevo usuario');?>
		</a>
	</div>
</div>



<div>
	<table id="dynamic-table" class="table table-striped table-bordered table-hover">
		<thead>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('group_id'); ?></th>
			<th><?php echo $this->Paginator->sort('agent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</thead>

		<tbody>
			<?php foreach ($users as $user): ?>
				<tr>
					<td class='align_center'><?php echo h($user['User']['id']); ?>&nbsp;</td>
					<td class='align_center'>
						<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
					</td>
					<td class='align_center'>
						<?php echo $this->Html->link($user['Agent']['name'], array('controller' => 'agents', 'action' => 'view', $user['Agent']['id'])); ?>
					</td>
					<td class='align_center'><?php echo h($user['User']['username']); ?>&nbsp;</td>
					<td class='align_center'><?php echo h($user['User']['code']); ?>&nbsp;</td>
					<td class='align_center'><?php echo h($user['User']['name']); ?>&nbsp;</td>
					<td class="actions">
						<div class="hidden-sm hidden-xs action-buttons">
							<a class="blue" href="/users/view/<?=$user['User']['id'];?>">
								<i class="ace-icon fa fa-search-plus bigger-130"></i>
							</a>

							<a class="green" href="/users/edit/<?=$user['User']['id'];?>">
								<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>

							<a class="green" href="/users/changepassword/<?=$user['User']['id'];?>">
								<i class="ace-icon fa fa-lock bigger-130"></i>
							</a>
						</div>
															
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<!-- PAGINATE -->
	<div class="row">
		<div class="col-xs-6">
			<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">
				<?php
				echo $this->Paginator->counter(array(
					'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, de {:start} a {:end}')
				));
				?>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
				<ul class="pagination">
					<li class="paginate_button previous disabled" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_previous">
						<?php echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));?>
					</li>

					<?php
					echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
					?>
					<li class="paginate_button next" aria-controls="dynamic-table" tabindex="0" id="dynamic-table_next">
						<?php echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));?>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- END PAGINATE -->


<?php
		/*echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));*/
	?>



</div>