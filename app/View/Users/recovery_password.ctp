<?php
  /*echo $this->Html->meta('icon');

  echo $this->Html->css(array('limitless','widgets','sprites/stylesheets/layout','sprites/stylesheets/responsive','font-awesome.min','font-awesome-ie7.min'));
  echo $this->Html->css(array('bootstrap.min', 'style.min'));
    echo $this->Html->css('print', 'stylesheet', array('media' => 'print')); 


echo '<script src="http://code.jquery.com/jquery-1.10.2.js"></script>';
echo '<link href="http://fonts.googleapis.com/css?family=Raleway:400,800,300" rel="stylesheet" type="text/css">';

echo $this->Html->script(array('bootstrap.min'));


echo $this->Html->css(array('chosen.min','estilo','zoe'));
  echo $this->Html->script(array(
    'chosen.jquery.min'
    ), array('inline' => false));

  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');



$this->Html->scriptStart(array('inline' => false));

?>
$(document).ready(function(){
  $(".chosen-select").chosen();
});
<?php 
$this->Html->scriptEnd();*/
?>



<?php

echo $this->Html->script(array(
  'jquery-1.11.3.min',
  'bootstrap.min',
  'bootbox.min'
), array('inline' => false));

//if (!Configure::read('debug')):
//  throw new NotFoundException();
//endif;

//App::uses('Debugger', 'Utility');
?>


<?php

$mensajeOk    = strip_tags($this->Session->flash('ok'));
$mensajeError = strip_tags($this->Session->flash('error'));

if (!empty($mensajeOk)) {
  echo "<div class='alert alert-info'><i class='fa fa-check'>&nbsp;&nbsp;".$mensajeOk."</i></div>";
}
if (!empty($mensajeError)) {
  echo "<div class='alert alert-danger'><i class='fa fa-exclamation'>&nbsp;&nbsp;".$mensajeError."</i></div>";
}
?>



<?php echo $this->Form->create('User'); ?>

  <div class="col-md-5">
  <div class='textwidget'>
    <p>
      <?php echo $this->Html->Image('webshop.jpg',array('class'=>'sombra alignnone wp-image-8263', 'width'=>'400px'));?>
    </p>
  </div>
</div>
  <div class="col-md-7">
  	
		<?php echo __('Recuperar su contraseña es muy fácil. Introduzca su <strong>nombre de usuario</strong> y recibirá un email con las instrucciones.');?>
    <br /><br />
	  <?php echo $this->Form->input('username',array('label' =>__('Nombre de usuario'),'class' => 'contact-form','accept-charset'=>'utf-8'));?>
    <?php echo $this->Form->end(__('Enviar'), array('class'=>'tt-form-submit'));?>
    
  </div>
</div>

	