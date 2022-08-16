

<form id="UserAddForm" action ="/users/add" method="POST" accept-charset="utf-8" class="form-horizontal" role="form">
	

	<div class="form-group">
		<div>
			<label class="col-sm-3 control-label no-padding-right" for="UserGroupId"><?php echo __('Tipo usuario:');?></label>
			<div class="col-sm-9">			
				<select class="col-xs-10 col-sm-5" id="UserGroupId" name="data[User][group_id]">
					<?php
					foreach ($groups as $key => $group_name) {
						if ($key == $user['Group']['id']) {$selected = "selected"; } else {$selected="";}
						echo '<option value="'.$key.'" '.$selected.'>'.$group_name.'</option>';
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
			/*array(
	'id' => '1',
	'code' => 'DISTRICO',
	'created' => '2015-10-28 12:38:49',
	'modified' => '2016-11-11 05:58:43',
	'listname' => 'Lista del Grupo DISTRICO',
	'language' => '3',
	'transportation_included_price' => '0',
	'tariff' => null,
	'textsup' => 'Veuillez nous envoyer vos commandes avant lundi midi',
	'reference' => null,
	'last_week' => '28',
	'last_year' => '2016'
)*/

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

