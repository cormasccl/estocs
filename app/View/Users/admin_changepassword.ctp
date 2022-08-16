<br />
<br />
<br />
<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->create('User'); 
echo $this->Form->input('id',array('value' => $userId,'type'=>'hidden'))?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <h2><?php echo __('Cambiar contraseña de un usuario');?></h2>
        <div class="col-md-4 col-md-offset-2">
        <?php echo __('Introduzca su nueva contraseña');?>
      </div>
      <div class="col-md-6">
        <?php echo $this->Form->input('password',array('label' =>false));?>
      </div>
      <div class="col-md-4 col-md-offset-2">
        <?php echo __('Repita la nueva contraseña');?>
      </div>
      <div class="col-md-6">
        <?php echo $this->Form->input('password2',array('type' => 'password','label' =>false));?>
      </div>
      <div class="col-md-12 text-center">
        <?php echo $this->Form->end('Enviar');?>
      </div>
</div>
