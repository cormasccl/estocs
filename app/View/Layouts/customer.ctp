<?php

$urlWordpress = 'https://'.$_SERVER['HTTP_HOST'];

$urlWordpress .= ($_SERVER['HTTP_HOST'] == '81.46.196.226') ? '/corma/' : '/';

if ($urlWordpress == 'http://cormaweb/') { $urlWordpress = 'https://www.corma.es/';}
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

$cakeDescription = __d('cake_dev', 'Área privada clientes');
$cakeVersion = __d('cake_dev', 'Área privada clientes')
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" type="image/png" sizes="192x192"  href="/img/icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/img/icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/img/icon/favicon-16x16.png">
	<!--<link rel="manifest" href="/img/icon/manifest.json">-->
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/img/icon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<?php echo $this->Html->charset(); ?>
	<title><?php echo $title_for_layout;?></title>
	






	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet" type="text/css">


	<?php
		echo $this->Html->meta('icon');
?>

<link rel="stylesheet" id="cff-font-awesome-css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=4.7.0" type="text/css" media="all">


		<?php
/*
		echo $this->Html->css(array('sprites/stylesheets/base','layout','widgets','limitless', 'responsive','font-awesome.min','font-awesome-ie7.min','estilo','jquery.fancybox.css?v=2.1.5'));*/

?>
<link rel="stylesheet" id="tp-open-sans-css" href="https://fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C600%2C700%2C800&ver=4.3.1" type="text/css" media="all">
	
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
	
	


	
	<!--<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>-->
	<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>

	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
	<script src="<?=$urlWordpress;?>intranet/js/custom.js"></script>
	<script src="<?=$urlWordpress;?>intranet/js/ext.js"></script>
	<script src="<?=$urlWordpress;?>intranet/js/jquery.fancybox.pack.js?v=2.1.5.js"></script>


	<?php
    echo $this->Html->script('callbacks');
    echo $this->Html->script('spinner');
    echo $this->Html->script('trigger');
    echo $this->Html->script('paging');
    echo $this->Html->script('noneleft');
    echo $this->Html->script('jquery-ias');
    ?>



<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-6255739-1']);
			_gaq.push(['_trackPageview']);
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'https://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>

	<!--<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-6255739-9', 'auto');
  ga('send', 'pageview');

