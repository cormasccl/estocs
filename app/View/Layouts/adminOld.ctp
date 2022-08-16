<?php

$urlWordpress = 'http://'.$_SERVER['HTTP_HOST'];

$urlWordpress .= ($_SERVER['HTTP_HOST'] == '81.46.212.35') ? '/corma/' : '/';

if ($urlWordpress == 'http://cormaweb/') { $urlWordpress = 'http://www.corma.es/';}
?>


<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Disponible - CORMA');
$cakeVersion = __d('cake_dev', 'Disponible CORMA')
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" type="image/png" sizes="192x192"  href="/img/icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/img/icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/img/icon/favicon-16x16.png">
	<link rel="manifest" href="/img/icon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/img/icon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout;?>ADMIN</title>
	



	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet" type="text/css">


	<?php
		echo $this->Html->meta('icon');
?>

<link rel="stylesheet" id="cff-font-awesome-css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css?ver=4.2.0" type="text/css" media="all">


		<?php
/*
		echo $this->Html->css(array('sprites/stylesheets/base','layout','widgets','limitless', 'responsive','font-awesome.min','font-awesome-ie7.min','estilo','jquery.fancybox.css?v=2.1.5'));*/

?>
<link rel="stylesheet" id="tp-open-sans-css" href="http://fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C600%2C700%2C800&ver=4.3.1" type="text/css" media="all">
	
	<link rel="stylesheet" id="base-css" href="<?=$urlWordpress;?>wp-content/themes/limitless/sprites/stylesheets/base.css?ver=4.3.1" type="text/css" media="all">
	<link rel="stylesheet" id="layout-css" href="<?=$urlWordpress;?>wp-content/themes/limitless/sprites/stylesheets/layout.css?ver=4.3.1" type="text/css" media="all">
	<link rel="stylesheet" id="widgets-css" href="<?=$urlWordpress;?>wp-content/themes/limitless/sprites/stylesheets/widgets.css?ver=4.3.1" type="text/css" media="all">
<link rel="stylesheet" id="style-css" href="<?=$urlWordpress;?>wp-content/themes/limitless/style.css?ver=4.3.1" type="text/css" media="all">
	<link rel="stylesheet" id="responsive-css" href="<?=$urlWordpress;?>wp-content/themes/limitless/sprites/stylesheets/responsive.css?ver=4.3.1" type="text/css" media="all">
	
	<link rel="stylesheet" id="runtime-css-css" href="<?=$urlWordpress;?>wp-admin/admin-ajax.php?action=ioalistener&amp;type=runtime_css&amp;ver=4.3.1" type="text/css" media="all">

<script type="text/javascript">
	/* <![CDATA[ */
	var ioa_localize = {"search_placeholder":"Introduzca el texto a buscar..."};
	/* ]]> */
	</script>

	<link rel="stylesheet" href="<?=$urlWordpress;?>intranet/css/estilo.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?=$urlWordpress;?>intranet/css/jquery.fancybox.css?v=2.1.5.css" type="text/css" media="all">
	
	


	
	
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
	<script src="<?=$urlWordpress;?>intranet/js/custom.js"></script>
	<script src="<?=$urlWordpress;?>intranet/js/ext.js"></script>
	<script src="<?=$urlWordpress;?>intranet/js/jquery.fancybox.pack.js?v=2.1.5.js"></script>


<?php

	
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style>
div.inner-super-wrapper {
	line-height: 2 !important;
}
</style>
</head>
<body>

<?php

$url = $this->get('urlActual');
?>




	<div class="super-wrapper    clearfix">
		<div class="inner-super-wrapper">
			<div class="col-md-12 theme-header" itemscope="" itemtype="http://schema.org/WPHeader">
				<div class="col-md-2 col-xs-6 sectionlogo">
					<?php echo $this->Html->image('logo_corma_150px.jpg', array('class'=>'logo'));?>
				</div>
				<div class="col-md-10 col-xs-12 top_layers right clearfix">
					<h2><?php echo $title;	?></h2>
				</div>		
			</div>






			<div class="page-wrapper page" style="z-index:0">
				<div class="clearfix  auto_align">
					<div class="mutual-content-wrap">
						<div class="page-content auto_align clearfix">
							<div id="container" class="col-md-12">
								<div class="col-md-2">
									<nav class="navbar navbar-default" role="navigation">
									  <div class="navbar-header">
									    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex1-collapse">
									      <span class="sr-only">Toggle navigation</span>
									      <span class="icon-bar"></span>
									      <span class="icon-bar"></span>
									      <span class="icon-bar"></span>
									    </button>
									    <a class="navbar-brand" href="#"><?php echo __('Menú');?></a>
									  </div>

									  <div class="navbar-collapse navbar-ex1-collapse collapse" style="height: 1px;">
									    <ul class="nav navbar-nav">

											<li <?php if ($option =='admin_index') {echo "class='active'";}?>><a href="<?=$url;?>/admin/users"><?php echo __('Gestión de clientes');?></a></li>
											<li <?php if ($option =='invoices_view') {echo "class='active'";}?>><a href="<?=$url;?>/Invoices/view"><?php echo __('Gestión de pedidos');?></a></li>
											<li <?php if ($option =='aclmanager') {echo "class='active'";}?>><a href="<?=$url;?>/acl_manager/acl"><?php echo __('Gestión de permisos');?></a></li>
											<li <?php if ($option =='changepassword') {echo "class='active'";}?>><a href="<?=$url;?>/Users/changepassword"><?php echo __('Cambiar contraseña');?></a></li>


									    </ul>
									  </div>
									</nav>
								</div>

								<div class="col-md-10 customer_left">								
									<?php 
									if ($this->Session->flash('ok')) {
									    echo "<div class='alert alert-success'>";
									    echo $this->Session->flash('ok');
									    echo "</div>";
									}

									if ($this->Session->flash('error')) {
									    echo "<div class='alert alert-danger'>";
									    echo $this->Session->flash('error');
									    echo "</div>";
									}

									if ($this->Session->flash('info')) {
									    echo "<div class='alert alert-info'>";
									    echo $this->Session->flash('info');
									    echo "</div>";
									}
									?>
									<?php echo $this->fetch('content'); ?>								
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>						
		</div>
	</div>
</body>
<style>
.agent {
	background-color: #eee;
	padding: 10px;
	-webkit-box-shadow: 7px 4px 6px -3px #333333;
    -moz-box-shadow: 7px 4px 6px -3px #333333;
    box-shadow: 7px 4px 6px -3px #333333;
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
}
.client {
	background-color: #eee;
	padding: 10px;
	-webkit-box-shadow: 7px 4px 6px -3px #333333;
    -moz-box-shadow: 7px 4px 6px -3px #333333;
    box-shadow: 7px 4px 6px -3px #333333;
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
}
</style>
</html>
