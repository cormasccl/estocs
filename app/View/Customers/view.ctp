<style>
	.tableResults {
	font-size:10px;
	}
table th {
	background: none;
}

</style>


<form id='UsersAdminIndexForm' class="form" role="form" action='/admin/users' accept-charset="utf-8" method='post'>
	<div class="form-group col-md-3">
		<label for="group_id"><?php echo __('Tipo de usuario');?></label>
		<?php
		echo "<select  class='chosen-select form-control' name='group_id[]' multiple='' data-placeholder='Seleccione un tipo de usuario'>";
		echo "<option value=''></option>";
		foreach ($groups as $key => $group) {	
			$selected='';
			if ($key == 3) $selected = 'selected'; 
			echo "<option value='".$key."' ".$selected.">".$group."</option>";
		}
		echo "</select>";
	?>
	</div>
	<div class="form-group col-md-2">
		<?php
		echo $this->Form->input('cliente',array('type' => 'text','label' => __('Código de cliente'),'class' => 'form-control'));
		?>
	</div>
	<div class="form-group col-md-4">
		<?php
		echo $this->Form->input('nombrecliente',array('type' => 'text','label' => __('Nombre de cliente'),'class' => 'form-control'));
		?>
	</div>
	<div class="form-group col-md-3">
		<?php
		echo $this->Form->input('username',array('type' => 'text','label' =>  __('Nombre de usuario'),'class' => 'form-control'));
		?>
	</div>
	<div class="form-group col-md-12">
	<label></label>
		<button type="submit" class="btn btn-default"><?php echo __('Buscar');?></button>
		</div>
</form>




<!--<div class="row form-filtro">-->
<?php
/*echo  $this->Form->create('Users',array('action' => 'admin_index','class' => 'contact-form','accept-charset'=>'utf-8'));

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('group_id',array('label' => __('Tipo de usuario:'),'class' => 'form-control','options'=>$groups, 'default'=>3));
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('cliente',array('type' => 'text','label' => __('Código de cliente:'),'class' => 'form-control'));
echo "</div>";

echo "<div class='form-group col-md-3'>";
echo $this->Form->input('username',array('type' => 'text','label' => __('Nombre de usuario:'),'class' => 'form-control'));
echo "</div>";

echo "<div class='col-md-3'>";
echo $this->Form->end(__('Buscar'));
echo "</div>";*/
?>
<!--</div>-->
<hr />

<div class="users index">
	<table class="table table-hover tableResults">
	<thead>
	<tr>
			<th><?php echo __('Tipo usuario'); ?></th>
			<th><?php echo __('Nombre de usuario'); ?></th>
			<th><?php echo __('Código cliente'); ?></th>
			<th><?php echo __('Nombre'); ?></th>
			<th><?php echo __('Email'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['Group']['name']); ?></td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['code']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td class="actions">
			<?php
				/*echo $this->Html->image("view_16x16.png", array("alt" => __('Ver'),"title" => __('Ver'),'url' => array('action' => 'view', $user['User']['id'])));
				echo $this->Html->image("edit_16x16.png", array("alt" => __('Editar'),"title" => __('Editar'),'url' => array('action' => 'edit', $user['User']['id'])));*/
				echo $this->Html->image("password_16x16.png", array("alt" => __('Cambiar password'),"title" => __('Cambiar contraseña'),'url' => array('action' => 'changepassword', $user['User']['id'])));
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<div class="paginator">
		<ul>
		<?php
		    echo $this->Paginator->prev('<<', array('class' => 'btn btn-default prev', 'tag' => 'li'), null, array('class' => 'btn btn-default prev disabled', 'tag' => 'li'));
		    echo $this->Paginator->numbers(array('separator' => '', 'class' => 'btn btn-default', 'currentClass' => 'disabled', 'tag' => 'li'));
		    echo $this->Paginator->next('>>', array('class' => 'btn btn-default next', 'tag' => 'li'), null, array('class' => 'btn btn-default next disabled', 'tag' => 'li'));
		?>
		</ul>
	</div>
</div>
