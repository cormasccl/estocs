<?php

//debug($catalogues).die;

?>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            

            <div class="x_content">				
				<?php echo $this->Form->create('User'); ?>
				<div class="form-group">
					<?php
						echo $this->Form->input('username', array('class'=>'form-control','label'=>__('Usuario'))); 
					?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->input('password', array('class'=>'form-control','label'=>__('Contraseña')));
					?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->input('name', array('class'=>'form-control','label'=>__('Nombre')));
					?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->input('group_id', array('class'=>'form-control','label'=>__('Grupo'), 'empty'=>'', 'required'=>'true'));
					?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->input('email', array('class'=>'form-control','label'=>__('Email')));
					?>
				</div>

				<div class="form-group">
					
					<?php

                    	$valors = array('esp' => 'Castellano', 'cat' => 'Català', 'fra'=>'Français');

                        echo $this->Form->input('language', array('options' => $valors,'class'=>'form-control','label'=>__('Idioma'), 'empty'=>''));
                    ?>



				</div>

				


				<div class="panel panel-default">
					<div class="panel-heading">
					    <h3 class="panel-title"><?=__('Datos cliente');?></h3>
					</div>

  					<div class="panel-body">
					
						<div class="form-group">
							<?php
								echo $this->Form->input('code', array('class'=>'form-control','label'=>__('Código cliente'), 'empty'=>''));
							?>
						</div>
						<div class="form-group">
							<?php
								echo $this->Form->input('agent_id', array('class'=>'form-control','label'=>__('Comercial'), 'empty'=>''));
							?>
						</div>
						<div class="form-group">
							<?php
								/*echo $this->Form->input('catalogue_id', array('class'=>'form-control','label'=>__('Disponible'), 'empty'=>''));*/


							?>
							<label for="UserCatalogueId">Disponible</label>
							<select class="form-control" id="UserCatalogueId" name="data[User][catalogue_id]">
			<?php
			echo "<option value=''></option>";

			foreach ($catalogues as $catalogue) {
				

				echo '<option value="'.$catalogue['Catalogue']['id'].'">';

				echo $catalogue['Catalogue']['code'];
				if ($catalogue['Catalogue']['tariff']!=null) {
					echo ' ('.$catalogue['Catalogue']['tariff'].')';
				}
				echo '</option>';


			}


			?>
			</select>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
					    <h3 class="panel-title"><?=__('Datos socio');?></h3>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<?php
								echo $this->Form->input('partner_id', array('class'=>'form-control','label'=>__('Socio'), 'empty'=>''));
							?>
						</div>
					</div>
				</div>

				<?= $this->Form->button('<i class="fa fa-floppy-o" aria-hidden="true"></i> '.__('Guardar'), array('class'=>'btn btn-primary')) ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>



<!--
<form id="UserAddForm" action ="/users/add" method="POST" accept-charset="utf-8" class="form-horizontal" role="form">
	

	<div class="form-group">
		<div>
			<label class="col-sm-3 control-label no-padding-right" for="UserGroupId"><?php echo __('Tipo usuario:');?></label>
			<div class="col-sm-9">			
				<select class="col-xs-10 col-sm-5" id="UserGroupId" name="data[User][group_id]">
					<?php
					foreach ($groups as $key => $group_name) {
						echo '<option value="'.$key.'">'.$group_name.'</option>';
					}
					?>
				</select>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div>
			<label class="col-sm-3 control-label no-padding-right" for="UserAgentId"><?php echo __('Agente:');?></label>
			<div class="col-sm-9">			
				<select class="col-xs-10 col-sm-5" id="UserAgentId" name="data[User][agent_id]">
					<?php
					foreach ($agents as $key => $agent_name) {
						echo '<option value="'.$key.'">'.$agent_name.'</option>';
					}
					?>
				</select>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="UserUsername"><?php echo __('Usuario:');?></label>

		<div class="col-sm-9">
			<input id="UserUsername" name="data[User][username]" placeholder="Usuario" class="col-xs-10 col-sm-5" type="text">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="UserPassword"><?php echo __('Password:');?></label>

		<div class="col-sm-9">
			<input id="UserPassword" name="data[User][password]" placeholder="Password" class="col-xs-10 col-sm-5" type="password">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="UserCode"><?php echo __('Código cliente:');?></label>

		<div class="col-sm-9">
			<input id="UserCode" name="data[User][code]" placeholder="Código cliente" class="col-xs-10 col-sm-5" type="text">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="UserName"><?php echo __('Nombre:');?></label>

		<div class="col-sm-9">
			<input id="UserName" name="data[User][name]" placeholder="Nombre" class="col-xs-10 col-sm-5" type="text">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="UserEmail"><?php echo __('Email:');?></label>

		<div class="col-sm-9">
			<input id="UserEmail" name="data[User][email]" placeholder="Email" class="col-xs-10 col-sm-5" type="text">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="UserCatalogueId"><?php echo __('Lista disponible:');?></label>

		<div class="col-sm-9">
			

			<select class="col-xs-10 col-sm-5" id="UserCatalogueId" name="data[User][catalogue_id]">
			<?php
			

			foreach ($catalogues as $catalogue) {
				

				echo '<option value="'.$catalogue['Catalogue']['id'].'">';

				echo $catalogue['Catalogue']['code'];
				if ($catalogue['Catalogue']['tariff']!=null) {
					echo ' ('.$catalogue['Catalogue']['tariff'].')';
				}
				echo '</option>';


			}


			?>
			</select>
		</div>
	</div>

	<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Grabar
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Limpiar
											</button>
										</div>
									</div>


</form>

-->