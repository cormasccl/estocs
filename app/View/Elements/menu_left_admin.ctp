<?php

$url = $this->get('urlActual');
?>


<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>


<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"><?php echo __('Menú');?></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="navbar-collapse navbar-ex1-collapse collapse" style="height: 1px;">
    <ul class="nav navbar-nav">

      <li <?php if ($option =='users_index') {echo "class='active'";}?>><a href="<?=$url;?>/intranet/admin/Users/index"><?php echo __('Gestión usuarios');?></a></li>
      <li <?php if ($option =='catalogues_view') {echo "class='active'";}?>><a href="<?=$url;?>/Catalogues/view"><?php echo __('Consulta de disponibles');?></a></li>
      <li <?php if ($option =='aclmanager') {echo "class='active'";}?>><a href="<?=$url;?>/acl_manager/acl"><?php echo __('Gestión de permisos');?></a></li>
      
      <li <?php if ($option =='changepassword') {echo "class='active'";}?>><a href="<?=$url;?>/Users/changepassword"><?php echo __('Cambiar contraseña');?></a></li>
      <!--<li><a href="<?=$url;?>/users/logout"><?php echo __('Cerrar sesión');?></a></li>-->
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

<style>
@media (min-width: 768px)
.navbar {
    max-width: 300px;
    margin-right: 0;
    margin-left: 0;
}

</style>
