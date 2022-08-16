


<div class="col-md-5">
	<br /><br />
	<?php
	echo $this->Html->Image('usuario_web.jpg', array('class'=>'sombra'));
	?>
</div>
<div id='content-container' class="petitions form col-md-7">
<?php echo $this->Form->create('Petition', array('class'=>'contact-form')); ?>
	<fieldset>
		<p><?php echo __('Si usted es cliente de Corma, rellene el siguiente formulario para solicitar usuario/contraseña.');?></p>
	<?php
		echo $this->Form->input('name', array('label' => __('Nombre Solicitante (*)'),'class'=>'name'));
		echo $this->Form->input('email', array('label' => __('Correo electrónico (*)'), 'class'=>'email'));
		echo $this->Form->input('company_name', array('label' => __('Razón Social (*)')));
		echo $this->Form->input('nif', array('label' => __('C.I.F. / N.I.F (*)')));
		echo '<p>'.__('Datos Validación').'</p>';
		echo '<p>'.__('Rellene los siguientes campos utilizando una factura de los últimos 12 meses.').'</p>';		
		echo $this->Form->input('customer', array('label' => __('Código Cliente (*)')));
		echo $this->Form->input('bill', array('label' => __('Número Factura (*)')));
		echo $this->Form->input('amount_bill', array('label' => __('Importe Factura (*)')));
		echo $this->Form->input('status', array('type' => 'hidden','value' => 'P'));
	?>
	</fieldset>
<?php echo $this->Form->submit(__('Enviar solicitud'), array('class'=>'tt-form-submit')); ?>
</div>
<br />
<p><?php echo __('(*): Campos Obligatorios');?></p>
<p><?php echo __('Una vez nuestro departamento comercial haya validado los datos, Ud. recibirá un mensaje electrónico confirmando la activación del Usuario.');?></p>
<p>
<?php 
echo __('Si Ud. aún no es Cliente, puede enviarnos su petición mediante el formulario existente en la opción');
echo ' <a href="https://'.$_SERVER['HTTP_HOST'].'/contactanos/">';
echo __('Contacto');
echo '</a>';?></p>


