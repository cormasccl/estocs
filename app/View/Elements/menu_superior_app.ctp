<?php



if (empty($user)) {
?>
<div style="text-align:center">
  <?php echo $this->Html->image('logo.jpg', array('width'=>'100px'));?>
</div>   

<?php



} else {



?>


<nav class="navbar navbar-default fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand navbar-brand-logo" href="#"><?php echo $this->Html->image('logo_small.jpg');?></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">

      <?php if($user['group_id'] == '4') { ?>

        <ul class="nav navbar-nav menu_superior">
          <?php if (empty($user['partner_id'])) { ?>
            <li class="<?php if ($page =='partners') echo "active ";?>" ><a href="<?=SERVER;?>Partners/selection"><?=__('Seleccionar socio / almacén');?></a></li>
          <?php } ?>
          <li class="<?php if ($page =='estocs') echo "active ";?>" ><a href="<?=SERVER;?>Stocks"><?=__('Gestión de estocs');?></a></li>

          <?php if ($user['user_quality'] == 1) { ?>
            <li class="<?php if ($page =='imagesquality') echo "active ";?>" ><a href="<?=SERVER;?>Articles/selection"><?=__('Fotos calidad');?></a></li>
          <?php } ?>       
        </ul>

      <?php } ?>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?=SERVER;?>cerrar-sesion-app"><i class='fa fa-power-off' aria-hidden='true'></i> <?=__('Cerrar sesión');?></a></li>
      </ul>
      
    </div><!--/.nav-collapse -->
  </div><!--/.container-fluid -->
</nav>


<?php

}

?>