</script>-->






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

	//echo $this->element('modal_subscribe'); 

	?>

	<div class="super-wrapper    clearfix">
		<div class="inner-super-wrapper">
			<?php
			
				echo $this->element('menu_corma_mobile');
	
			?>

			<div class="col-md-12 theme-header" itemscope="" itemtype="http://schema.org/WPHeader">
				<div class="header-cons-area">
					<?php echo $this->element('menu_corma', array('mostrar_titulo'=>'yes', 'layout'=>'private'));?>
				</div>
				<?php 





					$urlBase = $this->get('urlActual');
					if (isset($option)) {
						switch ($option) {
							case 'disponible':
								echo $this->element('menu_disponible',array('cataleg' => $catalogue['Catalogue'], 'classificacions' => $catalogueClassification, 'collections'=>$collections, 'filter'=>$filter, 'hay_ofertas'=>$hay_ofertas,'hay_motoras'=>$hay_motoras, 'hay_novedades'=>$hay_novedades, 'hay_composiciones'=>$hay_composiciones));
								break;
							case 'catalogo':
							debug($seasoncatalogue).die;
								echo $this->element('menu_cataleg',array('cataleg' => $seasoncatalogue[0]['SeasonCatalogue'], 'classificacions' => $seasoncatalogue[0]['SeasonCatalogueClassification'], 'collections'=>$collections));
								break;
							case 'index':
							case 'cash_order_view':
							case 'invoices_view':
							case 'payments_view':
							case 'cash_order_sent':
								//echo "ESTEM A L'INICI NO HI HA MENU";
							echo "<br /><br />";
								break;
							default:
								# code...
								break;
						}
					} else {
						$option = null;
					}
					
				?>
			</div>
			<?php
			if ($option=='disponible') {
			?>
				<div class="col-md-12 menu_layers menu_disponible_mobile">					
					<div class="menu-bar menu-disponible">
	                    <div class="clearfix">

							<?php
							if (!empty($filter)) {
								$extra = 'noactive';
						  		if ($filter == 'discount') {
						  			//$extra = 'current-menu-ancestor';
						  			$extra = 'current-menu-item';
						  		}
							}
					  		?>

					  		<div class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home relative ">


					  			<?php
					  			if ($hay_ofertas) {
					  				?>
						  			<a href="<?php echo $urlBase;?>/Catalogues/index" class="ioa-button button-small <?php echo $extra;?>" ><?php echo __('Ofertas');?><span class="menu-tail"></span></a>
						  			<?php
						  		}
						  		?>

						  		<?php
						  		if  ($hay_motoras) {
								  	if (!empty($filter)) {
										$extra = 'noactive';
								  		if ($filter == 'motora') {
								  			$extra = 'current-menu-item';
								  		}
								  	}
							  		?>
							  		<a href="<?php echo $urlBase;?>/Catalogues/index/motora" class="ioa-button button-small <?php echo $extra;?>" ><?php echo __('Plantas motoras');?><span class="spacer"></span><span class="menu-tail"></span></a>

								<?php
								}

								if  ($hay_novedades) {
								  	if (!empty($filter)) {
										$extra = 'noactive';
								  		if ($filter == 'novelty') {
								  			$extra = 'current-menu-item';
								  		}
								  	}
							  		?>
							  		<a href="<?php echo $urlBase;?>/Catalogues/index/novelty" class="ioa-button button-small <?php echo $extra;?>" ><?php echo __('Novedades');?><span class="spacer"></span><span class="menu-tail"></span></a>
							  	<?php
							  	}


							  	if (!empty($filter)) {
									$extra = 'noactive';
							  		if ($filter == 'suggestion') {
							  			$extra = 'current-menu-item';
							  		}
							  	}
						  		?>
								<a href="<?php echo $urlBase;?>/Catalogues/index/suggestion" class="ioa-button button-small <?php echo $extra;?>" ><?php echo __('Sugerencias');?><span class="spacer"></span><span class="menu-tail"></span></a>
								  


								<?php
							  	if (!empty($filter)) {
									$extra = 'noactive';
							  		if ($filter == 'collection') {
							  			$extra = 'current-menu-item';
							  		}
							  	}
						  		?>
						  		<a href="<?php echo $urlBase;?>/Catalogues/index/collection" class="ioa-button button-small <?php echo $extra;?>" >
						  			<?php echo __('Colecciones exclusivas');?>
						  			<span class="spacer"></span>
						  			<span class="menu-tail"></span>
						  		</a>
								  		


								<?php
								if  ($hay_composiciones) {
									if (!empty($filter)) {
										$extra = 'noactive';
								  		if ($filter == 'compositions') {
								  			//$extra = 'current-menu-ancestor';
								  			$extra = 'current-menu-item';
								  		}
									}
							  		?>
							  		<a href="<?php echo $urlBase;?>/Catalogues/index/compositions" class="ioa-button button-small <?php echo $extra;?>"><?php echo __('Composiciones Corma');?>
							  			<span class="menu-tail"></span>
							  		</a>
								  		
									<?php
								}
								if  ($hay_navidad) {
									if (!empty($filter)) {
										$extra = 'noactive';
								  		if ($filter == 'christmas') {
								  			//$extra = 'current-menu-ancestor';
								  			$extra = 'current-menu-item';
								  		}
									}
							  		?>
							  		<a href="<?php echo $urlBase;?>/Catalogues/index/christmas" class="ioa-button button-small <?php echo $extra;?>"><?php echo __('Navidad');?>
							  			<span class="menu-tail"></span>
							  		</a>
								  		
									<?php
								}


								  	if (!empty($filter)) {
										$extra = 'noactive';
								  		if ($filter == 'gamma') {
								  			$extra = 'current-menu-item';
								  		}
								  	}
							  		?>
								  		<?php $url = $urlBase.'/Catalogues/index/gamma';?>
								  		<a href="<?php echo $url?>" class="ioa-button button-small <?php echo $extra;?>">
								  			<?php echo __('Gama');?>
								  			<span class="spacer"></span>
								  			<span class="menu-tail"></span>
								  		</a>



						  	</div>


						</div>
					</div>

				</div>


				<div class="col-md-12 menu_layers box_carris_mobile boxCarris">
					<div class="clearfix">
						<?php
							echo $this->element('box_carris_mobile',array('cataleg' => $catalogue['Catalogue']));
						?>
					</div>

				</div>

			<?php
}
?>

			<div class="page-wrapper page" style="z-index:0">
				<div class="clearfix  auto_align">
					<div class="mutual-content-wrap">
						<div class="page-content auto_align clearfix">
						<div id="container" class="col-md-12">
							<div class="col-md-2">
								<?php
									echo $this->element('menu_left', array('option'=>$option, 'user'=>$user));
								?>
							</div>
							<div class="col-md-10 customer_left">
								<?php 
							$messageGood = $this->Session->flash('good');
							$messageBad  = $this->Session->flash('bad');
							$messageInfo = $this->Session->flash('info');
							if ($messageGood) {
							    echo "<div class='alert alert-success'>";
							    echo $messageGood;
							    echo "</div>";
							}

							if ($messageBad) {
							    echo "<div class='alert alert-danger'>";
							    echo $messageBad;
							    echo "</div>";
							}

							if ($messageInfo) {
							    echo "<div class='alert alert-info'>";
							    echo $messageInfo;
							    echo "</div>";
							}
							echo $this->fetch('content'); ?>
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




