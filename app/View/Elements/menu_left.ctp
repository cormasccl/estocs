<?php

$url = $this->get('urlActual');
?>


<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

<?php 
  if ($catalogue_id != 0  || $season_catalogue_id != 0) {

?>

  <nav class="navbar navbar-default" style="margin-top:30px" role="navigation">
    <?php
    if ($catalogue_id != 0 ) {
    ?>
    
      <a href="<?=$url;?>/Catalogues/index" class="btn btn-success buttonsLeftCustomer" ><i class="fa fa-shopping-cart"></i><span><?php echo '   '.__('Disponible semanal');?></span></a>
    
  <?php
    }
    if ($season_catalogue_id != 0 ) {
  ?>

      <a href="<?=$url;?>/SeasonCatalogues/index" class="btn btn-success buttonsLeftCustomer" ><i class="fa fa-file-text-o"></i><span><?php echo '   '.__('Consultar catálogo');?></span></a>

      <?php
    }
    ?>

  </nav>
<?php
}
?>
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex1-collapse">
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

      <li <?php if ($option =='cash_order_view') {echo "class='active'";}?>><a href="<?=$url;?>/CashOrders/view"><?php echo __('Consultar / duplicar pedidos');?></a></li>
      <li <?php if ($option =='invoices_view') {echo "class='active'";}?>><a href="<?=$url;?>/Invoices/view"><?php echo __('Consulta de facturas');?></a></li>
      <li <?php if ($option =='payments_view') {echo "class='active'";}?>><a href="<?=$url;?>/Payments/view"><?php echo __('Consulta de pagos');?></a></li>
      <li <?php if ($option =='changepassword') {echo "class='active'";}?>><a href="<?=$url;?>/Users/changepassword"><?php echo __('Cambiar contraseña');?></a></li>
      <!--<li><a href="<?=$url;?>/users/logout"><?php echo __('Cerrar sesión');?></a></li>-->
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

<nav class="navbar navbar-default boxAgent" role="navigation">
  <div class="navbar-collapse navbar-ex1-collapse collapse" style="height: 1px;">
    <p><strong><?php echo __('Agent comercial');?></strong></p>
    <br />
      <p><?php echo $user['Agent']['name'];?></p>
      <p><i class="fa fa-envelope-o"></i><?php echo '  '.$user['Agent']['email'];?></p>
      <p><i class="fa fa-phone"></i><?php echo '  '.$user['Agent']['phone'];?> </p>
    <p>FAX: <?php echo '  '.$user['Agent']['fax'];?></p>
    
  </div>
</nav>

<style>
@media (min-width: 768px)
.navbar {
    max-width: 300px;
    margin-right: 0;
    margin-left: 0;
}

</style>
