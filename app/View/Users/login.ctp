

<?php
$urlBase = $this->get('urlActual');


?>




	<div class="col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">


    <?php

    
                    echo $this->Form->create('User', array(
                        'url' => array(
                            'controller' => 'users',
                            'action' => 'login'
                        )
                    ));
                ?>
	
		<div class="iconic-input">
			<i class="glyphicon glyphicon-user" data-original-title="" title=""></i>


			<?php 

			echo $this->Form->hidden('origen', array('value'=>'app'));
                                echo $this->Form->input('User.username', array( 
                                        'label' => false,
                                        'placeholder' => __("Usuario"),
                                        'required' => '',
                                        'class' => 'form-control form-control-solid placeholder-no-fix form-group input-login ucase')
                                ); 
                            ?>
			<!--<input type="text" name="username" id="username" autofocus="" placeholder="Usuari" class="form-control inputUser" required="">-->
		</div>
		<div class="iconic-input">
			<i class="glyphicon glyphicon-lock" data-original-title="" title=""></i>
			<?php 
                                echo $this->Form->input('User.password', array( 
                                        'label' => false,
                                        'placeholder' => __('Contraseña'),
                                        'required' => '',
                                        'class' => 'form-control form-control-solid placeholder-no-fix form-group input-login ucase')
                                ); 
                            ?>
			<!--<input type="password" name="password" id="password" placeholder="Contrassenya" class="form-control" required="">-->
		</div>
		<div class="iconic-input">
			<input type="checkbox" name="recordar" id="recordar" > <?=__('Recordar contraseña');?>
		</div>
		

		<div class="spacing"></div>
		<?= $this->Form->button(__('Conectar'), array('class'=>'btn btn-lg btn-drop btn-primary btn-block btn-conectar')); ?>



	<?php 

	$options = array(
    'label' => 'Login',
    'class' => 'success hidden',
    'type' => 'submit'
);

echo $this->Form->end($options);?>
</div>

<script>
$( "#UserPassword" ).change(function() {
  document.getElementById('UserPassword').value = document.getElementById('UserPassword').value.toUpperCase();
});
</script>

